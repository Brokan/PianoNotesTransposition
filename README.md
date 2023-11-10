# PianoNotesTransposition

Tested with PHP 7.3

*Install*
```
composer install
```

*Run console command*
In storage there is two files:
- storage/input.json
- storage/output.json
In input file in JSON format save notes.
To make Transposition run
```
php index.php semitones={semitone}
```

*Unit tests*
```
php vendor/bin/phpunit
```