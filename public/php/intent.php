<?php 

require_once '../../config.php';
require_once '../../vendor/autoload.php';

\Stripe\Stripe::setApiKey(STRIPE);

$intentC = \Stripe\SetupIntent::create();

echo $intentC['id'].'|'.$intentC['client_secret'];