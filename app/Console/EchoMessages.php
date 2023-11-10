<?php

namespace App\Console;

/**
 * 
 */
class EchoMessages
{

    /**
     * Simple echo with new line.
     * @param string $messge
     */
    public static function echo(string $messge): void
    {
        echo $messge . PHP_EOL;
    }

    /**
     * Echo message with green color.
     * @param string $messge
     */
    public static function echoSuccess(string $messge): void
    {
        self::echo("\e[0;32m" . $messge . "\e[0m ");
    }

    /**
     * Echo message with red color.
     * @param string $messge
     */
    public static function echoError(string $messge): void
    {
        self::echo("\e[0;31m" . $messge . "\e[0m ");
    }

    /**
     * Echo message with orange color.
     * @param string $messge
     */
    public static function echoWarning(string $messge): void
    {
        self::echo("\e[0;33m" . $messge . "\e[0m ");
    }
}