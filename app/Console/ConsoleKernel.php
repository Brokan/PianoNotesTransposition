<?php

namespace App\Console;

abstract class ConsoleKernel
{
    protected $arguments = [];

    public function __construct()
    {
        $this->setArguments();
    }

    protected function getArgument(string $argName): string
    {
        return $this->arguments[$argName] ?? '';
    }

    abstract public function run(): void;

    private function setArguments(): void
    {
        $argv = $_SERVER['argv'] ?? [];

        // strip the application name
        array_shift($argv);

        foreach ($argv as $argument) {
            list($key, $value) = explode('=', $argument);
            $this->arguments[$key] = $value;
        }
    }
}