<?php 

require_once '../../config.php';
require_once '../../vendor/autoload.php';

$mail       = isset($_POST['mail'])        ?  trim($_POST['mail'])       : null ;
$company    = isset($_POST['company'])     ?  trim($_POST['company'])    : null ;
$siret      = isset($_POST['siret'])       ?  trim($_POST['siret'])      : null ;
$headoffice = isset($_POST['headoffice'])  ?  trim($_POST['headoffice']) : null ;
$pc_adress  = isset($_POST['pc_adress'])   ?  trim($_POST['pc_adress'])  : null ;
$pc_zipcode = isset($_POST['pc_zipcode'])  ?  trim($_POST['pc_zipcode']) : null ;
$pc_country = isset($_POST['pc_country'])  ?  trim($_POST['pc_country']) : null ;

if( $company != null
    && $siret != null
    && $headoffice != null
    && $pc_adress != null
    && $pc_zipcode != null
    && $pc_country != null
    && $mail != null ) {

	try { 
		$dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
	} catch ( PDOException $e ) { }

    $query = 'SELECT * FROM `customers` WHERE `email` = :email;';
    $st = $dbh->prepare($query);
    $st->execute(array(':email' => $mail));
    $rep = $st->fetch();
    $id_user = $rep['id'];

    $query = 'UPDATE `professional_information` (`name`, `siret`, `head_office`, `adress`, `zip_code`, `country`) VALUES (:name, :siret, :head_office, :adress, :zip_code, :country) WHERE `id_customers` = :id_customers;';
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