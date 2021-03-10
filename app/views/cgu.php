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

    <link rel="stylesheet" type="text/css" href="/style/css/cgu.css">

  </head>
  
  <body>

    <?php include('common-lightbox.php') ?>

    <?php include('common-header.php') ?>

    <main>
      
      <section class="section-cgu">
        <div class="wrapper">
          <div class="container-text">
            <?= RichText::asHtml($document->content_title); ?>
          </div>
          <div class="container-cgu">
            <div class="content">
              
              <?php foreach ($document->body as $slice) { ?>

              <?php switch($slice->slice_type) {

                case 'text' : ?>

                  <?= RichText::asHtml($slice->primary->text); ?>

                <?php break;

                case 'one_image' : ?>

                <div class="container-img-1">
                  <img src="<?= $slice->primary->img->url; ?>" alt="<?= $slice->primary->img->alt; ?>">
                </div>

                <?php break;

                case 'two_images' : ?>

                <div class="container-img-2">
                  <?php foreach ($slice->items as $item) { ?>
                    <img src="<?= $item->img->url; ?>" alt="<?= $item->img->alt; ?>">
                  <?php } ?>
                </div>

                <?php break;
              } ?>

            <?php } ?>

            </div>
            <aside>
              <div class="container-el">
                <?php foreach ($document->column_element as $e) { ?>
                <div class="el">
                  <?= RichText::asHtml($e->title); ?>
                  <?= RichText::asHtml($e->list); ?>
                </div>
                <?php } ?>
              </div>      
            </aside>
          </div>
        </div>
      </section>

    </main>

    <?php include('common-footer.php') ?>

    <script type="text/javascript" src="/script/minify/cgu-min.js"></script>
  </body>
</html>