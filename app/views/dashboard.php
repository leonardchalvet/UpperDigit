<?php 

function monthInFrench($m) {
	if($m == 1) return 'Janvier';
	else if($m == 2) return 'Février';
	else if($m == 3) return 'Mars';
	else if($m == 4) return 'Avril';
	else if($m == 5) return 'Mai';
	else if($m == 6) return 'Juin';
	else if($m == 7) return 'Juillet';
	else if($m == 8) return 'Aout';
	else if($m == 9) return 'Septembre';
	else if($m == 10) return 'Octobre';
	else if($m == 11) return 'Novambre';
	else if($m == 12) return 'Décembre';
}

use Prismic\Dom\RichText;
$document = $WPGLOBAL['document']->data;

$email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null ;

if($email == null) {
  header('Location: ' . getUrl() );
  exit();
}

try {
	$dbh = new PDO("mysql:dbname=".DB_BASE.";host=".DB_HOST, BD_USER, BD_PASSWORD);
} catch ( PDOException $e ) {  }

$query = 'SELECT * FROM `customers` WHERE `email` = :email;';
$st = $dbh->prepare($query);
$st->execute(array(':email' => $email));
$customers = $st->fetch();

$query = 'SELECT * FROM `personal_information` WHERE `id_customers` = :id_customers;';
$st = $dbh->prepare($query);
$st->execute(array(':id_customers' => $customers['id']));
$personal_information = $st->fetch();

$query = 'SELECT * FROM `professional_information` WHERE `id_customers` = :id_customers;';
$st = $dbh->prepare($query);
$st->execute(array(':id_customers' => $customers['id']));
$professional_information = $st->fetch();

$stripe = new \Stripe\StripeClient(STRIPE);
$customer = $stripe->customers->all(['limit' => 1, 'email' => $email])->data[0];
$invoice = $stripe->invoices->all(['customer' => $customer['id']]);
$card = $stripe->customers->allSources($customer['id'], ['object' => 'card']);
print_r( $card );
?>
<html>
  <head>

    <?php include('common-noindex.php') ?>

    <title><?= RichText::asText($document->global_title); ?></title>

    <meta name="description" content="<?= RichText::asText($document->global_description); ?>" />

    <meta http-equiv="content-type" content="text/html; charset=utf8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/style/css/dashboard.css">

  </head>
  
  <body>

    <?php include('common-lightbox.php') ?>

    <?php include('common-header.php') ?>

    <main>
      
      <section class="section-dashboard">
			<div class="wrapper">
				<div class="container-sidebar">
					<div class="title"><?= RichText::asText($document->nav_title); ?></div>
					<ul class="container-tab">
						<li class="tab style-active">
							<span><?= RichText::asText($document->nav_informations); ?></span>
						</li>
						<li class="tab">
							<span><?= RichText::asText($document->nav_invoices); ?></span>
						</li>
					</ul>
				</div>
				<div class="container-informations">
					<section class="section-informations">
						<div class="head">
							<div class="title"><?= RichText::asText($document->informations_title); ?></div>
							<div class="container-btn">
								<div class="btn">
									<div class="btn-text"><?= RichText::asText($document->nav_btntextedit); ?></div>
								</div>
								<div class="btn">
									<div class="btn-text"><?= RichText::asText($document->nav_btntextregister); ?></div>
								</div>
							</div>
						</div>
						<div class="container-content">
							<div class="content-save">
								<div class="container-el">
									<div class="el">
										<ul>
											<li>
												<div class="title"><?= RichText::asText($document->informations_lastname); ?></div>
												<div class="text"><?php echo($personal_information['last_name']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_firstname); ?></div>
												<div class="text"><?php echo($personal_information['first_name']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_phone); ?></div>
												<div class="text"><?php echo($personal_information['phone']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_adress); ?></div>
												<div class="text"><?php echo($personal_information['adress']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_zipcode); ?></div>
												<div class="text"><?php echo($personal_information['zip_code']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_pays); ?></div>
												<div class="text"><?php echo($personal_information['country']); ?></div>
											</li>
										</ul>
									</div>
									<div class="el">
										<ul>
											<li>
												<div class="title"><?= RichText::asText($document->informations_email); ?></div>
												<div class="text"><?php echo($email); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_password); ?></div>
												<div class="text">********</div>
											</li>
										</ul>
									</div>
									<div class="el">
										<ul>
											<li>
												<div class="title"><?= RichText::asText($document->informations_cardholder); ?></div>
												<div class="text"><?php echo($card->name); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_cardnumber); ?></div>
												<div class="text"><?php echo($card->brand.' ****  ****  **** '.$card->last4); ?></div>
											</li>
										</ul>
									</div>
									<?php if( !empty($professional_information) ) { ?>
									<div class="el">
										<ul>
											<li>
												<div class="title"><?= RichText::asText($document->informations_company); ?></div>
												<div class="text"><?php echo($professional_information['name']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_siret); ?></div>
												<div class="text"><?php echo($professional_information['siret']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_headoffice); ?></div>
												<div class="text"><?php echo($professional_information['head_office']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_proadress); ?></div>
												<div class="text"><?php echo($professional_information['adress']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_prozipcode); ?></div>
												<div class="text"><?php echo($professional_information['zip_code']); ?></div>
											</li>
											<li>
												<div class="title"><?= RichText::asText($document->informations_procountry); ?></div>
												<div class="text"><?php echo($professional_information['country']); ?></div>
											</li>
										</ul>
									</div>
									<?php } ?>
								</div>
							</div>
							<div class="content-edit">
								<div class="container-el">
									<div class="el" data-info="perso">
										<div class="title"><?= RichText::asText($document->informations_title1); ?></div>
										<div class="container-input">
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $personal_information['last_name']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $personal_information['first_name']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $personal_information['phone']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $personal_information['adress']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $personal_information['zip_code']; ?>">
													<div class="error">Error</div>
												</div>
												<div class="input">
													<input required type="text" value="<?php echo $personal_information['country']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
										</div>
									</div>
									<div class="el" data-info="securite">
										<div class="title"><?= RichText::asText($document->informations_title2); ?></div>
										<div class="container-input">
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo($email); ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="password" placeholder="<?= RichText::asText($document->informations_password); ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="password" placeholder="<?= RichText::asText($document->informations_password); ?>">
													<div class="error">Error</div>
												</div>
											</div>
										</div>
									</div>
									<div class="el" data-info="paiement">
										<div class="title"><?= RichText::asText($document->informations_title3); ?></div>
										<div class="container-input">
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $personal_information['last_name']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo ""; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo ""; ?>">
													<div class="error">Error</div>
												</div>
												<div class="input">
													<input required type="text" value="<?php echo ""; ?>">
													<div class="error">Error</div>
												</div>
											</div>
										</div>
									</div>
									<?php if( !empty($professional_information) ) { ?>
									<div class="el" data-info="pro">
										<div class="title"><?= RichText::asText($document->informations_title4); ?></div>
										<div class="container-input">
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $professional_information['name']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $professional_information['siret']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $professional_information['head_office']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $professional_information['adress']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" value="<?php echo $professional_information['zip_code']; ?>">
													<div class="error">Error</div>
												</div>
												<div class="input">
													<input required type="text" value="<?php echo $professional_information['country']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</section>
					<section class="section-bill">
						<div class="head">
							<div class="title"><?= RichText::asText($document->invoices_title); ?></div>
						</div>
						<ul>
							<?php foreach ($invoice->data as $i) {
							$date = new DateTime();
							$date->setTimestamp($i->created);
							?>
							<li>
								<div class="num"><?php echo($i->number); ?></div>
								<div class="month"><?php echo(monthInFrench(date_format($date, 'm'))) ?></div>
								<div class="date"><?php echo(date_format($date, 'd/m/Y')); ?></div>
								<a href="<?php echo($i->hosted_invoice_url); ?>" class="link" target="_blank">
									<span class="link-text"><?= RichText::asText($document->invoices_download); ?></span>
								</a>
							</li>
							<?php } ?>
						</ul>
					</section>
				</div>
			</div>
		</section>

    </main>

    <?php include('common-footer.php') ?>

    <script type="text/javascript" src="/script/minify/dashboard-min.js"></script>
  </body>
</html>