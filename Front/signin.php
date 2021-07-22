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
								<a href="">Mot de passe oublié ?</a>
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