<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use App\Models\ParticipantsModel;
use Illuminate\Http\Request;
use App\Models\RegistrationModel;

class ParticipantsController extends Controller
{
    public function index()
    {
        $events = EventsModel::all();
        $pendaftar = ParticipantsModel::with('event')->get();
        // dd($pendaftar);
        return view('after-login.pendaftar.index')->with([
            'pendaftar' => $pendaftar,
            'events' => $events
        ]);
    }
}
