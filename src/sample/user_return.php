<?php
use CryptoCore\Api\CryptoCoreCommunicator;
use CryptoCore\Api\CryptoCoreGetOrder;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("../Api/CryptoCoreCommunicator.php");
include ("../Api/CryptoCoreGetOrder.php");

$secretKey = "secretkey"; // Put your secret key here
$userId = 1911120; // Put your user id here

$paymentId = $_GET["cc_payment_id"];

$getOrder = new CryptoCoreGetOrder();
$newCommunicator = new CryptoCoreCommunicator();
$getOrder->setUserId($userId); // Set User ID
$getOrder->setPaymentId($paymentId); // Set payment ID
$signature = $getOrder->getOrderSignature($secretKey); // Generate Signature
$getOrder->setUsersignature($signature); // Generate Signature
$json = $getOrder->getJson();

$response = $newCommunicator->sendGetOrderRequest($json, 30); // Send Get ORDER request
$result = "";
try {
    $result = $newCommunicator->processResponse($response);
} catch (\Exception $e) {
    echo "Fail to process: " . $e->getMessage();
    exit();
}
?>
<html>
<table>
    <tr>
        <td>
            payment_id
        </td>
        <td>
            <?php echo $result->payment_id; ?>
        </td>
    </tr>
    <tr>
        <td>
            order_id
        </td>
        <td>
            <?php echo $result->order_id; ?>
        </td>
    </tr>
    <tr>
        <td>
            wallet_address
        </td>
        <td>
            <?php echo $result->wallet_address; ?>
        </td>
    </tr>
    <tr>
        <td>
            currency_code
        </td>
        <td>
            <?php echo $result->currency_code; ?>
        </td>
    </tr>
    <tr>
        <td>
            payment_status
        </td>
        <td>
            <?php echo $result->payment_status; ?>
        </td>
    </tr>
    <tr>
        <td>
            order_status
        </td>
        <td>
            <?php echo $result->order_status; ?>
        </td>
    </tr>
    <tr>
        <td>
            amount
        </td>
        <td>
            <?php echo $result->amount; ?>
        </td>
    </tr>
    <tr>
        <td>
            transactionresponse
        </td>
        <td>
            <?php
            foreach($result->transactionresponse as $tx)
            {
                echo $tx->tx.' ';
                echo $tx->amount.' ';
                echo $tx->currency_code;
                echo '<br />';
            }
            ?>
        </td>
    </tr>
</table>
</html>