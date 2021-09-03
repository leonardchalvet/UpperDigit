<?php 

require_once '../../config.php';
require_once '../../vendor/autoload.php';

$mail       = isset($_POST['mail'])        ?  trim($_POST['mail'])       : null ;
$password   = isset($_POST['password-1'])  ?  trim($_POST['password-1']) : null ;

if( $mail != null
	&& $password != null ) {

	try { 
		$dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
	} catch ( PDOException $e ) { }

    $user_password = password_hash($password, PASSWORD_DEFAULT);

    $query = 'SELECT * FROM `customers` WHERE `email` = :email;';
    $st = $dbh->prepare($query);
    $st->execute(array(':email' => $mail));
    $rep = $st->fetch();
    $id_user = $rep['id'];

    $query = 'UPDATE `customers` (`email`, `password`) VALUES (:email, :password);';
    $st = $dbh->prepare($query);
    $st->execute(array(
        ':email' => $email,
        ':password' => $password
    ));

    if( $company != null
        && $siret != null
        && $headoffice != null
        && $pc_adress != null
        && $pc_zipcode != null
        && $pc_country != null ) {

        $query = 'INSERT INTO `professional_information` (`id_customers`, `name`, `siret`, `head_office`, `adress`, `zip_code`, `country`) VALUES (:id_customers, :name, :siret, :head_office, :adress, :zip_code, :country);';
        $st = $dbh->prepare($query);
        $st->execute(array(
            ':id_customers' => $id_user,
            ':name' => $company,
            ':siret' => $siret,
            ':head_office' => $headoffice,
            ':adress' => $pc_adress,
            ':zip_code' => $pc_zipcode,
            ':country' => $pc_country
        ));
    }

}