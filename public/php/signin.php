<?php

session_start();

require_once '../../config.php';

$email    = isset($_POST['email'])     ?  trim($_POST['email'])    : null ;
$password = isset($_POST['password'])  ?  trim($_POST['password']) : null ;

if( $email != null
	&& $password != null ) {

	try {
		$dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
	} catch ( PDOException $e ) {  }

	$query = 'SELECT * FROM `customers` WHERE `email` = :email;';
	$st = $dbh->prepare($query);
	$st->execute(array(':email' => $email));
	$rep = $st->fetch();

	if ( password_verify( $password, $rep['password']) ) {
		$_SESSION['user_id']     =  $rep['id'];
		$_SESSION['user_email']  =  $rep['email'];
		$_SESSION['unsubscribe'] =  $rep['unsubscribe'];

		$query = 'SELECT * FROM `personal_information` WHERE `id_customers` = :id_customers;';
		$st = $dbh->prepare($query);
		$st->execute(array(':id_customers' => $rep['id']));
		$personal_information = $st->fetch();

		$_SESSION['name'] = $personal_information['first_name'];

		echo 'true';
	}
	else {
		echo 'false';
	}
}
else {
	echo 'false';
}

?>