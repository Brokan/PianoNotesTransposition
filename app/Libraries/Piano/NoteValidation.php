<?php

namespace App\Libraries\Piano;

use Exception;

/**
 * 
 */
class NoteValidation
{
    private const OCTAVE_MIN                    = -3;
    private const OCTAVE_MAX                    = 5;
    private const NOTE_MIN_NUMBER               = 1;
    private const NOTE_MAX_NUMBER               = 12;
    private const NOTE_MIN_NUMBER_IN_MAX_OCTAVE = 10;
    private const NOTE_MAX_NUMBER_IN_MIN_OCTAVE = 1;

    public static function validate(int $octave, int $note): bool
    {
        if ($octave < self::OCTAVE_MIN) {
            return false;
        }
        if ($octave > self::OCTAVE_MAX) {
            return false;
        }
        if ($note < self::NOTE_MIN_NUMBER) {
            return false;
        }
        if ($note > self::NOTE_MAX_NUMBER) {
            return false;
        }
        //Check last and first note
        if ($octave === self::OCTAVE_MIN && $note < self::NOTE_MIN_NUMBER_IN_MAX_OCTAVE) {
            return false;
        }
        if ($octave === self::OCTAVE_MAX && $note > self::NOTE_MAX_NUMBER_IN_MIN_OCTAVE) {
            return false;
        }
        return true;
    }
}