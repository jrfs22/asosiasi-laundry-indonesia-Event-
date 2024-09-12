<?php

namespace App\Http\Controllers;

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
    use NotificationTraits;
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

        return view('after-login.peserta.index')->with([
            'participants' => $participants,
            'events' => $events,
            'qrcode' => $qrcode
        ]);
    }

    public function sendReminderAcara()
    {
        try {
            $register = RegistrationModel::where('payment_status', operator: 'belum bayar')->get();

            foreach ($register as $item) {
                $this->sendNotifikasiReminderAcara($item->name, $item->tickets, $item->amount, $item->phone_number);

                sleep(rand(1, 10));
            }

            $this->alert(
                'Reminder berhasil dikirimkan',
                'System akan mengirimkan segera',
                'success'
            );

            return redirect()->route('pendaftar');
        } catch (Exception $e) {
            $this->alert(
                'Gagal melakukan reminder',
                $e->getMessage(),
                'error'
            );

            Log::error($e->getMessage());

            return redirect()->route('pendaftar');
        }
    }

    public function download()
    {
        return Excel::download(new ParticipantQrCodeExport, 'qrcode.xlsx');
    }

    private function sendNotifikasiReminderAcara($name, $tickets, $amount, $phone_number)
    {
        $getPesan = '*REMINDER PEMBAYARAN TIKET*

Hai, *' . $name . '*! Kami ingin mengingatkan bahwa pembayaran tiket Anda belum kami terima. Berikut detail pesanan Anda:

Tanggal Pesanan : *' . now() . '*
Nama Pemesan : *' . $name . '*
Jumlah Tiket : *' . $tickets . '*
Total Pembayaran : *' . idrFormat($amount) . '*

Silakan transfer ke rekening berikut:

Bank BCA
No. Rekening: *0343744665*
A.n.: *Agustony Pangaribuan*

*Note: Kirim bukti transfer ke WhatsApp ini setelah melakukan pembayaran, Jika tidak maka registrasi belum bisa diproses.*

Terima kasih atas kepercayaan Anda. Sampai ketemu di acara nanti!

Salam,
*ASLI DPD RIAU*';

            $this->sendNotification($getPesan, $phone_number);
    }
}
