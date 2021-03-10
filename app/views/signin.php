<?php 
use Prismic\Dom\RichText;
$document = $WPGLOBAL['document']->data;
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
                <a href="<?= checkUrl($document->content_forgetlink); ?>"><?= RichText::asText($document->content_forgettext); ?></a>
              </div>
              <div class="container-btn">
                <button>
                  <div class="btn-text">
                    <?= RichText::asText($document->content_btntext); ?>
                  </div>
                </button>
              </div>
              <div class="signup">
                <?= RichText::asHtml($document->content_subscribe); ?>
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