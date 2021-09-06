<?php 

require_once '../../../config.php';
require_once '../../../vendor/autoload.php';

$lastname   = isset($_POST['lastname'])    ?  trim($_POST['lastname'])   : null ;
$firstname  = isset($_POST['firstname'])   ?  trim($_POST['firstname'])  : null ;
$phone      = isset($_POST['phone'])       ?  trim($_POST['phone'])      : null ;
$adress     = isset($_POST['adress'])      ?  trim($_POST['adress'])     : null ;
$zipcode    = isset($_POST['zipcode'])     ?  trim($_POST['zipcode'])    : null ;
$country    = isset($_POST['country'])     ?  trim($_POST['country'])    : null ;
$mail       = isset($_POST['mail'])        ?  trim($_POST['mail'])       : null ;
$password   = isset($_POST['password-1'])  ?  trim($_POST['password-1']) : null ;
$cgu        = isset($_POST['cgu'])         ?  trim($_POST['cgu'])        : null ;
$inform     = isset($_POST['inform'])      ?  trim($_POST['inform'])     : null ;
$company    = isset($_POST['company'])     ?  trim($_POST['company'])    : null ;
$siret      = isset($_POST['siret'])       ?  trim($_POST['siret'])      : null ;
$headoffice = isset($_POST['headoffice'])  ?  trim($_POST['headoffice']) : null ;
$pc_adress  = isset($_POST['pc_adress'])   ?  trim($_POST['pc_adress'])  : null ;
$pc_zipcode = isset($_POST['pc_zipcode'])  ?  trim($_POST['pc_zipcode']) : null ;
$pc_country = isset($_POST['pc_country'])  ?  trim($_POST['pc_country']) : null ;
$intent     = isset($_POST['intent'])      ?  trim($_POST['intent'])     : null ;

if( $lastname != null
	&& $firstname != null
	&& $phone != null
	&& $adress != null
	&& $zipcode != null
	&& $country != null
	&& $mail != null
	&& $password != null
	&& $cgu != null
	&& $inform != null ) {

	try { 
		$dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
	} catch ( PDOException $e ) { }

    $user_password = password_hash($password, PASSWORD_DEFAULT);

    /* ADD IN BDD */
    $query = 'INSERT INTO `customers` (`email`, `password`, `cgu`, `want_news`) VALUES (:email, :password, :cgu, :want_news);';
    $st = $dbh->prepare($query);
    $st->execute(array(
        ':email' => $mail,
        ':password' => $user_password,
        ':cgu' => 1,
        ':want_news' => 1,
    ));

    $query = 'SELECT * FROM `customers` WHERE `email` = :email;';
    $st = $dbh->prepare($query);
    $st->execute(array(':email' => $mail));
    $rep = $st->fetch();
    $id_user = $rep['id'];

    $query = 'INSERT INTO `personal_information` (`id_customers`, `first_name`, `last_name`, `phone`, `adress`, `zip_code`, `country`) VALUES (:id_customers, :first_name, :last_name, :phone, :adress, :zip_code, :country);';
    $st = $dbh->prepare($query);
    $st->execute(array(
        ':id_customers' => $id_user,
        ':first_name' => $firstname,
        ':last_name' => $lastname,
        ':phone' => $phone,
        ':adress' => $adress,
        ':zip_code' => $zipcode,
        ':country' => $country
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