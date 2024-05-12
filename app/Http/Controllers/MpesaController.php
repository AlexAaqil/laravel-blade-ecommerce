<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class MpesaController extends Controller
{
    public function stkPush($phone, $amount, $order_number, $email){
        // define('CALLBACK_URL', 'https://pay.shea254.com/pay/callback.php?order_no');
        $CallBackURL = "https://pay.shea254.com/pay/callback.php";
  
        $consumerKey = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
  
        $BusinessShortCode = '6812022';
        $Passkey = env('MPESA_PASSKEY');
        // $phone = preg_replace('/^0/', '254', str_replace("+", "", $phone));
        $phone = (substr($phone, 0,1) == '+') ? str_replace('+', '', $phone) : $phone;
        $phone = (substr($phone, 0,1) == '0') ? preg_replace('/^0/', '254', $phone) : $phone;
        $phone = (substr($phone, 0,1) == '7') ? preg_replace('/^7/', '2547', $phone) : $phone;
        $phone = (substr($phone, 0,1) == '1') ? preg_replace('/^1/', '2541', $phone) : $phone;
        $phone = (substr($phone, 0,1) == '0') ? preg_replace('/^01/', '2541', $phone) : $phone;
        $phone = (substr($phone, 0,1) == '0') ? preg_replace('/^07/', '2547', $phone) : $phone;
        $PartyA = $phone;
        $PartyB = '4311370';
        $TransactionDesc = 'SHEA254 Ecommerce Payment';
        $Timestamp = date('YmdHis');    
        $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
        $headers = ['Content-Type:application/json; charset=utf8'];
  
        # M-PESA endpoint urls
        $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';  
  
        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        $access_token = $result->access_token;  
  
        curl_close($curl);
  
        $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $initiate_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader);

        $curl_post_data = array(
  
          //Fill in the request parameters with valid values
          'BusinessShortCode' => $BusinessShortCode,
          'Password' => $Password,
          'Timestamp' => $Timestamp,
          'TransactionType' => 'CustomerBuyGoodsOnline', // CustomerBuyGoodsOnline or CustomerPayBillOnline
          'Amount' => $amount,
          'PartyA' => $PartyA,
          'PartyB' => $PartyB,
          'PhoneNumber' => $PartyA,
          'CallBackURL' => $CallBackURL,
          'AccountReference' => $order_number,
          'TransactionDesc' => $TransactionDesc
        );
  
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
  
        $res = (array)(json_decode($curl_response));
        $ResponseCode = $res['ResponseCode'];
        return $ResponseCode;
    }
}
