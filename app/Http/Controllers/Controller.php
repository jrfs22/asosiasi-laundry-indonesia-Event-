<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function alert($title, $text, $icon)
    {
        session()->flash('sweetalert', [
            'title' => $title,
            'text' => $text,
            'icon' => $icon,
        ]);
    }
}
