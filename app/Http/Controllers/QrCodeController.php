<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show()
    {
        $directoryPath = public_path('storage/qrcodes');
        $filePath = $directoryPath . '/qrcode.svg';

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        QrCode::format('svg')->size(300)->generate('https://example.com', $filePath);

        return 'QR code saved successfully!';
    }

    public function removeCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('event:clear');
        Artisan::call('optimize:clear ');

        return 'Successfully!';
    }

    public function sendMessage(Request $request)
    {
        $phoneNumber = '087893504595';
        $message = urlencode('Hello, this is a message from Laravel!');

        $whatsappUrl = "https://wa.me/{$phoneNumber}?text={$message}";

        // Redirect to WhatsApp
        return redirect($whatsappUrl);
    }

    public function whatsapp()
    {
        $nama = "Josep";
        $member= "Member";
        $tiket = 3;
        $harga = 200000;
        $subtotal = 600000;
        $diskon = 150000;
        $diskon_percentage = 20;
        $final = 450000;
        $token = env('WA_TOKEN');
        $target = '081261717772';

        $getPesan = 'Terimakasih sudah mendaftar,

Tanggal Transaksi : *'. now() .'*

Pemesan : *'.$nama.'*
Member : *'.$member.'*
Jumlah tiket : *'.$tiket.'*
Harga : *'. idrFormat($harga) .'*
Subtotal : *'. idrFormat($subtotal) .'*
Diskon ('. $diskon_percentage .'%): *'. idrFormat($diskon) .'*

Yang perlu dibayarkan : *'. idrFormat($final) .'*

Bank BCA
Norek: *0343744665*
A\n: *Agustony Pangaribuan*

Jika sudah melakukan pembayaran, silahkan kirimkan bukti pembayaran pada whatsapp ini.

Berikut ini QR Code & Detail Pembayaran

Terimakasih';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://notificationwa.com/api/post',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'isi_pesan' => $getPesan,
                'nomor_recieved' => $target
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
}
