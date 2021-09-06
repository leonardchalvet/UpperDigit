<?php

require_once '../../config.php';

$name    = isset($_POST['name'])    ? trim($_POST['name'])    : null ;
$mail    = isset($_POST['email'])   ? trim($_POST['email'])   : null ;
$message = isset($_POST['message']) ? trim($_POST['message']) : null ;

if( $name != null 
    && $mail != null
    && $message != null ) {

    $headers = array(
        'From' => $mail,
        'Reply-To' => $mail,
        'X-Mailer' => 'PHP/' . phpversion()
    );

    $content =  $message;
    
    mail($mail, 'Contact', $content, $headers);

    echo 'true';

}