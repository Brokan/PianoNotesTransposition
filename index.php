<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bootstrap/functions.php';

(new App\Console\Commands\PianoTranspositionFromFileCommand())->run();
