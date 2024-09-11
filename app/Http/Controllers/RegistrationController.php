<?php

namespace App\Http\Controllers;

use App\Traits\NotificationTraits;
use Event;
use Exception;
use App\Models\EventsModel;
use App\Models\MembersModel;
use Illuminate\Http\Request;
use App\Models\ParticipantsModel;
use App\Models\RegistrationModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegistrationController extends Controller
{
    use NotificationTraits;
    public function index()
    {
        return view('before-login.registration');
    }

    public function pendaftar()
    {
        $events = EventsModel::all();
        $pendaftar = RegistrationModel::with('event')->get();

        $tickets = [
            'totalPaid' => 0,
            'totalUnpaid' => 0,
            'totalSettled' => 0,
            'totalPending' => 0
        ];

        if ($pendaftar) {
            $tickets['totalUnpaid'] = $pendaftar->where('payment_status', 'belum bayar')->count();
            $tickets['totalPaid'] = $pendaftar->where('payment_status', 'lunas')->count();

            $tickets['totalSettled'] = $pendaftar->where('payment_status', 'lunas')->sum('amount');
            $tickets['totalPending'] = $pendaftar->where('payment_status', 'belum bayar')->sum('amount');

        }

        return view('after-login.registration.index')->with([
            'pendaftar' => $pendaftar,
            'events' => $events,
            'tickets' => $tickets
        ]);
    }

    public function tickets($name, $participant_id)
    {
        $participant = ParticipantsModel::with(['registration', 'event'])->where(DB::raw("REPLACE(LOWER(name), ' ', '-')"), $name)->where('id', $participant_id)->first();

        if ($participant) {
            return view('before-login.tickets')->with('participant', $participant);
        } else {
            $this->alert(
                'Detail pembayaran tidak ditemukan',
                'Silahkan lakukan pembayaran terlebih dahulu',
                'success'
            );

            return redirect()->route('beranda');
        }
    }

    public function registrasi(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'nameArr' => 'required|array',
                'phone_number_arr' => 'required|array',
                'laundry_arr' => 'required|array',
                'certificate' => 'required|array',
                'name' => 'required',
                'phone_number' => 'required',
                'laundry' => 'required',
                'source' => 'required',
                'member' => 'sometimes',
            ]);

            DB::beginTransaction();

            $counter = 0;
            foreach ($request->phone_number_arr as $value) {
                if (MembersModel::where('phone_number', $value)->exists()) {
                    $counter++;
                }
            }

            if ($counter > 1) {
                $this->alert(
                    'Registrasi Gagal',
                    'Terdapat lebih dari 1 member',
                    'error'
                );

                return redirect()->route('registrasi');
            } else {
                $event = EventsModel::latest()->first();

                $registration = new RegistrationModel();
                $registration->event_id = $event->id;
                $registration->name = $request->name;
                if ($request->has('email')) {
                    $registration->email = $request->email;
                }
                $registration->phone_number = $request->phone_number;

                $registration->tickets = count($request->nameArr);
                $registration->source = $request->source;

                $rsAmount = $this->countAmount(
                    $this->isMember($request->phone_number),
                    count($request->nameArr)
                );

                $registration->amount = $rsAmount['amount'];
                $registration->discount_percentage = $rsAmount['diskon'];
                $registration->discount_total = $rsAmount['totalDiskon'];
                $registration->member = $rsAmount['member'];

                if ($registration->save()) {
                    for ($i = 0; $i < count($request->nameArr); $i++) {
                        ParticipantsModel::create([
                            'event_id' => $event->id,
                            'registration_id' => $registration->id,
                            'name' => $request->nameArr[$i],
                            'laundry_name' => $request->laundry_arr[$i],
                            'phone_number' => $request->phone_number_arr[$i],
                            'certificate_name' => $request->certificate[$i],
                            'type' => $this->isMember($request->phone_number_arr[$i])['exists'] ? 'member' : 'non member'
                        ]);
                    }

                    DB::commit();

                    $this->notification(
                        $registration->name,
                        $registration->member,
                        $registration->tickets,
                        $rsAmount['hargaDasar'],
                        $rsAmount['subtotal'],
                        $registration->discount_total,
                        $registration->discount_percentage,
                        $registration->amount,
                        $registration->phone_number
                    );

                    $this->alert(
                        'Registrasi Berhasil',
                        'Registrasi berhasil & silahkan cek whatsapp anda untuk melanjutkan pembayaran',
                        'success'
                    );

                    return redirect()->route('registrasi');
                }
            }

        } catch (Exception $e) {
            DB::rollBack();
            $this->alert(
                'Registrasi Gagal',
                'Registrasi Gagal',
                'error'
            );

            Log::error($e->getMessage());

            return redirect()->route('registrasi');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make($request->all(), [
                'bukti_pembayaran' => 'required|image'
            ], [
                'bukti_pembayaran.required' => 'Bukti pembayaran tidak di masukkan',
                'bukti_pembayaran.image' => 'File tidak berbentuk gambar'
            ]);

            DB::beginTransaction();

            $registrasi = RegistrationModel::with('participants')->findOrFail($id);

            if ($file = $request->file('bukti_pembayaran')) {
                $filename = time() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('bukti-pembayaran', $filename, 'public');

                $registrasi->bukti_pembayaran = $path;
                $registrasi->payment_status = 'lunas';

                if ($registrasi->save()) {
                    DB::commit();

                    foreach ($registrasi->participants as $item) {
                        $this->notification_konfirmasi(
                            $item->name,
                            route('tickets', [
                                'name' => formatString($item->name),
                                'participant_id' => $item->id
                            ]),
                            $item->phone_number,
                        );

                        $item->qrcode = $this->generateQRCode($item->registration_id, $item->name);

                        $item->save();

                        $randomSeconds = rand(1, 5);
                        sleep($randomSeconds);
                    }

                    $this->alert(
                        'Bukti pembayaran berhasil diinputkan',
                        'System akan mengirimkan status',
                        'success'
                    );

                    return redirect()->route('pendaftar');
                }
            }

        } catch (Exception $e) {
            DB::rollBack();
            $this->alert(
                'Bukti pembayaran Gagal diinputkan',
                $e->getMessage(),
                'error'
            );

            Log::error($e->getMessage());

            return redirect()->route('pendaftar');
        }
    }

    public function sendReminderPembayaran()
    {
        try {
            $register = RegistrationModel::where('payment_status', operator: 'belum bayar')->get();

            foreach ($register as $item) {
                $this->sendNotifikasiReminderPembayaran($item->name, $item->tickets, $item->amount, $item->phone_number);

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

    public function countAmount($isMember, $tickets)
    {
        $hargaDasar = $isMember['exists'] ? 200000 : 250000;
        $diskon = 0;

        if ($isMember['exists']) {
            $diskon = ($isMember['member']->type === 'pengurus' || $isMember['member']->type === 'panitia') ? 30 : (($tickets === 2) ? 20 : (($tickets === 3) ? 25 : ($tickets > 3 ? 30 : 0)));
        } else {
            $diskon = 0;
        }

        $subtotal = $hargaDasar * $tickets;
        $totalDiskon = ($subtotal * $diskon) / 100;
        $totalHarga = $subtotal - $totalDiskon;

        return [
            'member' => $isMember['exists'] ? 'Ya' : 'Tidak',
            'diskon' => $diskon,
            'totalDiskon' => $totalDiskon,
            'amount' => $totalHarga,
            'subtotal' => $subtotal,
            'hargaDasar' => $hargaDasar
        ];
    }

    public function isMember($phone_number)
    {
        try {
            $member = MembersModel::where('phone_number', $phone_number)->first();
            $exists = !is_null($member);

            return [
                'exists' => $exists,
                'member' => $member
            ];
        } catch (Exception $e) {
            return false;
        }
    }

    public function generateQRCode($registration_id, $name)
    {
        $data = formatString($name) . '/' . $registration_id;
        $filename = formatString($name) . '-' . time() . '.svg';

        $directoryPath = public_path('storage/qrcodes');
        $filePath = $directoryPath . '/' . $filename;

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        QrCode::format('svg')->size(300)->generate($data, $filePath);

        return $filename;
    }

    public function notification_konfirmasi($nama, $link, $target)
    {
        $token = env('WA_TOKEN');

        $getPesan = 'Halo, ' . $nama . '

Terima kasih telah menyelesaikan pendaftaran dan pembayaran tiket. Berikut adalah barcode pass masuk Anda yang akan digunakan pada saat acara:

' . $link . '

Harap simpan barcode ini dengan baik dan tunjukkan pada saat hari H di pintu masuk untuk memudahkan proses registrasi.

Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami di WhatsApp ini.

Sampai jumpa di acara nanti!

Salam,
*ASLI DPD RIAU*';

        $this->sendNotification($getPesan, $target);
    }

    public function notification(
        $nama,
        $member,
        $tiket,
        $harga,
        $subtotal,
        $diskon,
        $diskon_percentage,
        $final,
        $target
    ) {

        $getPesan = '*E-INVOICE PEMESANAN TIKET*

Terima kasih telah melakukan pemesanan. Berikut adalah rincian transaksi Anda:

Tanggal Transaksi : *' . now() . '*
Pemesan : *' . $nama . '*
Member : *' . $member . '*

Jumlah Tiket : *' . $tiket . '*
Harga per tiket : *' . idrFormat($harga) . '*
Subtotal : *' . idrFormat($subtotal) . '*
Diskon (' . $diskon_percentage . '%): *' . idrFormat($diskon) . '*

Total Pembayaran : *' . idrFormat($final) . '*

Silakan lakukan pembayaran ke rekening berikut:

Bank BCA
No. Rekening: *0343744665*
A.n.: *Agustony Pangaribuan*

*Note: Setelah melakukan pembayaran, harap kirimkan bukti transfer ke WhatsApp ini.*

Informasi Penting:
Barcode untuk pass masuk acara pada hari H akan dibagikan ke masing-masing nomor peserta yang sudah melakukan pendaftaran dan pembayaran. Pastikan nomor whatsapp Anda aktif dan dapat menerima pesan.

Terima kasih atas kepercayaan Anda.

Salam,
*ASLI DPD RIAU*';

        $this->sendNotification($getPesan, $target);
    }

    private function sendNotifikasiReminderPembayaran($name, $tickets, $amount, $phone_number)
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

    private function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        if (substr($phoneNumber, 0, 2) === '62') {
            $phoneNumber = '0' . substr($phoneNumber, 2);
        }

        if (substr($phoneNumber, 0, 2) !== '08') {
            $phoneNumber = '08' . $phoneNumber;
        }

        return $phoneNumber;
    }
}

