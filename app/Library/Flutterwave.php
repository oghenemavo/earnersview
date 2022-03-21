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

    public function gateway(array $data)
    {
        // Prepare our rave request
        $request = [
            'tx_ref' => $data['tx_ref'],
            'amount' => $data['amount'],
            'currency' => 'NGN',
            'payment_options' => 'card',
            'redirect_url' => route('user.payment.process'),
            'customer' => [
                'email' => $data['email'],
                'name' => $data['name'],
                // 'phonenumber' => '00000000000',
            ],
            'meta' => [
                'price' => $data['amount'],
                'user_id' => $data['user_id'],
                // 'orders' => json_encode($meta),
            ],
            'customizations' => [
                'title' => 'Earners View Membership',
                'description' => 'sample',
                'logo' => asset('images/earners-logo.png'),
            ]
        ];

        //* Call flutterwave emdpoint
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
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

        $result = json_decode($response);
        if($result->status == 'success') {
            $link = $result->data->link;
            header('Location: '. $link);
            exit();
        } else {
            echo 'We can not process your payment';
        }
    }

    public function process($request)
    {
        if ($request->status) {
            // check payment status
            if (strtolower($request->status) == 'cancelled') {
                // echo 'YOu cancel the payment';
                return false;
            } elseif ($request->status == 'successful') {
                $txid = $request->transaction_id;

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json",
                        "Authorization: Bearer " . $this->_key,
                    ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                
                $result = json_decode($response);
                if($result->status) {
                    $amountPaid = $result->data->charged_amount;
                    $amountToPay = $result->data->meta->price;
                    if($amountPaid >= $amountToPay) {
                        // dd(json_decode($result->data->meta->description));
                        // echo 'Payment successful';
                        return $result;

                        //* Continue to give item to the user
                    } else {
                        echo 'Fraud transaction detected';
                    }
                } else {
                    echo 'Can not process payment';
                }
            }
        }
    }
    
    public function check_transfer($transaction_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transfers/{$transaction_id}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->_key,
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $result = json_decode($response);

        return $result;
    }

    public function verifyTransaction($transaction_id) {
        $query = ['SECKEY' =>  $this->_key, 'txref'=> $transaction_id];
        $data_string = json_encode($query);

        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify'); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $request = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($request);

        if($result->status == 'success') {
            $amountPaid = $result->data->chargedamount;
            $amountToPay = $result->data->amount;
            if($amountPaid >= $amountToPay) {
                // dd(json_decode($result->data->meta->description));
                // echo 'Payment successful';
                return $result->data;

                //* Continue to give item to the user
            } else {
                echo 'Fraud transaction detected';
            }
        }
        return false;
    }

    public function transfers($data)
    {
        //* Prepare our rave request
        $request = [
            "account_bank" => $data->user->bank_code,
            "account_number" => $data->user->bank_account,
            "amount" => $data->amount,
            "narration" => "Video Payout",
            "currency" => "NGN",
            "reference" => $data->reference,
            // "callback_url" => "http://985c-129-205-124-15.ngrok.io/payout/webhook",
            // "callback_url" => "http://127.0.0.1:8000/payout/webhook/". urlencode($data->receipt_no),
            "debit_currency" => "NGN"
        ];

        //* Call flutterwave emdpoint
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/transfers',
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

        $result = json_decode($response);
        
        if($result->status == 'success') {
            return $result->data;
        } else {
            echo 'We can not process your payment';
            return false;
        }
    }
    
}