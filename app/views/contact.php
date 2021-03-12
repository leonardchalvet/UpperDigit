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

    <link rel="stylesheet" type="text/css" href="/style/css/contact.css">

  </head>
  
  <body>

    <?php include('common-lightbox.php') ?>

    <?php include('common-header.php') ?>

    <main>
      
      <div class="container-lightbox">
        <div class="background"></div>
        <div class="lightbox">
          <div class="cross">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" >
              <use xlink:href="/img/common/icn-cross.svg#content"></use>
            </svg>
          </div>
          <?= RichText::asHtml($document->lightbox_title); ?>
          <div class="container-btn">
            <a href="<?= checkUrl($document->lightbox_btnlink); ?>" class="btn">
              <div class="btn-text">
                <?= RichText::asText($document->lightbox_btntext); ?>
              </div>
              <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                <use xlink:href="/img/common/icn-arrow.svg#content"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <section class="section-contact">
        <div class="wrapper">
          <div class="container-illu">
            <img src="<?= $document->content_img->url; ?>" alt="<?= $document->content_img->alt; ?>">
          </div>
          <div class="container-form">
            <?= RichText::asHtml($document->content_title); ?>
            <?= RichText::asHtml($document->content_text); ?>
            <form onSubmit="return false;">
              <div class="input">
                <input type="text" name="name" placeholder="<?= RichText::asText($document->content_name); ?>">
                <div class="error"><?= RichText::asText($document->content_error); ?></div>
              </div>
              <div class="input">
                <input type="text" name="email" placeholder="<?= RichText::asText($document->content_email); ?>">
                <div class="error"><?= RichText::asText($document->content_error); ?></div>
              </div>
              <div class="textarea">
                <textarea name="message" placeholder="<?= RichText::asText($document->content_message); ?>"></textarea>
                <div class="error"><?= RichText::asText($document->content_error); ?></div>
              </div>
              <div class="container-btn">
                <button>
                  <div class="btn-text">
                    <?= RichText::asText($document->content_btntext); ?>
                  </div>
                  <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                    <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                  </svg>
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>

    </main>

    <?php include('common-footer.php') ?>

    <script type="text/javascript" src="/script/minify/contact-min.js"></script>
  </body>
</html>