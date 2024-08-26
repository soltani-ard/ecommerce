<?php

use Illuminate\Support\Str;

function generateFileName($image): string
{
    $time = microtime(true); // Get current time in microseconds
    $timestamp = str_replace('.', '', $time); // Remove decimal point
    $randomString = Str::random(10);
    $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
    return $timestamp . '_' . $randomString . '.' . $extension;
}
