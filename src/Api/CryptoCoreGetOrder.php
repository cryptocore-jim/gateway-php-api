<?php

namespace CryptoCore\Api;

class CryptoCoreGetOrder
{
    private $usersignature;
    private $user_id ;
    private $payment_id;

    /**
     * @return mixed
     */
    public function getUsersignature()
    {
        return $this->usersignature;
    }

    /**
     * @param mixed $usersignature
     */
    public function setUsersignature($usersignature)
    {
        $this->usersignature = $usersignature;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = intval($user_id);
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @param mixed $payment_id
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
    }


    public function getOrderSignature($secrectKey)
    {
        return sha1($this->getPaymentId() . $this->getUserId() . $secrectKey);
    }

    public function getJson()
    {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }

};