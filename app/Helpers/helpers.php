<?php
use Carbon\Carbon;

function isRouteActive($route)
{
    request()->route()->getName() === $route;
}

function idnDate($date)
{
    Carbon::setLocale('id');
    return Carbon::parse($date)->translatedFormat('d F Y');
}

function idrFormat($value)
{
    return 'Rp. ' . number_format($value, 0, ',', '.');
}

function formatString($string) {
    $lowercaseString = strtolower($string);

    $formattedString = str_replace(' ', '-', $lowercaseString);

    return $formattedString;
}
