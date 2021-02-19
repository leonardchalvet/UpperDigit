<html>
	<head>

		<title>CGU</title>

		<meta name="description" content="" />

		<meta http-equiv="content-type" content="text/html; charset=utf8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="style/css/contact.css">

	</head>
	
	<body>

		<?php include('common-header.php') ?>

		<main>

			<div class="container-lightbox">
				<div class="background"></div>
				<div class="lightbox">
					<div class="cross">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" >
							<use xlink:href="img/common/icn-cross.svg#content"></use>
						</svg>
					</div>
					<h3>Merci ! Votre message à bien été envoyé.</h3>
					<div class="container-btn">
						<a href="" class="btn">
							<div class="btn-text">
								Page d’accueil
							</div>
							<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
								<use xlink:href="img/common/icn-arrow.svg#content"></use>
							</svg>
						</a>
					</div>
				</div>
			</div>


			<section class="section-contact">
				<div class="wrapper">
					<div class="container-illu">
						<img src="img/contact/illu-1.png" alt="">
					</div>
					<div class="container-form">
						<h1>Contactez-nous dès maintenant.</h1>
						<p>
							Vous avez une question ? N’hésitez pas à nous écrire pour plus d’informations
						</p>
						<form onSubmit="return false;">
							<div class="input">
								<input type="text" placeholder="Nom*">
								<div class="error">Error</div>
							</div>
							<div class="input">
								<input type="email" placeholder="Email*">
								<div class="error">Error</div>
							</div>
							<div class="textarea">
								<textarea placeholder="Message*"></textarea>
								<div class="error">Error</div>
							</div>
							<div class="container-btn">
								<button>
									<div class="btn-text">
										Envoyer
									</div>
									<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
										<use xlink:href="img/common/icn-arrow.svg#content"></use>
									</svg>
								</button>
							</div>
						</form>
					</div>
				</div>
			</section>


		</main>

		<?php include('common-footer.php') ?>

		<script type="text/javascript" src="script/minify/contact-min.js"></script>
	</body>
</html>