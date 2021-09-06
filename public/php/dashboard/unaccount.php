<?php

session_start();

require_once '../../../config.php';
require_once '../../../vendor/autoload.php';

$mail = isset($_POST['email'])  ?  trim($_POST['email']) : null ;

print_r ( $_POST ) ;

if( $mail != null ) {

    $stripe = new \Stripe\StripeClient(STRIPE);
    $customer = $stripe->customers->all(['limit' => 1, 'email' => $mail])->data[0];
    $stripe->customers->delete($customer['id'],[]);
    
    try {
        $dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
    } catch ( PDOException $e ) {  }

    $query = 'DELETE FROM `customers` WHERE email=?';
    $st = $dbh->prepare($query);
    $st->execute([$mail]);

    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
}