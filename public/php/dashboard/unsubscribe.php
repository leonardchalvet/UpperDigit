<?php

require_once '../../../config.php';
require_once '../../../vendor/autoload.php';

$mail = isset($_POST['email'])  ?  trim($_POST['email']) : null ;

if( $mail != null ) {

    $stripe = new \Stripe\StripeClient(STRIPE);
    $customer = $stripe->customers->all(['limit' => 1, 'email' => $mail])->data[0];
    $invoice = $stripe->invoices->all(['customer' => $customer['id']]);

    if(!empty($invoice['data'][0]['subscription'])) {
        $stripe->subscriptions->cancel($invoice['data'][0]['subscription'],[]);
    }

}