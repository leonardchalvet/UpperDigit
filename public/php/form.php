<?php 

$id_stripe  = isset($_POST['id_stripe'])   ?  trim($_POST['id_stripe'])  : null ;
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

print_r($_POST);

if( $id_stripe != null
	&& $lastname != null
	&& $firstname != null
	&& $phone != null
	&& $adress != null
	&& $zipcode != null
	&& $country != null
	&& $mail != null
	&& $password != null
	&& $cgu != null
	&& $inform != null
	&& $company != null
	&& $siret != null
	&& $headoffice != null
	&& $pc_adress != null
	&& $pc_zipcode != null
	&& $pc_country != null ) {

	echo $id_stripe . ' : ' . $lastname . ' : ' . $firstname . ' : ' . $phone . ' : ' . $adress . ' : ' . $zipcode . ' : ' . $country . ' : ' . $mail . ' : ' . $password . ' : ' . $cgu . ' : ' . $inform . ' : ' . $company . ' : ' . $siret . ' : ' . $headoffice . ' : ' . $pc_adress . ' : ' . $pc_zipcode . ' : ' . $pc_country;

}