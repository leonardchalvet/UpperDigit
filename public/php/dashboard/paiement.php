<?php 

session_start();

require_once '../../../config.php';
require_once '../../../vendor/autoload.php';

$name   = isset($_POST['name'])    ?  trim($_POST['name'])   : null ;
$intent = isset($_POST['intent'])  ?  trim($_POST['intent']) : null ;

if( $name != null 
    && $intent != null ) {

    $_SESSION['user_email'] = $email;

    $stripe = new \Stripe\StripeClient(STRIPE);
    $customer = $stripe->customers->all(['limit' => 1, 'email' => $mail])->data[0];

    echo $intent;

    /*$stripe->customers->updateSource(
        $customer['id'],
        'card_1JWhQeFhVHJZbiNt8COz3rxV',
        ['name' => $name]
    );*/

}
