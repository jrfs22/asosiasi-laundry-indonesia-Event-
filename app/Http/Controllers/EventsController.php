<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $events = EventsModel::with('participants')->get();

        if ($events) {
            foreach ($events as $event) {
                $event->participants_summary = $event->participants->count();
            }
        }

        return view('after-login.events.index')->with('events', $events);
    }
}
