<?php 

session_start();

require_once '../../../config.php';
require_once '../../../vendor/autoload.php';

$lastname   = isset($_POST['lastname'])    ?  trim($_POST['lastname'])   : null ;
$firstname  = isset($_POST['firstname'])   ?  trim($_POST['firstname'])  : null ;
$phone      = isset($_POST['phone'])       ?  trim($_POST['phone'])      : null ;
$adress     = isset($_POST['adress'])      ?  trim($_POST['adress'])     : null ;
$zipcode    = isset($_POST['zipcode'])     ?  trim($_POST['zipcode'])    : null ;
$country    = isset($_POST['country'])     ?  trim($_POST['country'])    : null ;

$mail = $_SESSION['user_email'];

if( $lastname != null
	&& $firstname != null
	&& $phone != null
	&& $adress != null
	&& $zipcode != null
	&& $country != null
	&& $mail != null ) {

	try { 
		$dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
	} catch ( PDOException $e ) { }

    $query = 'SELECT * FROM `customers` WHERE `email` = :email;';
    $st = $dbh->prepare($query);
    $st->execute(array(':email' => $mail));
    $rep = $st->fetch();
    $id_user = $rep['id'];

    $query = 'UPDATE personal_information SET first_name=?, last_name=?, phone=?, adress=?, zip_code=?, country=? WHERE id_customers=?';
    $st = $dbh->prepare($query);
    $st->execute([$firstname, $lastname, $phone, $adress, $zipcode, $country, $id_user]);
}