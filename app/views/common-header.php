<?php 
use Prismic\Dom\RichText;
$header = $WPGLOBAL['header']->data;
?>

<header>
	<div class="wrapper">
		<a href="<?= checkUrl($header->logo_link); ?>" class="logo">
			<img src="<?= $header->logo_img->url; ?>" alt="<?= $footer->logo_img->alt; ?>">
		</a>
		<div class="container-action">
			<a href="<?= checkUrl($header->cta_btnlink1); ?>" class="signin">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" >
					<use xlink:href="/img/header/icn-user.svg#content"></use>
				</svg>
				<span class="text">
					<span class="link-text"><?= RichText::asText($header->cta_btntext1); ?></span>
				</span>
			</a>
			<a href="<?= checkUrl($header->cta_btnlink2); ?>" class="start">
				<div class="btn-text"><?= RichText::asText($header->cta_btntext2); ?></div>
				<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
					<use xlink:href="/img/common/icn-arrow.svg#content"></use>
				</svg>
			</a>
		</div>
	</div>
</header>