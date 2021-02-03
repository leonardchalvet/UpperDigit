<?php 
use Prismic\Dom\RichText;
?>
<section class="common-section-start">
	<div class="wrapper">
		<div class="container-text">
			<?= RichText::asHtml($document->start_title); ?>
			<?= RichText::asHtml($document->start_text); ?>
		</div>
		<div class="container-btn">
			<a class="btn" href="<?= checkUrl($document->start_btnlink); ?>">
				<div class="btn-text"><?= RichText::asText($document->start_btntext); ?></div>
				<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
					<use xlink:href="/img/common/icn-arrow.svg#content"></use>
				</svg>
			</a>
		</div>
	</div>
</section>