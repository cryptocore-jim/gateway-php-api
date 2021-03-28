<?php

namespace CryptoCore\Api;

class CryptoCoreNewOrder
{
    private $usersignature;
    private $user_id ;
    private $order_id;
    private $currency_code;
    private $payment_currency_code;
    private $result_url;
    private $user_return_url;
    private $amount;

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
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->currency_code;
    }

    /**
     * @param mixed $currency_code
     */
    public function setCurrencyCode($currency_code)
    {
        $this->currency_code = $currency_code;
    }

    /**
     * @return mixed
     */
    public function getPaymentCurrencyCode()
    {
        return $this->payment_currency_code;
    }

    /**
     * @param mixed $payment_currency_code
     */
    public function setPaymentCurrencyCode($payment_currency_code)
    {
        $this->payment_currency_code = $payment_currency_code;
    }

    /**
     * @return mixed
     */
    public function getResultUrl()
    {
        return $this->result_url;
    }

    /**
     * @param mixed $result_url
     */
    public function setResultUrl($result_url)
    {
        $this->result_url = $result_url;
    }

    /**
     * @return mixed
     */
    public function getUserReturnUrl()
    {
        return $this->user_return_url;
    }

    /**
     * @param mixed $user_return_url
     */
    public function setUserReturnUrl($user_return_url)
    {
        $this->user_return_url = $user_return_url;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function newOrderSignature($secretKey)
    {
        return sha1($this->getCurrencyCode() . $this->getOrderId() . $this->getResultUrl() . $this->getUserReturnUrl() . $this->getUserId() . $this->getAmount() . $secretKey);
    }

    public function getJson()
    {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }

};