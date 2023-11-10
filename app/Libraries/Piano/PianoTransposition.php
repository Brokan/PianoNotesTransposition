<?php

namespace App\Libraries\Piano;

use App\Libraries\Piano\NoteTransposition;

/**
 * 
 */
class PianoTransposition
{
    private $notes = [];

    public function __construct(array $notes)
    {
        $this->notes = $notes;
    }

    public function transposite(int $semitones): array
    {
        // Transpose each note
        foreach ($this->notes as &$noteParts) {
            list($octave, $note) = $noteParts;
            $noteTransposition = new NoteTransposition($octave, $note);
            $noteTransposition->transposite($semitones);

            $noteParts = [
                $noteTransposition->getOctave(),
                $noteTransposition->getNote(),
            ];
        }

        return $this->notes;
    }
}