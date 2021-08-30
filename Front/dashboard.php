<html>
	<head>

		<title>Title</title>

		<meta name="description" content="" />

		<meta http-equiv="content-type" content="text/html; charset=utf8" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="style/css/dashboard.css">

		<script src="https://js.stripe.com/v3/"></script>
    	<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

	</head>
	
	<body>


		<?php include('common-header.php') ?>

		<?php include('common-devtools.php') ?>

		<div class="container-lightbox">
			<form method="post">
				<input type="email" value="prevost.alexis@hotmail.fr">
			</form>
			<div class="wrapper">
				<div class="lightbox subscribe">
					<img src="img/dashboard/cross.svg" alt="cross" class="cross">
					<h3>Êtes-vous sûr de vouloir supprimer votre abonnement ?</h3>
					<p>Vous êtes sur le point de résilier votre abonnement</p>
					<div class="container-button">
						<div class="btn">
							<div class="btn-text">
								Annuler
							</div>
							<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
								<use xlink:href="img/common/icn-arrow.svg#content"></use>
							</svg>
						</div>
						<div class="btn">
							<div class="btn-text">
								Résilier votre abonnement
							</div>
							<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
								<use xlink:href="img/common/icn-arrow.svg#content"></use>
							</svg>
						</div>
					</div>
				</div>
				<div class="lightbox account">
					<img src="img/dashboard/cross.svg" alt="cross" class="cross">
					<h3>Êtes-vous sûr de vouloir supprimer votre compte ?</h3>
					<p>Vous êtes sur le point de supprimer définitivement votre compte et cette action est irréversible.</p>
					<div class="container-button">
						<div class="btn">
							<div class="btn-text">
								Annuler
							</div>
							<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
								<use xlink:href="img/common/icn-arrow.svg#content"></use>
							</svg>
						</div>
						<div class="btn">
							<div class="btn-text">
								Supprimer mon compte
							</div>
							<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
								<use xlink:href="img/common/icn-arrow.svg#content"></use>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>

		<main>
			
			<section class="section-dashboard">
				<div class="wrapper">
					<div class="container-sidebar">
						<div class="title">Paramètres</div>
						<ul class="container-tab">
							<li class="tab style-active">
								<span>Mes Informations</span>
							</li>
							<li class="tab">
								<span>Mes Factures</span>
							</li>
						</ul>
					</div>
					<div class="container-informations">
						<section class="section-informations">
							<div class="head">
								<div class="title">Mes informations</div>
								<div class="container-btn">
									<div class="btn style-active">
										<div class="btn-text">Editer</div>
									</div>
									<div class="btn">
										<div class="btn-text">Enregistrer</div>
									</div>
								</div>
							</div>
							<div class="container-content">
								<div class="content-save style-active">
									<div class="container-el">
										<div class="el">
											<ul>
												<li>
													<div class="title">
														Nom
													</div>

													<div class="text">
														Carvalho
													</div>
												</li>
												<li>
													<div class="title">
														Prénom
													</div>

													<div class="text">
														Claudia
													</div>
												</li>
												<li>
													<div class="title">
														Téléphone
													</div>

													<div class="text">
														(907) 555-0101
													</div>
												</li>
												<li>
													<div class="title">
														Adresse
													</div>

													<div class="text">
														2464 Royal Ln. Mesa
													</div>
												</li>
												<li>
													<div class="title">
														Code Postal
													</div>

													<div class="text">
														45463
													</div>
												</li>
												<li>
													<div class="title">
														Pays
													</div>

													<div class="text">
														United States
													</div>
												</li>
											</ul>
										</div>
										<div class="el">
											<ul>
												<li>
													<div class="title">
														Email
													</div>

													<div class="text">
														jessica.hanson@example.com
													</div>
												</li>
												<li>
													<div class="title">
														Mot de passe
													</div>

													<div class="text">
														********
													</div>
												</li>
											</ul>
										</div>
										<div class="el">
											<ul>
												<li>
													<div class="title">
														Titulaire
													</div>

													<div class="text">
														Claudia Carvalho
													</div>
												</li>
												<li>
													<div class="title">
														Numéro de carte
													</div>

													<div class="text">
														VISA   ****  ****  ****  6589
													</div>
												</li>
											</ul>
										</div>
										<div class="el">
											<ul>
												<li>
													<div class="title">
														Société
													</div>

													<div class="text">
														Sony
													</div>
												</li>
												<li>
													<div class="title">
														SIRET
													</div>

													<div class="text">
														453
													</div>
												</li>
												<li>
													<div class="title">
														Siège Social
													</div>

													<div class="text">
														Lorem
													</div>
												</li>
												<li>
													<div class="title">
														Adresse
													</div>

													<div class="text">
														2464 Royal Ln. Mesa
													</div>
												</li>
												<li>
													<div class="title">
														Code Postal
													</div>

													<div class="text">
														45463
													</div>
												</li>
												<li>
													<div class="title">
														Pays
													</div>

													<div class="text">
														United States
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="content-edit">
									<div class="container-el">
										<form class="el" data-info="perso">
											<input required type="text" value="prevost.alexis@hotmail.fr" name="mail" style="display:none;">
											<div class="title">Informations personnelles</div>
											<div class="container-input">
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Nom*" name="lastname" value="Prevost-Maynen">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Prénom*" name="firstname" value="Alexis">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Téléphone*" name="phone" value="0667481456">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Adresse postale*" name="adress" value="57 route de dieppe">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Code Postal*" name="zipcode" value="76250">
														<div class="error">Error</div>
													</div>
													<div class="input">
														<input required type="text" placeholder="Pays*" name="country" value="France">
														<div class="error">Error</div>
													</div>
												</div>
											</div>
										</form>
										<form class="el" data-info="securite">
											<input required type="text" value="prevost.alexis@hotmail.fr" name="mail" style="display:none;">
											<div class="title">Informations personnelles</div>
											<div class="container-input">
												<div class="wrap-input">
													<div class="input">
														<input required type="email" name="email" placeholder="test@test.fr" value="prevost.alexis@hotmail.fr">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="password" name="password1" placeholder="****">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="password" name="password2" placeholder="****">
														<div class="error">Error</div>
													</div>
												</div>
											</div>
										</form>
										<form class="el" data-info="paiement">
											<input required type="text" value="prevost.alexis@hotmail.fr" name="mail" style="display:none;">
											<input name="intent" type="text" value="0" style="display:none">
											<div class="title">Informations personnelles</div>
											<div class="container-input">
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Nom de la carte" value="Alexis">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="input">
													<div class="wrap-input wrap-input-stripe">
														<div id="cardNumber-element"></div>
														<div class="placeholder">**** **** **** ****</div>
													</div>
												</div>
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
										</form>
										<form class="el" data-info="pro">
											<input required type="text" value="prevost.alexis@hotmail.fr" name="mail" style="display:none;">
											<div class="title">Informations professionnelles</div>
											<div class="container-input">
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Nom de votre société*" value="bruno">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Numéro de SIRET*" value="32132321232">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Siège social*" value="BRUNO">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Adresse professionnelle*" value="1 rue nicoles oresme">
														<div class="error">Error</div>
													</div>
												</div>
												<div class="wrap-input">
													<div class="input">
														<input required type="text" placeholder="Code Postal*" value="76000">
														<div class="error">Error</div>
													</div>
													<div class="input">
														<input required type="text" placeholder="Pays*" value="France">
														<div class="error">Error</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</section>
						<section class="section-bill">
							<div class="head">
								<div class="title">Mes Factures</div>
							</div>
							<ul>
								<li>
									<div class="num">#3142</div>
									<div class="month">Facture - Janvier</div>
									<div class="date">12/02/21</div>
									<a href="" class="link">
										<img class="link-icn" src="img/dashboard/icn-download.svg" alt="">
										<span class="link-text">Télécharger</span>
									</a>
								</li>
								<li>
									<div class="num">#3142</div>
									<div class="month">Facture - Janvier</div>
									<div class="date">12/02/21</div>
									<a href="" class="link">
										<img class="link-icn" src="img/dashboard/icn-download.svg" alt="">
										<span class="link-text">Télécharger</span>
									</a>
								</li>
								<li>
									<div class="num">#3142</div>
									<div class="month">Facture - Janvier</div>
									<div class="date">12/02/21</div>
									<a href="" class="link">
										<img class="link-icn" src="img/dashboard/icn-download.svg" alt="">
										<span class="link-text">Télécharger</span>
									</a>
								</li>
								<li>
									<div class="num">#3142</div>
									<div class="month">Facture - Janvier</div>
									<div class="date">12/02/21</div>
									<a href="" class="link">
										<img class="link-icn" src="img/dashboard/icn-download.svg" alt="">
										<span class="link-text">Télécharger</span>
									</a>
								</li>
								<li>
									<div class="num">#3142</div>
									<div class="month">Facture - Janvier</div>
									<div class="date">12/02/21</div>
									<a href="" class="link">
										<img class="link-icn" src="img/dashboard/icn-download.svg" alt="">
										<span class="link-text">Télécharger</span>
									</a>
								</li>
							</ul>
						</section>
						<section class="section-subscribe">
							<div class="head">
								<div class="title">Mon abonnement</div>
							</div>
							<ul>
								<li>
									<div class="type">Particulier</div>
									<div class="date">Renouv. le 8 avr 2021</div>
									<div class="month">Mensuel</div>
									<div class="price">32,99€</div>
									<div class="link">
										<span class="link-text">Résilier mon abonnement</span>
									</div>
								</li>
							</ul>
						</section>
						<section class="section-account">
							<div class="head">
								<div class="title">Mon compte</div>
							</div>
							<ul>
								<li>
									<div class="name">Claudia CARVALHO</div>
									<div class="email">jessica.hanson@example.com</div>
									<div class="link">
										<span class="link-text">Supprimer mon compte</span>
									</div>
								</li>
							</ul>
						</section>
					</div>
				</div>
			</section>
			
		</main>


		<?php include('common-footer.php') ?>

		<script type="text/javascript" src="script/minify/dashboard-min.js"></script>
	</body>
</html>