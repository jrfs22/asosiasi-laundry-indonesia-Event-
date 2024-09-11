<?php

namespace App\Traits;

trait NotificationTraits
{
    private function sendNotification($getPesan, $target)
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
}
