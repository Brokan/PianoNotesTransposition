<?php

if (!function_exists('global_path')) {

    function global_path(): string
    {
        return __DIR__ . '/../';
    }
}