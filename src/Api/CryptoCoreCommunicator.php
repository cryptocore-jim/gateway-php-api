<?php

namespace CryptoCore\Api;

class CryptoCoreCommunicator
{
    public function sendNewOrderRequest($jsonRequest, $timeout = 30)
    {
        if (intval($timeout) < 0) {
            $timeout = 30;
        }

        $url = 'https://gateway.ccore.online/order/payment/new';
        $request_data = $jsonRequest;

        return $this->sendRequest($request_data, $url, $timeout);
    }

    public function sendGetOrderRequest($jsonRequest, $timeout = 30)
    {
        if (intval($timeout) < 0) {
            $timeout = 30;
        }

        $url = 'https://gateway.ccore.online/order/payment/getpayment';
        $request_data = $jsonRequest;

        return $this->sendRequest($request_data, $url, $timeout);
    }

    private function sendRequest($jsonRequest, $url, $timeout)
    {
        if (intval($timeout) < 0) {
            $timeout = 30;
        }

        $request_data = $jsonRequest;
        $request_length = strlen($request_data);

        $headers = [
            "Connection: close",
            "Content-type: application/json",
            "Content-Length: " . $request_length
        ];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $jsonResponse = @curl_exec($curl);
        @curl_close($curl);

        $jsonResponse = trim($jsonResponse);
        return $jsonResponse;
    }


    public function getRedirectUrl($paymentId)
    {
        return "https://gateway.ccore.online/gateway?payment_id=".$paymentId;
    }

    public function processResponse($response)
    {
        $json = json_decode($response);
        if (empty($json->payment_id)) {
            throw new \Exception($response);
        }
        return $json;
    }

    public function newExchangeSignature($userId, $secrectKey)
    {
        return sha1($userId . $secrectKey);
    }
}