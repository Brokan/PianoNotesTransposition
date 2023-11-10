<?php

namespace Tests\Unit\Piano;

use Tests\TestCase;
use App\Libraries\Piano\NoteTransposition;
use Exception;

class NoteTranspositionTest extends TestCase
{

    public function testValidTransposition()
    {
        $noteTransposition = new NoteTransposition(3, 5);
        $noteTransposition->transposite(2);

        $this->assertEquals(3, $noteTransposition->getOctave());
        $this->assertEquals(7, $noteTransposition->getNote());
    }

    public function testValidTransposition2()
    {
        $noteTransposition = new NoteTransposition(2, 9);
        $noteTransposition->transposite(3);

        $this->assertEquals(2, $noteTransposition->getOctave());
        $this->assertEquals(12, $noteTransposition->getNote());
    }

    public function testValidTransposition3()
    {
        $noteTransposition = new NoteTransposition(2, 9);
        $noteTransposition->transposite(-8);

        $this->assertEquals(2, $noteTransposition->getOctave());
        $this->assertEquals(1, $noteTransposition->getNote());
    }

    public function testValidTranspositionWithOctaveChange()
    {
        $noteTransposition = new NoteTransposition(3, 10);
        $noteTransposition->transposite(4);

        $this->assertEquals(4, $noteTransposition->getOctave());
        $this->assertEquals(2, $noteTransposition->getNote());
    }

    public function testValidTranspositionWithOctaveChange2()
    {
        $noteTransposition = new NoteTransposition(3, 10);
        $noteTransposition->transposite(-10);

        $this->assertEquals(2, $noteTransposition->getOctave());
        $this->assertEquals(12, $noteTransposition->getNote());
    }

    public function testTranspositionOutOfRange()
    {
        $noteTransposition = new NoteTransposition(5, 10);

        $this->expectException(Exception::class);
        $noteTransposition->transposite(3);
    }

    public function testTranspositionWithOctaveOutOfRange()
    {
        $noteTransposition = new NoteTransposition(5, 1);

        $this->expectException(Exception::class);
        $noteTransposition->transposite(1);
    }
}