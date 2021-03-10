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