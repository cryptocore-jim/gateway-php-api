<?php

namespace CryptoCore\Api;

class CryptoCoreGetFaucet
{
    private $usersignature;
    private $user_id;
    private $faucet_key;

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
        $this->user_id = $user_id;
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


    public function getFaucetSignature($secretKey)
    {
        return sha1($this->getFaucetKey() . $this->getUserId() . $secretKey);
    }

    public function getJson()
    {
        $vars = get_object_vars($this);
        return json_encode($vars);
    }

};