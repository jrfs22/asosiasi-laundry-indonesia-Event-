<?php

namespace App\Services;

class NotificationService
{
    private function sendNotificationToWhatsapp($getPesan, $target)
    {
        $token = env('WA_TOKEN');
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

    public function sendRegistrationNotification(
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

        $this->sendNotificationToWhatsapp($getPesan, $target);
    }

    public function sendPaymentConfirmation($nama, $link, $target)
    {
        $getPesan = 'Halo, ' . $nama . '

Terima kasih telah menyelesaikan pendaftaran dan pembayaran tiket. Berikut adalah barcode pass masuk Anda yang akan digunakan pada saat acara:

' . $link . '

Harap simpan barcode ini dengan baik dan tunjukkan pada saat hari H di pintu masuk untuk memudahkan proses registrasi.

Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami di WhatsApp ini.

Sampai jumpa di acara nanti!

Salam,
*ASLI DPD RIAU*';

        $this->sendNotificationToWhatsapp($getPesan, $target);
    }

    public function sendPaymentReminder($name, $tickets, $amount, $phone_number)
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

            $this->sendNotificationToWhatsapp($getPesan, $phone_number);
    }

    public function sendEventReminder($name, $eventName, $phone_number, $days)
    {
        $getPesan = '*REMINDER ACARA H-'. $days .'*

Hai, *' . $name . '*!

Kami ingin mengingatkan Anda bahwa acara *'. $eventName .'* akan segera berlangsung pada:

📅 Tanggal: 28 September 2024
⏰ Waktu: 08:00 - selesai
📍 Lokasi:
https://bit.ly/lokasi-acara-workshop
*The Gade Coffee & Gold(
*(Jl. Sudirman Simpang Flyover Harapan Raya. Pekanbaru)*

*Note:*
*- Jangan lupa membawa barcode yang sudah diterima dan tunjukkan ketika di lokasi acara*
*- Sediakan alat tulis masing - masing (Jika diperlukan)*
*- Area parkir tersedia didepan cafe dan dibelakang (masuk dari parkiran RS Syafira)*

Terima kasih atas partisipasi Anda. Kami sangat menantikan kehadiran anda!

Salam,
*ASLI DPD RIAU*';

            $this->sendNotificationToWhatsapp($getPesan,
            $phone_number);
            return $getPesan;
    }

    public function sendRegistrationClosedNotification($name, $phone_number)
    {
        $getPesan = '*Pengumuman Penting: Penutupan Pendaftaran*

Hai, *' . $name . '*!

Kami informasikan bahwa pendaftaran resmi telah ditutup. Bagi peserta yang belum menyelesaikan pembayaran, kami mohon maaf karena kesempatan untuk menyelesaikan pendaftaran sudah tidak tersedia.

Kami sangat menghargai minat dan antusiasme Anda, namun sesuai dengan jadwal yang telah ditentukan, kami tidak dapat menerima pembayaran setelah penutupan ini.

Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi tim kami melalui nomor whatsapp yang tercantum pada flyer.

Terima kasih atas pengertiannya, dan kami berharap dapat berkolaborasi dengan Anda di kesempatan berikutnya.

Salam,
*ASLI DPD RIAU*';

            $this->sendNotificationToWhatsapp($getPesan, $phone_number);
    }
}
