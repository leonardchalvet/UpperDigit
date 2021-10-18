<?php

session_start();

require_once '../../../config.php';
require_once '../../../vendor/autoload.php';

$mail = isset($_POST['email'])  ?  trim($_POST['email']) : null ;

if( $mail != null ) {

    $stripe = new \Stripe\StripeClient(STRIPE);
    $customer = $stripe->customers->all(['limit' => 1, 'email' => $mail])->data[0];
    $invoice = $stripe->invoices->all(['customer' => $customer['id']]);

    if(!empty($invoice['data'][0]['subscription'])) {
        $stripe->subscriptions->cancel($invoice['data'][0]['subscription'],[]);

        try { 
            $dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
        } catch ( PDOException $e ) { }

        $query = 'SELECT * FROM `customers` WHERE `email` = :email;';
        $st = $dbh->prepare($query);
        $st->execute(array(':email' => $mail));
        $rep = $st->fetch();
        $id_user = $rep['id'];

        $unsubscribe = date("d/m/Y");
        $query = 'UPDATE customers SET unsubscribe=? WHERE id=?;';
        $st = $dbh->prepare($query);
        $st->execute([$unsubscribe, $id_user]);

        $_SESSION['unsubscribe'] = $unsubscribe;
    }

}