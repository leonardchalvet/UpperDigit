<?php 
use Prismic\Dom\RichText;
$lightbox = $WPGLOBAL['lightbox']->data;
?>
<div class="container-cookies">
	<div class="cdr">
		<?= RichText::asHtml($lightbox->cookies_text); ?>
		<div class="container-btn">
			<button class="btn">
				<span class="btn-text"><?= RichText::asText($lightbox->cookies_btntextl); ?></span>
			</button>

			<button class="btn">
				<span class="btn-text"><?= RichText::asText($lightbox->cookies_btntextr); ?></span>
				<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
					<use xlink:href="/img/common/icn-arrow.svg#content"></use>
				</svg>
			</button>
		</div>
	</div>
</div>