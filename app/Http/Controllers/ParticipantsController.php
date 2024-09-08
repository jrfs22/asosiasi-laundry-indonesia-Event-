<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use App\Models\ParticipantsModel;
use Illuminate\Http\Request;
use App\Models\RegistrationModel;

class ParticipantsController extends Controller
{
    public function absensi()
    {
        $events = EventsModel::all();
        $participants = ParticipantsModel::with('event')->get();
        return view('after-login.absensi.index')->with([
            'participants' => $participants,
            'events' => $events
        ]);
    }
}
