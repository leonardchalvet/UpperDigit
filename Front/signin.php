<html>
	<head>

		<title>Signin</title>

		<meta name="description" content="" />

		<meta http-equiv="content-type" content="text/html; charset=utf8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="style/css/signin.css">

	</head>
	
	<body>

		<?php include('common-header.php') ?>

		<main>

			<?php include('common-devtools.php') ?>

			<div class="container-lightbox">
				<div class="wrapper">
					<div class="lightbox input-email">
						<img src="img/dashboard/cross.svg" alt="cross" class="cross">
						<h3>Vous avez oublié votre mot de passe ?</h3>
						<p>Pour réinitialiser votre mot de passe, saisissez l’adresse e-mail que vous utilisez pour vous connecter, afin que nous puissions vous envoyer un lien de réinitialisation.</p>
						<form>
							<div class="input">
								<input required type="text" placeholder="Email*" name="mail">
								<div class="error">Error</div>
							</div>
						</form>
						<div class="container-button">
							<div class="btn">
								<div class="btn-text">
									Envoyer
								</div>
								<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
									<use xlink:href="img/common/icn-arrow.svg#content"></use>
								</svg>
							</div>
						</div>
					</div>
					<div class="lightbox send-email">
						<img src="img/dashboard/cross.svg" alt="cross" class="cross">
						<img src="img/signin/check.svg" alt="check" class="check">
						<h3>E-mail de réinitialisation de mot de passe envoyé !</h3>
						<p>Un e-mail pour réinitialiser votre mot de passe vient d’être envoyé à l’adresse que vous avez saisie. </p>
					</div>
				</div>
			</div>

			<section class="section-signin">
				<div class="wrapper">
					<div class="container-illu">
						<img src="img/signin/illu-1.svg" alt="">
					</div>
					<div class="container-form">
						<h1>Connectez-vous à votre espace.</h1>
						<p>
							Connectez-vous afin d’accéder à toutes vos fonctionnalités
						</p>
						<form onSubmit="return false;">
							<div class="input">
								<input type="email" placeholder="Email">
								<div class="error">Error</div>
							</div>
							<div class="input">
								<input type="password" placeholder="Mot de passe*">
								<div class="error">Error</div>
							</div>
							<div class="password-forg">
								<a>Mot de passe oublié ?</a>
							</div>
							<div class="container-btn">
								<button>
									<div class="btn-text">
										Connectez-vous
									</div>
								</button>
							</div>
							<div class="signup">
								Vous n’avez pas encore de compte ? <a href="">Abonnez-vous ici</a>
							</div>
						</form>
					</div>
				</div>
			</section>


		</main>

		<?php include('common-footer.php') ?>

		<script type="text/javascript" src="script/minify/signin-min.js"></script>
	</body>
</html>