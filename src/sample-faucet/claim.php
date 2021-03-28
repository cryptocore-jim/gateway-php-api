<?php

use CryptoCore\Api\CryptoCoreCommunicator;
use CryptoCore\Api\CryptoCoreFaucetSubmit;
use CryptoCore\Api\CryptoCoreGetFaucet;
use CryptoCore\Api\CryptoCoreValidateAddress;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../Api/CryptoCoreCommunicator.php");
include("../Api/CryptoCoreGetFaucet.php");
include("../Api/CryptoCoreFaucetSubmit.php");
include("../Api/CryptoCoreValidateAddress.php");

$secretKey = "secretkey";
$userId = 1911120;
$faucetKey = "faucetkey";

$getFaucet = new CryptoCoreGetFaucet();
$cryptoCoreCommunicator = new CryptoCoreCommunicator();
$getFaucet->setUserId($userId); // Set User ID
$getFaucet->setFaucetKey($faucetKey); // Set payment ID
$signature = $getFaucet->getFaucetSignature($secretKey); // Generate Signature
$getFaucet->setUsersignature($signature); // Generate Signature
$json = $getFaucet->getJson();
$response = $cryptoCoreCommunicator->sendGetFaucetRequest($json, 30);

$result = "";
try {
    $result = $cryptoCoreCommunicator->processFaucetResponse($response);
} catch (\Exception $e) {
    echo "Fail to process: " . $e->getMessage();
    exit();
}
$amountAsk = $_POST["amount"];
$address = $_POST["address"];
if ($result->min_ask_amount > $amountAsk) {
    echo "Amount too low";
    exit();
}
$currency = $result->currency_code;

$validateAddress = new CryptoCoreValidateAddress();
$validateAddress->setUserId($userId); // Set User ID
$validateAddress->setAddress($_POST["address"]); // Set User ID
$validateAddress->setCurrencyCode($currency); // Set crypto ticker
$signature = $validateAddress->getValidateAddressSignature($secretKey); // Generate Signature
$validateAddress->setUsersignature($signature); // Generate Signature
$json = $validateAddress->getJson();

$response = $cryptoCoreCommunicator->sendValidateAddressRequest($json, 30);
$result = "";
try {
    $result = $cryptoCoreCommunicator->processValidateAddressResponse($response);
} catch (\Exception $e) {
    echo "Fail to process: " . $e->getMessage();
    exit();
}

if ($result->is_valid == true) {
    $faucetSubmit = new CryptoCoreFaucetSubmit();
    $faucetSubmit->setUserId($userId); // Set User ID
    $faucetSubmit->setAddress($_POST["address"]); // Set receiving address
    $faucetSubmit->setCurrencyCode($currency); // Set crypto ticker
    $faucetSubmit->setFaucetKey($faucetKey); // Set Faucet Key
    $faucetSubmit->setAmount(0.0001); // Set amount
    $faucetSubmit->setFaucetAdditionalData("{any_json_data:1}");
    $signature = $faucetSubmit->getFaucetSubmitSignature($secretKey); // Generate Signature
    $faucetSubmit->setUsersignature($signature); // Generate Signature
    $json = $faucetSubmit->getJson();
} else {
    echo "Wrong address";
    exit();
}

$response = $cryptoCoreCommunicator->sendClaimFaucetRequest($json, 30);
$result = "";
try {
    $result = $cryptoCoreCommunicator->processClaimFaucetResponse($response);
} catch (\Exception $e) {
    echo "Fail to process: " . $e->getMessage();
    exit();
}
echo "Faucet request success. Request ID: " . $result->faucet_request_id;