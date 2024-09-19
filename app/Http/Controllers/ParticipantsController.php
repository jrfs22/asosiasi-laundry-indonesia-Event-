<?php

namespace App\Http\Controllers;

use App\Models\NotificationHistoriesModel;
use App\Services\NotificationService;
use Carbon\Carbon;
use Excel;
use Exception;
use App\Models\EventsModel;
use Illuminate\Http\Request;
use App\Models\ParticipantsModel;
use App\Models\RegistrationModel;
use App\Traits\NotificationTraits;
use Illuminate\Support\Facades\Log;
use App\Exports\ParticipantQrCodeExport;
use App\Exports\ParticipantQrCodeExposrt;

class ParticipantsController extends Controller
{
    public function qrcode()
    {
        $events = EventsModel::all();
        $participants = ParticipantsModel::with('event')->get();

        $qrcode = [
            'has' => 0,
            'doesnt' => 0
        ];
        if ($participants) {
            $qrcode['has'] = $participants->where('qrcode', '!=', null)->count();
            $qrcode['doesnt'] = $participants->where('qrcode', null)->count();
        }

        return view('after-login.qrcode.index')->with([
            'participants' => $participants,
            'events' => $events,
            'qrcode' => $qrcode
        ]);
    }

    public function peserta()
    {
        $events = EventsModel::first();
        $participants = ParticipantsModel::with('event')->get();

        $qrcode = [
            'has' => 0,
            'doesnt' => 0
        ];
        $reminder = [
            'exist' => daysUntilDate($events->date) == 3 || daysUntilDate($events->date) <= 1,
            'days' => daysUntilDate($events->date)
        ];

        if ($participants) {
            $qrcode['has'] = $participants->where('qrcode', '!=', null)->count();
            $qrcode['doesnt'] = $participants->where('qrcode', null)->count();
        }

        return view('after-login.peserta.index')->with([
            'participants' => $participants,
            'reminder' => $reminder,
            'qrcode' => $qrcode
        ]);
    }

    public function EventReminder()
    {
        try {
            $register = RegistrationModel::with(['participants', 'event'])->where('payment_status', operator: 'lunas')->get();

            if($register->isNotEmpty()) {
                ini_set('max_execution_time', 300);
                $event = EventsModel::first();

                $diffDays = daysUntilDate($event->date);

                $countNotificationHistories = NotificationHistoriesModel::where('type', 'event reminder')->count();

                if ($diffDays <= 3 && $countNotificationHistories < 2) {
                    if($diffDays > 1 && $countNotificationHistories > 0) {
                        $this->alert(
                            'Reminder Event',
                            'Selanjutnya untuk H-1',
                            'error'
                        );

                        return redirect()->route('peserta');
                    }

                    $notificationService = new NotificationService;

                    foreach ($register as $registerItem) {
                        foreach ($registerItem->participants as $item) {
                            $message = $notificationService->sendEventReminder(
                                $item->name,
                                $registerItem->event->name,
                                $item->phone_number,
                                $diffDays
                            );

                            if($message) {
                                NotificationHistoriesModel::create([
                                    'message' => $message,
                                    'type' => 'event reminder',
                                    'platform' => 'WhatsApp',
                                    'receiver' => $item->phone_number,
                                ]);
                            }

                            sleep(rand(1, 5));
                        }
                    }

                    $this->alert(
                        'Reminder Event',
                        'System berhasil mengirimkan notifikasi',
                        'success'
                    );

                    return redirect()->route('peserta');
                } else {
                    if($diffDays > 3) {
                        $this->alert(
                            'Reminder Event',
                            'Reminder Hanya Untuk H-3 dan H-1',
                            'error'
                        );
                    }

                    if($countNotificationHistories == 2) {
                        $this->alert(
                            'Reminder Event',
                            'Reminder Hanya Untuk 2 Kali',
                            'error'
                        );
                    }
                    return redirect()->route('peserta');
                }
            } else {
                $this->alert(
                    'Reminder Event',
                    'Tidak terdapat peserta',
                    'error'
                );

                return redirect()->route('peserta');
            }
        } catch (Exception $e) {
            $this->alert(
                'Gagal melakukan reminder',
                $e->getMessage(),
                'error'
            );

            Log::error($e->getMessage());

            return redirect()->route('peserta');
        }
    }

    public function download()
    {
        return Excel::download(new ParticipantQrCodeExport, 'qrcode.xlsx');
    }
}
