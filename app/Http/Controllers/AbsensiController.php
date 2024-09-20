<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use Excel;
use Exception;
use Illuminate\Http\Request;
use App\Models\AttendacesModel;
use App\Models\ParticipantsModel;
use App\Models\RegistrationModel;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function scan($type)
    {
        return view('after-login.absensi.scan', compact('type'));
    }

    public function validateQrCode(string $type, string $nameFormmating, string $registration_id)
    {
        $participant = ParticipantsModel::where(DB::raw("REPLACE(LOWER(name), ' ', '-')"), $nameFormmating)
            ->where('registration_id', $registration_id)
            ->first();

        if (isset($participant)) {
            $attendances = AttendacesModel::with('participant')
                ->where('event_id', $participant->event_id)
                ->where('registration_id', $participant->registration_id)
                ->where('participant_id', $participant->id)
                ->get();

            if ($attendances->isEmpty()) {
                return $this->storeNewAttendaces(
                    $participant->registration_id,
                    $participant->event_id,
                    $participant->id,
                    $type
                );
            } else {
                $isExist = $attendances->where('type', $type);
                if ($isExist->isNotEmpty()) {
                    return response()->json([
                        'terdaftar' => true,
                        'insert' => false,
                        'type' => $type,
                        'name' => $participant->name
                    ]);
                } else {
                    return $this->storeNewAttendaces(
                        $participant->registration_id,
                        $participant->event_id,
                        $participant->id,
                        $type
                    );
                }
            }
        }

        return response()->json([
            'terdaftar' => false,
            'insert' => false
        ]);
    }

    public function storeNewAttendaces(
        $registration_id,
        $event_id,
        $participant_id,
        $type
    ) {
        $newData = AttendacesModel::create([
                'registration_id' => $registration_id,
                'event_id' => $event_id,
                'participant_id' => $participant_id,
                'type' => $type
            ]);

        return response()->json([
            'terdaftar' => true,
            'insert' => true,
            'name' => $newData->load('participant')->participant->name,
            'type' => $type
        ]);
    }

    public function absensi()
    {
        $participants = ParticipantsModel::with('attendances')
            ->has('attendances')
            ->get();

        return view('after-login.absensi.index', compact('participants'));
    }

    public function destroy($event_id, $participant_id, $registration_id)
    {
        try {
            $attendance = AttendacesModel::where('event_id', $event_id)->where('participant_id', $participant_id)->where('registration_id', $registration_id)->first();

            if ($attendance->delete()) {
                $this->alert(
                    'Absensi deleted',
                    'Data absensi berhasil dihapus',
                    'success'
                );

                return redirect()->route('absensi');
            }
        } catch (Exception $e) {
            $this->alert(
                'Absensi deleted',
                'Data absensi gagal dihapus',
                'success'
            );

            return redirect()->route('absensi');
        }
    }

    public function download()
    {
        return Excel::download(new AbsensiExport, 'absensi.xlsx');
    }
}
