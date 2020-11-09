<?php
use CryptoCore\Api\CryptoCoreValidatePost;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("../Api/CryptocoreCommunicator.php");
include ("../Api/CryptoCoreValidatePost.php");

$secretKey = "secretkey"; // Put your secret key here
$post = file_get_contents('php://input');
$request = new CryptoCoreValidatePost();
try {
    $response = $request->validateRequest($post, $secretKey);
    //Logic for correct request
    header("HTTP/1.0 200 OK");
    exit();
} catch (\Exception $e) {
    //Logic for wrong request
    header('HTTP/1.0 403 Forbidden');
    exit();
}