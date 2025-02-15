<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class NotifyService
{

    public function sendFonnteNotification($noWa, $message){
        $apiKey = env('FONNTE_API_KEY');
        if (!$apiKey) {
            Log::error('FONNTE_API_KEY is not set in .env file.');
            return;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
        'target' => $noWa,
        'message' => $message,
        'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => [
            "Authorization: $apiKey" //change TOKEN to your actual token
        ],
        ]);

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        Log::info('Fonnte API Response: ' . $response);
    }
}