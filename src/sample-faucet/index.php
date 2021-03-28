<?php

use CryptoCore\Api\CryptoCoreCommunicator;
use CryptoCore\Api\CryptoCoreGetFaucet;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../Api/CryptoCoreCommunicator.php");
include("../Api/CryptoCoreGetFaucet.php");

$secretKey = "secretkey";
$userId = 1911120;
$faucetKey = "faucetkey";

$getFaucet = new CryptoCoreGetFaucet();
$cryptoCoreCommunicator = new CryptoCoreCommunicator();
$getFaucet->setUserId($userId); // Set User ID
$getFaucet->setFaucetKey($faucetKey); // Set faucet ID
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="max-age=604800">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>CryptoCore sample Payment Gateway Integration</title>
    <!-- jQuery -->
    <script src="./ui/jquery-2.0.0.min.js" type="text/javascript"></script>

    <!-- Bootstrap4 files-->
    <script src="./ui/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="./ui/bootstrap.css" rel="stylesheet" type="text/css">

    <!-- Font awesome 5 -->
    <link href="./ui/all.min.css" type="text/css" rel="stylesheet">

    <!-- custom style -->
    <link href="./ui/ui.css" rel="stylesheet" type="text/css">
    <link href="./ui/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)">

    <!-- custom javascript -->
    <script src="./ui/script.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>

</head>
<body>
<table style="border: 1px solid #000000">
    <tr>
        <td>
            faucet_key
        </td>
        <td>
            <?php echo $result->faucet_key; ?>
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
            amount_claimed
        </td>
        <td>
            <?php echo $result->amount_claimed; ?>
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
            faucet_name
        </td>
        <td>
            <?php echo $result->faucet_name; ?>
        </td>
    </tr>
    <tr>
        <td>
            min_ask_amount
        </td>
        <td>
            <?php echo $result->min_ask_amount; ?>
        </td>
    </tr>
</table>
<br/>
<br/>
<form action="claim.php" method="post">
    <table style="border: 1px solid #000000">
        <tr>
            <td>
                amount to claim
            </td>
            <td>
                <input name="amount" value="<?php echo $result->min_ask_amount; ?>" style="width: 300px">
            </td>
        </tr>
        <tr>
            <td>
                Address (valid <?php echo $result->currency_code; ?> address)
            </td>
            <td>
                <input name="address" style="width: 300px" value="2MsdBzVvKQ7HgNtpV9dQnBeT3xTMxaCg7h5">
            </td>
        </tr>
        <tr>
            <td>

            </td>
            <td>
                <input type="submit">
            </td>
        </tr>
    </table>
</form>
</body>
</html>