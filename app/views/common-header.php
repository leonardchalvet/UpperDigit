<?php 
use Prismic\Dom\RichText;
$header = $WPGLOBAL['header']->data;
?>

<header>
	<div class="wrapper">
		<a href="<?= checkUrl($header->logo_link); ?>" class="logo">
			<img src="<?= $header->logo_img->url; ?>" alt="<?= $footer->logo_img->alt; ?>">
		</a>
		<?php if($email == null) { ?>
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
		<?php } else { ?>
			<div class="container-account">
				<div class="name">
					<span>Alexis</span>
					<img src="/img/header/arrow.svg" alt="">
				</div>
				<ul class="dropdown">
					<li><a href="<?= checkUrl($header->account_dashboardlink); ?>"><?= RichText::asText($header->account_dashboardtext); ?></a></li>
					<li><a href="/php/deconnexion.php"><?= RichText::asText($header->account_deconnexiontext); ?></a></li>
				</ul>
			</div>
		<?php } ?>
	</div>
</header>

<script>
	(function(w,d,u){
			var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
			var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
	})(window,document,'https://cdn.bitrix24.fr/b18535555/crm/site_button/loader_2_bdyur2.js');
</script>