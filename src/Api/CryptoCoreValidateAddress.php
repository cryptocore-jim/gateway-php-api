<?php

namespace CryptoCore\Api;

class CryptoCoreValidateAddress
{
    private $address;
    private $currency_code;
    private $user_id;
    private $usersignature;

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
     * @param mixed $usersignature
     */
    public function setUsersignature($usersignature)
    {
        $this->usersignature = $usersignature;
    }

    public function getValidateAddressSignature($secretKey)
    {
        return sha1($this->getAddress() . $this->getCurrencyCode() . $this->getUserId() . $secretKey);
    }

    public function getJson()
    {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }

};