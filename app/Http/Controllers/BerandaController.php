<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $event = EventsModel::with(['participants' => function ($query) {
            $query->where('qrcode', '!=' ,'null');
        }])->latest()->first();


        $event->summary = $event->participants->count();
        // dd($event);

        return view('before-login.beranda')->with('event', $event);
    }
}
