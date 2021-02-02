<?php 
use Prismic\Dom\RichText;
$header = $WPGLOBAL['header']->data;
?>

<header>
	<div class="wrapper">
		<a href="" class="logo">
			<img src="/img/common/logo.svg" alt="">
		</a>

		<div class="container-action">
			<a href="" class="signin">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" >
					<use xlink:href="/img/header/icn-user.svg#content"></use>
				</svg>
				<span class="text">
					<span class="link-text">Se connecter</span>
				</span>
			</a>
			<a href="" class="start">
				<div class="btn-text">S’abonner</div>
				<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
					<use xlink:href="/img/common/icn-arrow.svg#content"></use>
				</svg>
			</a>
		</div>
	</div>
</header>