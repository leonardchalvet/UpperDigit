<?php 
use Prismic\Dom\RichText;
$footer = $WPGLOBAL['footer']->data;
?>

<footer>
	
	<div class="wrapper">
		
		<div class="container-text">
			<a href="<?= checkUrl($footer->logo_link); ?>" class="logo">
				<img src="<?= $footer->logo_img->url; ?>" alt="<?= $footer->logo_img->alt; ?>">
			</a>
			<p>
				<?= RichText::asText($footer->logo_text); ?>
			</p>
		</div>

		<div class="container-link">
			<div class="title">
				<?= RichText::asText($footer->links_title); ?>
			</div>
			<ul>
				<?php foreach ($footer->links_all as $el) { ?>
					<li><a href="<?= checkUrl($el->link); ?>"><?= RichText::asText($el->text); ?></a></li>
				<?php } ?>
			</ul>
		</div>

		<div class="container-link">
			<div class="title">
				<?= RichText::asText($footer->sn_title); ?>
			</div>
			<ul>
				<?php foreach ($footer->sn_all as $el) { ?>
					<li><a href="<?= checkUrl($el->link); ?>"><?= RichText::asText($el->text); ?></a></li>
				<?php } ?>
			</ul>
		</div>

	</div>

	<div class="foot">
		<p><?= RichText::asText($footer->foot_text); ?></p>
	</div>

</footer>