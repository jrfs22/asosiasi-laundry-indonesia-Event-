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

function daysUntilDate(string $target)
{
    $now = Carbon::now();
    $target = Carbon::parse($target)->format('Y-m-d');

    return round($now->diffInDays($target));
}
