<?php 
use Prismic\Dom\RichText;
$document = $WPGLOBAL['document']->data;

function checkThisUrl($el) {
    $url = getUrl();

    if($el->url) return $el->url;
    else {
        if($el->type == "home") return $url;
        else return $url.$el->uid;
    }
}

$email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null ;

if($email != null) {
  header('Location: ' . checkThisUrl($document->content_redirect) );
  exit();
}


?>
<html>
  <head>

    <?php include('common-noindex.php') ?>

    <title><?= RichText::asText($document->global_title); ?></title>

    <meta name="description" content="<?= RichText::asText($document->global_description); ?>" />

    <meta http-equiv="content-type" content="text/html; charset=utf8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/style/css/signin.css">

  </head>
  
  <body>

    <?php include('common-lightbox.php') ?>

    <?php include('common-header.php') ?>

    <main>

      <div id="redirection"><?php checkUrl($document->content_redirect); ?></div>

      <div class="container-lightbox">
				<div class="wrapper">
					<div class="lightbox input-email">
						<img src="/img/dashboard/cross.svg" alt="cross" class="cross">
						<h3><?= RichText::asText($document->lightbox_ftitle); ?></h3>
						<p><?= RichText::asText($document->lightbox_ftext); ?></p>
						<form>
							<div class="input">
								<input required type="text" placeholder="<?= RichText::asText($document->lightbox_fplaceholder); ?>" name="mail">
								<div class="error"><?= RichText::asText($document->content_error); ?></div>
							</div>
						</form>
						<div class="container-button">
							<div class="btn">
								<div class="btn-text">
                  <?= RichText::asText($document->lightbox_fbtntxt); ?>
								</div>
								<svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
									<use xlink:href="/img/common/icn-arrow.svg#content"></use>
								</svg>
							</div>
						</div>
					</div>
					<div class="lightbox send-email">
						<img src="/img/dashboard/cross.svg" alt="cross" class="cross">
						<img src="/img/signin/check.svg" alt="check" class="check">
						<h3><?= RichText::asText($document->lightbox_stitle); ?></h3>
						<p><?= RichText::asText($document->lightbox_stext); ?></p>
					</div>
				</div>
			</div>
      
      <section class="section-signin">
        <div class="wrapper">
          <div class="container-illu">
            <img src="<?= $document->content_img->url; ?>" alt="<?= $document->content_img->alt; ?>">
          </div>
          <div class="container-form">
            <?= RichText::asHtml($document->content_title); ?>
            <?= RichText::asHtml($document->content_text); ?>
            <form onSubmit="return false;">
              <div class="input">
                <input type="email" name="email" placeholder="<?= RichText::asText($document->content_email); ?>">
                <div class="error"><?= RichText::asText($document->content_error); ?></div>
              </div>
              <div class="input">
                <input type="password" name="password" placeholder="<?= RichText::asText($document->content_password); ?>">
                <div class="error"><?= RichText::asText($document->content_error); ?></div>
              </div>
              <div class="password-forg">
                <a><?= RichText::asText($document->content_forgettext); ?></a>
              </div>
              <div class="container-btn">
                <button>
                  <div class="btn-text">
                    <?= RichText::asText($document->content_btntext); ?>
                  </div>
                </button>
              </div>
              <div class="signup">
                <?= RichText::asText($document->content_subscribe); ?>
                <a href="<?php checkUrl($document->content_link); ?>">
                  <?= RichText::asText($document->content_linktext); ?>
                </a>
              </div>
            </form>
          </div>
        </div>
      </section>

    </main>

    <?php include('common-footer.php') ?>

    <script type="text/javascript" src="/script/minify/signin-min.js"></script>
  </body>
</html>