<?php


use CryptoCore\Api\CryptoCoreCommunicator;
use CryptoCore\Api\CryptoCoreExchange;
use CryptoCore\Api\CryptoCoreRates;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ("../Api/CryptoCoreCommunicator.php");
include ("../Api/CryptoCoreExchange.php");
include ("../Api/CryptoCoreRates.php");

$secretKey = "secretkey";
$userId = 1911120;
$mainCurrency = 'USD';
$changeToCurrency = 'BTC_TST';

$cryptoCoreExchange = new CryptoCoreExchange();
$cryptoCoreCommunicator = new CryptoCoreCommunicator();
$cryptoCoreExchange->setUserId($userId);
$cryptoCoreExchange->setFrom($mainCurrency);
$cryptoCoreExchange->setTo($changeToCurrency);
$signature = $cryptoCoreExchange->newExchangeSignature($secretKey);
$cryptoCoreExchange->setSignature($signature);
$json = $cryptoCoreExchange->getJson();
$result = $cryptoCoreCommunicator->sendGetExchnageRateRequest($json, 30);
try {
    $cryptoCoreRates = new CryptoCoreRates($result);
} catch (Exception $e) {
    // logic if error;
}
$rate1 = $cryptoCoreRates->getRate($mainCurrency, $changeToCurrency, 14);
$rate2 = $cryptoCoreRates->getRate($mainCurrency, $changeToCurrency, 20);
$rate3 = $cryptoCoreRates->getRate($mainCurrency, $changeToCurrency, 10);
$rate4 = $cryptoCoreRates->getRate($mainCurrency, $changeToCurrency, 11.99);

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
        $(document).ready(function() {

        });
    </script>

</head>
<body style="">





<!-- ========================= SECTION INTRO ========================= -->
<section class="section-intro padding-y-sm">
    <div class="container">

        <div class="intro-banner-wrap">
            <img src="./ui/0.jpg" class="img-fluid rounded">
        </div>

    </div>
</section>

<section class="section-content">
    <div class="container">

        <header class="section-heading">
            <h3 class="section-title">Products for sale</h3>
        </header><!-- sect-heading -->


        <div class="row">
            <div class="col-md-3">
                <div href="#" class="card card-product-grid">
                    <span class="img-wrap"> <img src="./ui/1.jpg"> </span>
                    <figcaption class="info-wrap">
                        <span class="title">Just another product name</span>
                        <div class="price mt-1">0.014 BTC_TST</div> <!-- price-wrap.// -->
                    </figcaption>
                    <a href="post.php?id=1" class="btn btn-primary">Buy now</a>
                </div>
            </div> <!-- col.// -->
            <div class="col-md-3">
                <div href="#" class="card card-product-grid">
                    <span class="img-wrap"> <img src="./ui/2.jpg"> </span>
                    <figcaption class="info-wrap">
                        <span class="title">Some item name here</span>
                        <div class="price mt-1">0.0015 BTC_TST</div> <!-- price-wrap.// -->
                    </figcaption>
                    <a href="post.php?id=2" class="btn btn-primary">Buy now</a>
                </div>
            </div> <!-- col.// -->
            <div class="col-md-3">
                <div href="#" class="card card-product-grid">
                    <span class="img-wrap"> <img src="./ui/3.jpg"> </span>
                    <figcaption class="info-wrap">
                        <span class="title">Great product name here</span>
                        <div class="price mt-1">0.0012 BTC_TST</div> <!-- price-wrap.// -->
                    </figcaption>
                    <a href="post.php?id=3" class="btn btn-primary">Buy now</a>
                </div>
            </div> <!-- col.// -->
            <div class="col-md-3">
                <div href="#" class="card card-product-grid">
                    <span class="img-wrap"> <img src="./ui/4.jpg"> </span>
                    <figcaption class="info-wrap">
                        <span class="title">Just another product name</span>
                        <div class="price mt-1">0.001 BTC_TST</div> <!-- price-wrap.// -->
                    </figcaption>
                    <a href="post.php?id=4" class="btn btn-primary">Buy now</a>
                </div>
            </div> <!-- col.// -->
        </div> <!-- row.// -->

        <div class="row">
            <div class="col-md-3">
                <div href="#" class="card card-product-grid">
                    <span class="img-wrap"> <img src="./ui/1.jpg"> </span>
                    <figcaption class="info-wrap">
                        <span class="title">Just another product name</span>
                        <div class="price mt-1">14 USD (<?php echo $rate1->amount." ".$rate1->to_currency; ?>) </div> <!-- price-wrap.// -->
                    </figcaption>
                    <a href="post.php?id=5" class="btn btn-primary">Buy now</a>
                </div>
            </div> <!-- col.// -->
            <div class="col-md-3">
                <div href="#" class="card card-product-grid">
                    <span class="img-wrap"> <img src="./ui/2.jpg"> </span>
                    <figcaption class="info-wrap">
                        <span class="title">Some item name here</span>
                        <div class="price mt-1">20 USD (<?php echo $rate2->amount." ".$rate2->to_currency; ?>)</div> <!-- price-wrap.// -->
                    </figcaption>
                    <a href="post.php?id=6" class="btn btn-primary">Buy now</a>
                </div>
            </div> <!-- col.// -->
            <div class="col-md-3">
                <div href="#" class="card card-product-grid">
                    <span class="img-wrap"> <img src="./ui/3.jpg"> </span>
                    <figcaption class="info-wrap">
                        <span class="title">Great product name here</span>
                        <div class="price mt-1">10 USD (<?php echo $rate3->amount." ".$rate3->to_currency; ?>)</div> <!-- price-wrap.// -->
                    </figcaption>
                    <a href="post.php?id=7" class="btn btn-primary">Buy now</a>
                </div>
            </div> <!-- col.// -->
            <div class="col-md-3">
                <div href="#" class="card card-product-grid">
                    <span class="img-wrap"> <img src="./ui/4.jpg"> </span>
                    <figcaption class="info-wrap">
                        <span class="title">Just another product name</span>
                        <div class="price mt-1">11.99 USD (<?php echo $rate4->amount." ".$rate4->to_currency; ?>)</div> <!-- price-wrap.// -->
                    </figcaption>
                    <a href="post.php?id=8" class="btn btn-primary">Buy now</a>
                </div>
            </div> <!-- col.// -->
        </div>

    </div> <!-- container .//  -->
</section>



</body></html>