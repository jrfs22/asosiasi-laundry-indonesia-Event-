<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use App\Models\RegistrationModel;
use Event;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('before-login.registration');
    }

    public function pendaftar()
    {
        $events = EventsModel::all();
        $pendaftar = RegistrationModel::with('event')->get();
        // dd($pendaftar);
        return view('after-login.registration.index')->with([
            'pendaftar' => $pendaftar,
            'events' => $events
        ]);
    }
}
