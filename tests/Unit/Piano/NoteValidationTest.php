<?php

namespace Tests\Unit\Piano;

use Tests\TestCase;
use App\Libraries\Piano\NoteValidation;

class NoteValidationTest extends TestCase
{

    public function testValidNote()
    {
        $this->assertTrue(NoteValidation::validate(0, 1));
        $this->assertTrue(NoteValidation::validate(0, 12));
        $this->assertTrue(NoteValidation::validate(-3, 10));//First note
        $this->assertTrue(NoteValidation::validate(5, 1));//Last note
    }

    public function testInvalidOctave()
    {
        $this->assertFalse(NoteValidation::validate(-4, 1));
        $this->assertFalse(NoteValidation::validate(6, 1));
    }

    public function testInvalidNote()
    {
        $this->assertFalse(NoteValidation::validate(0, 0));
        $this->assertFalse(NoteValidation::validate(0, 13));
    }

    public function testInvalidNoteInMinOctave()
    {
        $this->assertFalse(NoteValidation::validate(-3, 9));
        $this->assertFalse(NoteValidation::validate(-4, 5));
    }

    public function testInvalidNoteInMaxOctave()
    {
        $this->assertFalse(NoteValidation::validate(5, 2));
        $this->assertFalse(NoteValidation::validate(5, 11));
    }
}