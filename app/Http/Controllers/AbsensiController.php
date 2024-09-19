<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendacesModel;
use App\Models\ParticipantsModel;
use App\Models\RegistrationModel;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function scan()
    {
        return view('after-login.absensi.scan');
    }

    public function validateQrCode(string $nameFormmating, string $registration_id)
    {
        $participant = ParticipantsModel::where(DB::raw("REPLACE(LOWER(name), ' ', '-')"), $nameFormmating)
            ->where('registration_id', $registration_id)
            ->exists();

        if ($participant) {
            return response()->json([
                'exists' => true
            ]);
        }

        return response()->json([
            'exists' => false
        ]);

    }


    public function absensi()
    {
        $participants = ParticipantsModel::with('attendances')
            ->has('attendances')
            ->get();

        return view('after-login.absensi.index', compact('participants'));
    }
}
