<?php

require('config.php');
require('razorpay-php/Razorpay.php');
@session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//

$orderData = [
    'receipt'         => 3456,
    'amount'          => $_SESSION['Payment_details']['amount'] * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

/*if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}*/

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "AAN",
    "description"       => "AAN",
    "image"             => "../../Resources/images/logo.png",
    "prefill"           => [
    "name"              => $_SESSION['Payment_details']['Name'],
    "email"             => "customer@merchant.com",
    "contact"           => $_SESSION['Payment_details']['Contact_no'],
    ],
    "notes"             => [
    "address"           => $_SESSION['Payment_details']['address'],
    "merchant_order_id" => $_SESSION['Payment_details']['merchant_order_id'],
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/{$checkout}.php");
