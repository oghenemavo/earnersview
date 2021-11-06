<?php

namespace App\Library;

class Flutterwave
{
    protected $_key;

    public function __construct()
    {
        $this->_key = env('FLUTTERWAVE_KEY');
    }

    public function  validate_account($code, $account)
    {
        //* Prepare our rave request
        $request = [
            'account_bank' => $code,
            'account_number' => $account,
        ];

        //* Call flutterwave emdpoint
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/accounts/resolve',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->_key,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // there was an error contacting the rave API
            die('Curl returned error: ' . $err);
        }

        return json_decode($response);
    }
}