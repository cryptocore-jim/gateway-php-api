<?php
use CryptoCore\Api\CryptoCoreCommunicator;
use CryptoCore\Api\CryptoCoreNewOrder;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("../Api/CryptoCoreCommunicator.php");
include ("../Api/CryptoCoreNewOrder.php");


$secretKey = "secretkey"; // Put your secret key here
$userId = 1911120; // Put your user id here
$domain = "http://test-payment-domain";

$id = $_GET["id"];
$amount = 0;
$currencyCode = "BTC_TST";
$orderId = uniqid();
switch ($id) {
    case 1:
        $amount = 0.014;
        break;
    case 2:
        $amount = 0.0015;
        break;
    case 3:
        $amount = 0.0012;
        break;
    case 4:
        $amount = 0.001;
        break;
    default:
        header("location: index.php");;
        exit();
}

$newCommunicator = new CryptoCoreCommunicator();
$newOrder = new CryptoCoreNewOrder();
$newOrder->setAmount($amount); //Set amount to pay
$newOrder->setCurrencyCode($currencyCode); //Set base Currency Code
$newOrder->setOrderId($orderId); //Set your order ID
$newOrder->setPaymentCurrencyCode(""); //Empty - we do not use fiat now
$newOrder->setResultUrl($domain."/Sample/result.php"); // set result URL where Gateway sends report (optional)
$newOrder->setUserReturnUrl($domain."/Sample/user_return.php"); // set result URL where usr will return after payment made (optional)
$newOrder->setUserId($userId);
$userSignature = $newOrder->newOrderSignature($secretKey); //Generate user signature when all fields set
$newOrder->setUsersignature($userSignature); //set generated signature

$json = $newOrder->getJson();
$response = $newCommunicator->sendNewOrderRequest($json, 30);
$result = "";
try {
    $result = $newCommunicator->processResponse($response);
} catch (\Exception $e) {
    echo "Fail to process: " . $e->getMessage();
    exit();
}

//Save payment ID if need.
$url = $newCommunicator->getRedirectUrl($result->payment_id);

header("location:".$url);
?>