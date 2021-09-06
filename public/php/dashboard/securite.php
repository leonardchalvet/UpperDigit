<?php 

session_start();

require_once '../../../config.php';
require_once '../../../vendor/autoload.php';

$email      = isset($_POST['email'])       ?  trim($_POST['email'])      : null ;
$password   = isset($_POST['password1'])  ?  trim($_POST['password1']) : null ;

$mail = $_SESSION['user_email'];

try { 
    $dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
} catch ( PDOException $e ) { }

if( $email != null
    && $mail != null ) {

    $query = 'UPDATE customers SET email=? WHERE email=?;';
    $st = $dbh->prepare($query);
    $st->execute([$email, $mail]);

    $_SESSION['user_email'] = $email;

    $stripe = new \Stripe\StripeClient(STRIPE);
    $customer = $stripe->customers->all(['limit' => 1, 'email' => $mail])->data[0];

    $stripe->customers->update(
        $customer['id'],
        ['email' => $email]
    );

}

if( $password != null ) {

    $user_password = password_hash($password, PASSWORD_DEFAULT);

    $query = 'UPDATE customers SET password=? WHERE email=?;';
    $st = $dbh->prepare($query);
    $st->execute([$user_password, $email]);
}