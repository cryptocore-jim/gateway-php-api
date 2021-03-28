<?php

namespace CryptoCore\Api;

class CryptoCoreFaucetSubmit
{
    private $usersignature;
    private $amount;
    private $faucet_key;
    private $user_id;
    private $address;
    private $currency_code;
    private $faucet_additional_data;

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

    /**
     * @return mixed
     */
    public function getFaucetKey()
    {
        return $this->faucet_key;
    }

    /**
     * @param mixed $faucet_key
     */
    public function setFaucetKey($faucet_key)
    {
        $this->faucet_key = $faucet_key;
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
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
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
    public function getFaucetAdditionalData()
    {
        return $this->faucet_additional_data;
    }

    /**
     * @param mixed $faucet_additional_data
     */
    public function setFaucetAdditionalData($faucet_additional_data)
    {
        $this->faucet_additional_data = $faucet_additional_data;
    }


    public function getFaucetSubmitSignature($secretKey)
    {
        return sha1($this->getAddress() .  $this->getAmount() . $this->getCurrencyCode() .
            $this->getFaucetKey() . $this->getUserId() . $secretKey);
    }

    public function getJson()
    {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }

};