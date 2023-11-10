<?php

namespace Tests\Unit\Piano;

use Tests\TestCase;
use App\Libraries\Piano\PianoTransposition;

class PianoTranspositionTest extends TestCase
{

    public function testTransposeNotesWithPositiveSemitones()
    {
        $initialNotes = [
            [3, 5],
            [4, 11],
            [-2, 11],
        ];

        $pianoTransposition = new PianoTransposition($initialNotes);
        $transposedNotes    = $pianoTransposition->transposite(2);

        $expectedNotes = [
            [3, 7],
            [5, 1], // This wraps around to a new octave
            [-1, 1], // This wraps around to a new octave
        ];

        $this->assertEquals($expectedNotes, $transposedNotes);
    }

    public function testTransposeNotesWithNegativeSemitones()
    {
        $initialNotes = [
            [3, 7],
            [0, 1], // Wrapped around from previous test
            [5, 1], // Wrapped around from previous test
        ];

        $pianoTransposition = new PianoTransposition($initialNotes);
        $transposedNotes    = $pianoTransposition->transposite(-2);

        $expectedNotes = [
            [3, 5],
            [-1, 11], // This wraps around to a lower octave
            [4, 11], // This wraps around to a lower octave
        ];

        $this->assertEquals($expectedNotes, $transposedNotes);
    }

    public function testTransposeNotesWithMixedSemitones()
    {
        $initialNotes = [
            [-1, 7],
            [-3, 12],
            [4, 12],
        ];

        $pianoTransposition = new PianoTransposition($initialNotes);
        $transposedNotes    = $pianoTransposition->transposite(1); // Positive and negative mixed

        $expectedNotes = [
            [-1, 8],
            [-2, 1], // This wraps around to a lower octave
            [5, 1], // This wraps around to a new octave
        ];

        $this->assertEquals($expectedNotes, $transposedNotes);
    }

    public function testTransposeNotesWithEmptyArray()
    {
        $pianoTransposition = new PianoTransposition([]);
        $transposedNotes    = $pianoTransposition->transposite(2);

        $this->assertEquals([], $transposedNotes);
    }
}