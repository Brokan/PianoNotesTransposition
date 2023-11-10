<?php

namespace App\Libraries\Piano;

use Exception;
use App\Libraries\Piano\NoteValidation;

/**
 * 
 */
class NoteTransposition
{
    private $note   = 0;
    private $octave = 0;

    private const NOTE_MAX = 12;
    private const NOTE_MIN = 1;

    public function __construct(int $octave, int $note)
    {
        $this->octave = $octave;
        $this->note   = $note;
    }

    public function transposite(int $semitones): void
    {
        
        if (!NoteValidation::validate($this->octave, $this->note)) {
            throw new Exception('Note [' . $this->octave . ',' . $this->note . '] out of keyboard range');
        }

        $this->note = $this->note + $semitones;

        if ($this->note > self::NOTE_MAX || $this->note < self::NOTE_MIN) {
            $direction    = $semitones / abs($semitones);
            $this->octave = $this->octave + $direction * (floor(abs($this->note) / self::NOTE_MAX));
            $this->note   = $this->note % self::NOTE_MAX;
            if($this->note <= 0){
                $this->note = self::NOTE_MAX + $this->note;
                $this->octave += $direction;
            }
        }

        // Check if the transposed note falls out of the keyboard range
        if (!NoteValidation::validate($this->octave, $this->note)) {
            throw new Exception('Transposed note [' . $this->octave . ',' . $this->note . '] out of keyboard range');
        }
    }

    public function getOctave(): int
    {
        return $this->octave;
    }

    public function getNote(): int
    {
        return $this->note;
    }
}