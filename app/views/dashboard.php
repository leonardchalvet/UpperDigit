<?php 

session_start();

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
$product = $stripe->products->retrieve($invoice['data'][0]['lines']['data'][0]['plan']['product']);
$upcoming = null;
try {
	$upcoming = $stripe->invoices->upcoming(['customer' => $customer['id']]);
} catch (\Throwable $th) {
	//throw $th;
}

?>
<html>
  <head>

    <?php include('common-noindex.php') ?>

    <title><?= RichText::asText($document->global_title); ?></title>

    <meta name="description" content="<?= RichText::asText($document->global_description); ?>" />

    <meta http-equiv="content-type" content="text/html; charset=utf8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/style/css/dashboard.css">

	<script src="https://js.stripe.com/v3/"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

  </head>
  
  <body>

    <?php include('common-lightbox.php') ?>

    <?php include('common-header.php') ?>

    <main>

	<div class="container-lightbox">
		<form method="post">
			<input type="email" name="email" value="<?php echo($email); ?>">
		</form>
		<div class="wrapper">
			<div class="lightbox subscribe">
				<img src="/img/dashboard/cross.svg" alt="cross" class="cross">
				<h3><?= RichText::asText($document->subscribe_lgtbtitle); ?></h3>
				<p><?= RichText::asText($document->subscribe_lgtbtext); ?></p>
				<div class="container-button">
					<div class="btn">
						<div class="btn-text">
							<?= RichText::asText($document->subscribe_lgtbbtnno); ?>
						</div>
						<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
							<use xlink:href="/img/common/icn-arrow.svg#content"></use>
						</svg>
					</div>
					<div class="btn">
						<div class="btn-text">
							<?= RichText::asText($document->subscribe_lgtbbtnyes); ?>
						</div>
						<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
							<use xlink:href="/img/common/icn-arrow.svg#content"></use>
						</svg>
					</div>
				</div>
			</div>
			<div class="lightbox account">
				<img src="/img/dashboard/cross.svg" alt="cross" class="cross">
				<h3><?= RichText::asText($document->account_lgtbtitle); ?></h3>
				<p><?= RichText::asText($document->account_lgtbtext); ?></p>
				<div class="container-button">
					<div class="btn">
						<div class="btn-text">
							<?= RichText::asText($document->account_lgtbbtnno); ?>
						</div>
						<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
							<use xlink:href="/img/common/icn-arrow.svg#content"></use>
						</svg>
					</div>
					<div class="btn">
						<div class="btn-text">
							<?= RichText::asText($document->account_lgtbbtnyes); ?>
						</div>
						<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
							<use xlink:href="/img/common/icn-arrow.svg#content"></use>
						</svg>
					</div>
				</div>
			</div>
		</div>
	</div>
      
      <section class="section-dashboard">
		  	<div id="sectionInformation"></div>
			<div class="wrapper">
				<div class="container-sidebar">
					<div class="title"><?= RichText::asText($document->nav_title); ?></div>
					<ul class="container-tab">
						<li class="tab style-active">
							<a href="#sectionInformation"><?= RichText::asText($document->nav_informations); ?></a>
						</li>
						<li class="tab">
							<a href="#sectionBill"><?= RichText::asText($document->nav_invoices); ?></a>
						</li>
						<?php if($upcoming != null) { ?>
							<li class="tab">
								<a href="#sectionSubscribe"><?= RichText::asText($document->subscribe_title); ?></a>
							</li>
						<?php } ?>
						<li class="tab">
							<a href="#sectionAccount"><?= RichText::asText($document->account_title); ?></a>
						</li>
					</ul>
				</div>
				<div class="container-informations">
					<section class="section-informations">
						<div class="head">
							<div class="title"><?= RichText::asText($document->informations_title); ?></div>
							<div class="container-btn">
								<div class="btn style-active">
									<div class="btn-text"><?= RichText::asText($document->nav_btntextedit); ?></div>
								</div>
								<div class="btn">
									<div class="btn-text"><?= RichText::asText($document->nav_btntextregister); ?></div>
								</div>
							</div>
						</div>
						<div class="container-content">
							<div class="content-save style-active">
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
									<form class="el" data-info="perso">
										<input required type="text" value="<?php echo($email); ?>" name="mail" style="display:none;">
										<div class="title"><?= RichText::asText($document->informations_title1); ?></div>
										<div class="container-input">
											<div class="wrap-input">
												<div class="input">
													<input required type="text" name="lastname" value="<?php echo $personal_information['last_name']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" name="firstname" value="<?php echo $personal_information['first_name']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" name="phone" value="<?php echo $personal_information['phone']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" name="adress" value="<?php echo $personal_information['adress']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="text" name="zipcode" value="<?php echo $personal_information['zip_code']; ?>">
													<div class="error">Error</div>
												</div>
												<div class="input">
													<input required type="text" name="country" value="<?php echo $personal_information['country']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
										</div>
									</form>
									<form class="el" data-info="securite">
										<input required type="text" value="<?php echo($email); ?>" name="mail" style="display:none;">
										<div class="title"><?= RichText::asText($document->informations_title2); ?></div>
										<div class="container-input">
											<div class="wrap-input">
												<div class="input">
													<input required type="text" name="email" value="<?php echo($email); ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="password" name="password1" placeholder="<?= RichText::asText($document->informations_password); ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input required type="password" name="password2" placeholder="<?= RichText::asText($document->informations_password); ?>">
													<div class="error">Error</div>
												</div>
											</div>
										</div>
									</form>
									<form class="el" data-info="paiement">
										<input required type="text" value="<?php echo($email); ?>" name="mail" style="display:none;">
										<input required type="text" value="0" name="intent" style="display:none;">
										<div class="title"><?= RichText::asText($document->informations_title3); ?></div>
										<div class="container-input">
											<div class="wrap-input">
												<div class="input">
													<input class="cardholderName" required type="text" name="name" value="<?php echo $personal_information['last_name']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<div class="wrap-input wrap-input-stripe">
														<div id="cardNumber-element"></div>
														<div class="placeholder">**** **** **** ****</div>
													</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<div class="wrap-input wrap-input-stripe">
														<div id="cardExpiry-element"></div>
														<div class="placeholder">**/**</div>
													</div>
												</div>
												<div class="input">
													<div class="wrap-input wrap-input-stripe">
														<div id="cardCvc-element"></div>
														<div class="placeholder">***</div>
													</div>
												</div>
											</div>
										</div>
									</form>
									<?php if( !empty($professional_information) ) { ?>
									<form class="el" data-info="pro">
										<input required type="text" value="<?php echo($email); ?>" name="mail" style="display:none;">
										<div class="title"><?= RichText::asText($document->informations_title4); ?></div>
										<div class="container-input">
											<div class="wrap-input">
												<div class="input">
													<input name="company" required type="text" value="<?php echo $professional_information['name']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input name="siret" required type="text" value="<?php echo $professional_information['siret']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input name="headoffice" required type="text" value="<?php echo $professional_information['head_office']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input name="pc_adress" required type="text" value="<?php echo $professional_information['adress']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
											<div class="wrap-input">
												<div class="input">
													<input name="pc_zipcode" required type="text" value="<?php echo $professional_information['zip_code']; ?>">
													<div class="error">Error</div>
												</div>
												<div class="input">
													<input name="pc_country" required type="text" value="<?php echo $professional_information['country']; ?>">
													<div class="error">Error</div>
												</div>
											</div>
										</div>
									</form>
									<?php } ?>
								</div>
							</div>
							<div id="sectionBill"></div>
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
								<?php if(empty($i->number)){ ?>
									<div class="num">La fature sera disponible sous maximum 24h</div>
								<?php } else { ?>
									<div class="num"><?php echo($i->number); ?></div>
									<div class="month"><?php echo(monthInFrench(date_format($date, 'm'))) ?></div>
									<div class="date"><?php echo(date_format($date, 'd/m/Y')); ?></div>
									<a href="<?php echo($i->hosted_invoice_url); ?>" class="link" target="_blank">
										<span class="link-text"><?= RichText::asText($document->invoices_download); ?></span>
									</a>
								<?php } ?>
							</li>
							<?php } ?>
						</ul>
						<?php if($upcoming != null) { ?>
							<div id="sectionSubscribe"></div>
						<?php } else { ?>
							<div id="sectionAccount"></div>
						<?php } ?>
					</section>
					<?php if($upcoming != null) { ?>
					<section class="section-subscribe">
						<div class="head">
							<div class="title"><?= RichText::asText($document->subscribe_title); ?></div>
						</div>
						<ul>
							<li>
								<div class="type"><?php echo($product['name']); ?></div>
								<div class="date"><?= RichText::asText($document->subscribe_updated); ?> <?php echo(date('d/m/Y', $upcoming['next_payment_attempt'])); ?></div>
								<div class="month"><?= RichText::asText($document->subscribe_month); ?></div>
								<div class="price"><?php echo( ''. ( intval($invoice['data'][0]['lines']['data'][0]['plan']['amount']) / 100) .'€'); ?></div>
								<div class="link">
									<span class="link-text"><?= RichText::asText($document->subscribe_cancel); ?></span>
								</div>
							</li>
						</ul>
						<div id="sectionAccount"></div>
					</section>
					<?php } ?>
					<section class="section-account">
						<div class="head">
							<div class="title"><?= RichText::asText($document->account_title); ?></div>
						</div>
						<ul>
							<li>
								<div class="name"><?php echo($personal_information['first_name']); ?> <?php echo(strtoupper($personal_information['last_name'])); ?></div>
								<div class="email"><?php echo($email); ?></div>
								<div class="link">
									<span class="link-text"><?= RichText::asText($document->account_cancel); ?></span>
								</div>
							</li>
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