<?php 
use Prismic\Dom\RichText;
$document = $WPGLOBAL['document']->data;

$email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null ;

?>
<html>
  <head>

    <?php include('common-noindex.php') ?>

    <title><?= RichText::asText($document->global_title); ?></title>

    <meta name="description" content="<?= RichText::asText($document->global_description); ?>" />

    <meta http-equiv="content-type" content="text/html; charset=utf8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/style/css/404.css">

  </head>
  
  <body>

    <?php include('common-lightbox.php') ?>

    <?php include('common-header.php') ?>

    <main>
      
      <section class="section-404">
        <div class="wrapper">
          <img class="illu" src="<?= $document->content_img->url; ?>" alt="<?= $document->content_img->alt; ?>">
          <?= RichText::asHtml($document->content_title); ?>
          <?= RichText::asHtml($document->content_text); ?>
          <div class="container-btn">
            <a href="<?= checkUrl($document->content_btnlink); ?>" class="btn">
              <div class="btn-text">
                <?= RichText::asText($document->content_btntext); ?>
              </div>
              <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                <use xlink:href="/img/common/icn-arrow.svg#content"></use>
              </svg>
            </a>
          </div>
        </div>
      </section>

    </main>

    <?php include('common-footer.php') ?>

    <script type="text/javascript" src="/script/minify/404-min.js"></script>
  </body>
</html>