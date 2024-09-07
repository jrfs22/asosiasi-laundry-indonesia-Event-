<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $events = EventsModel::all();
        return view('after-login.events.index')->with('events', $events);
    }
}
