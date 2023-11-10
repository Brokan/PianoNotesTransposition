<?php

namespace App\Console\Commands;

use Exception;
use App\Console\EchoMessages;
use App\Console\ConsoleKernel;
use App\Libraries\Piano\PianoTransposition;

/**
 * Run command: php index.php semitones=-3
 */
class PianoTranspositionFromFileCommand extends ConsoleKernel
{
    private const ARGUMENT_SEMITONES = 'semitones';
    private const INPUT_FILE         = 'storage/input.json';
    private const OUTPUT_FILE        = 'storage/output.json';

    /**
     *
     * @return void
     */
    public function run(): void
    {
        try {
            $semitones = $this->getSemitones();

            $notesList = $this->getInput();

            $newNotesList = (new PianoTransposition($notesList))->transposite($semitones);
            
            $this->saveOutput($newNotesList);

            EchoMessages::echoSuccess('Finished');
        } catch (Exception $e) {
            EchoMessages::echoError($e->getMessage());
        }
    }

    private function getSemitones(): int
    {
        $semitones = $this->getArgument(self::ARGUMENT_SEMITONES);
        if ($semitones === '') {
            throw new Exception('Semitone is not set to argument. Run php index.php semitones={semitone}');
        }

        if ((int) ($semitones) === 0) {
            throw new Exception('Semitone must be integer and not zero. Run php index.php semitones={semitone}');
        }

        return (int) $semitones;
    }

    private function getInput(): array
    {
        $notesList = json_decode(file_get_contents($this->getInputFilePath()), true);

        if(!is_array($notesList)){
            throw new Exception('File ' . self::INPUT_FILE . ' has not valid JSON format.');
        }
        
        return $notesList;
    }

    private function saveOutput(array $output): void
    {
        file_put_contents($this->getOutputFilePath(), json_encode($output));
    }

    private function getInputFilePath(): string
    {
        return global_path() . self::INPUT_FILE;
    }

    private function getOutputFilePath(): string
    {
        return global_path() . self::OUTPUT_FILE;
    }
}