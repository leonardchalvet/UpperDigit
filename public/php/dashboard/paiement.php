<?php 

session_start();

require_once '../../../config.php';
require_once '../../../vendor/autoload.php';

$name   = isset($_POST['name'])    ?  trim($_POST['name'])   : null ;
$intent = isset($_POST['intent'])  ?  trim($_POST['intent']) : null ;

if( $name != null 
    && $intent != null ) {

    \Stripe\Stripe::setApiKey(STRIPE);

    $stripe = new \Stripe\StripeClient(STRIPE);
    $customer = $stripe->customers->all(['limit' => 1, 'email' => $_SESSION['user_email']])->data[0];

    $intent = Stripe\SetupIntent::retrieve($intent);
    $payment_method = \Stripe\PaymentMethod::retrieve($intent->payment_method);

    $payment_method->attach(['customer' => $customer['id']]);

    \Stripe\Customer::update(
        $customer['id'],
        ['invoice_settings' => ['default_payment_method' => $payment_method]]
    );

}
