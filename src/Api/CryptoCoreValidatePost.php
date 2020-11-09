<?php

namespace CryptoCore\Api;

class CryptoCoreValidatePost
{
    private $signature;
    private $result;
    private $order_id;

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }


    public function validateRequest($request, $secrectKey)
    {
        $jsonData = json_decode($request);
        if (empty($jsonData->result) || empty($jsonData->order_id) || empty($jsonData->signature)) {
            throw new \Exception("Wrong json");
        }
        $result = $jsonData->result;
        $order_id = $jsonData->order_id;
        $signature = $jsonData->signature;
        if (sha1($result.$order_id.$secrectKey) == $signature) {
            $this->signature = $signature;
            $this->order_id = $order_id;
            $this->result = $result;
            return $this;
        }
        throw new \Exception("Validation fail");
    }

    public function getJson()
    {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }

};