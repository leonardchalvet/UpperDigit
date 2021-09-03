<?php

require_once '../../config.php';

$mail = isset($_POST['mail']) ? trim($_POST['mail']) : null ;

if( $mail != null ) {

    try { 
		$dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
	} catch ( PDOException $e ) { }

    $query = 'SELECT * FROM `customers` WHERE `email` = :email;';
    $st = $dbh->prepare($query);
    $st->execute(array(':email' => $mail));
    $rep = $st->fetch();
    $id_user = $rep['id'];

    $headers = array(
        'From' => 'Upperdigit',
        'X-Mailer' => 'PHP/' . phpversion()
    );

    if( empty($rep) ) {

        $content =  "Vous n'avez pas de compte chez nous, vous devez en créer un.";
    
        mail($mail, 'Création de compte', $content, $headers);

    } else {

        $randPassword = rand(1000, 9999).'-'.rand(1000, 9999).'-'.rand(1000, 9999).'-'.rand(1000, 9999);
	    $user_password = password_hash($randPassword, PASSWORD_DEFAULT);

        $query = 'UPDATE customers SET password=? WHERE email=?';
        $st = $dbh->prepare($query);
        $st->execute([$user_password, $mail]);
    
        $content =  "Votre nouveau mot de passe (pensez à le changer) : " .$randPassword;
    
        mail($mail, 'Création de compte', $content, $headers);
    }

}