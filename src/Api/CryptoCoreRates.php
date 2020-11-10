<?php

namespace CryptoCore\Api;

use Exception;

class CryptoCoreRateDTO
{
    public $from_currency;
    public $to_currency;
    public $rate;
    public $name;
    public $decimals_amount;
    public $volatility;
    public $logo;
}

class CryptoCoreCryptoAmountDTO extends  CryptoCoreRateDTO
{
    public $amount;
}

class CryptoCoreRates
{
    private $arrayOfRates;

    function  __construct($json) {

        $jsonDecode = json_decode($json);
        if ($jsonDecode != null && is_array($jsonDecode)) {
            foreach ($jsonDecode as $currency) {

                if ($currency->from_currency != null) {
                    $rate = new CryptoCoreRateDTO();
                    $rate->from_currency = $currency->from_currency;
                    $rate->to_currency = $currency->to_currency;
                    $rate->rate = $currency->rate;
                    $rate->name = $currency->name;
                    $rate->logo = $currency->logo;
                    $rate->decimals_amount = $currency->decimals_amount;
                    $rate->volatility = $currency->volatility;
                    $this->arrayOfRates[] = $rate;
                }
            }
        } else {
            throw new Exception("Wrong rate json");
        }
    }

    function getRate($from, $to, $amount) {
        foreach ($this->arrayOfRates as $rate) {
            if ($rate->from_currency == $from && $rate->to_currency == $to) {
                $amountInCrypto = round($amount * $rate->rate + ($amount * $rate->rate * $rate->volatility / 100), $rate->decimals_amount);
                $cryptoCoreCryptoAmountDTO = new CryptoCoreCryptoAmountDTO();
                $cryptoCoreCryptoAmountDTO->from_currency = $rate->from_currency;
                $cryptoCoreCryptoAmountDTO->to_currency = $rate->to_currency;
                $cryptoCoreCryptoAmountDTO->rate = $rate->rate;
                $cryptoCoreCryptoAmountDTO->name = $rate->name;
                $cryptoCoreCryptoAmountDTO->logo = $rate->logo;
                $cryptoCoreCryptoAmountDTO->decimals_amount = $rate->decimals_amount;
                $cryptoCoreCryptoAmountDTO->volatility = $rate->volatility;
                $cryptoCoreCryptoAmountDTO->amount = $amountInCrypto;
                return $cryptoCoreCryptoAmountDTO;
            }
        }
        return null;
    }
};