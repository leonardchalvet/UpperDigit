<?php 
use Prismic\Dom\RichText;
$document = $WPGLOBAL['document']->data;
?>
<html>
  <head>

    <title><?= RichText::asText($document->global_title); ?></title>

    <meta name="description" content="<?= RichText::asText($document->global_description); ?>" />

    <meta http-equiv="content-type" content="text/html; charset=utf8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/style/css/home.css">

    <script src="https://player.vimeo.com/api/player.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.5.1/dist/algoliasearch-lite.umd.js"></script>

  </head>
  
  <body>

    <?php include('common-header.php') ?>

    <main>
      
      <section class="section-search">
        <div class="wrapper">
          <div class="container-text">
            <?= RichText::asHtml($document->search_title); ?>
          </div>
           <div class="container-search">
            <div class="container-input">
              <div class="input">
                <div class="search">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" >
                    <use xlink:href="/img/common/icn-search.svg#content"></use>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" >
                    <use xlink:href="/img/common/icn-search.svg#content"></use>
                  </svg>
                </div>
                <input type="text" placeholder="<?= RichText::asText($document->search_placeholder); ?>">
                <div class="container-action">
                  <button>
                    <span class="btn-text"><?= RichText::asText($document->search_btntext); ?></span>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                    </svg>
                  </button>
                  <div class="cross">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" >
                      <use xlink:href="/img/common/icn-cross.svg#content"></use>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="dropdown">
                <!--
                <div class="container-placeholder">
                  <ul>
                    <li>
                      <div class="title">Wait algolia</div>
                    </li>
                    <?php for(;$i<4;$i++) { ?>
                    <li>
                      <a href="">Wait algolia</a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
                -->
                <div class="container-result">
                  <ul></ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section-why">
        <div class="wrapper">
          <div class="container-title">
            <img class="sep" src="/img/common/shape-hilight/obj-4.svg" alt="">
            <?= RichText::asHtml($document->why_title); ?>
            <?= RichText::asHtml($document->why_subtitle); ?>
          </div>
          <div class="container-el">
            <?php foreach ($document->why_all as $el) { ?>
              <div class="el">
                <div class="illu">
                  <img src="<?= $el->img->url; ?>" alt="<?= $el->img->alt; ?>">
                </div>
                <?= RichText::asHtml($el->title); ?>
                <?= RichText::asHtml($el->text); ?>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>

      <section class="section-problem">
        <div class="wrapper">
          <div class="container-title">
            <?= RichText::asHtml($document->problem_title); ?>
            <?= RichText::asHtml($document->problem_text); ?>
          </div>
          <div class="container-problem">
            <div class="illu">
              <img src="<?= $document->problem_image->url; ?>" alt="<?= $document->problem_image->alt; ?>">
            </div>
            <ul>
              <?php foreach ($document->why_all as $el) { ?>
                <li>
                  <img src="/img/home/section-problem/icn-cross.svg" alt="">
                  <div class="text">
                    <?= RichText::asHtml($el->title); ?>
                    <?= RichText::asHtml($el->text); ?>
                  </div>
                </li>
              <?php } ?>
            </ul>
          </div>
          <div class="container-btn">
            <?= RichText::asHtml($document->problem_textabtn); ?>
            <a class="btn" href="<?= checkUrl($document->problem_btnlink); ?>">
              <div class="btn-text"><?= RichText::asText($document->problem_btntext); ?></div>
              <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                <use xlink:href="/img/common/icn-arrow.svg#content"></use>
              </svg>
            </a>
          </div>
        </div>
      </section>

      <section class="section-ftr">
        <div class="wrapper">
          <div class="container-title">
            <?= RichText::asHtml($document->feature_title); ?>
            <div class="container-text">
              <?= RichText::asHtml($document->feature_text); ?>
              <div class="container-tag">
                <?php foreach ($document->feature_allt as $el) { ?>
                  <div class="tag">
                    <span><?= RichText::asText($el->text); ?></span>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <div class="container-ftr">
            <div class="container-video">
              <?php $i=1; foreach ($document->feature_alle as $el) { ?>
                <div class="video video-<?php echo($i); ?>">
                  <iframe src="<?= $el->video->url; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
              <?php $i++; } ?>
            </div>
            <div class="container-text">
              <div class="container-line">
              </div>
              <div class="container-el">
                <?php $i=1; foreach ($document->feature_alle as $el) { ?>
                <div class="el<?php if($i==1) echo(" active"); ?>" data-video="video-<?php echo($i); ?>">
                  <div class="head">
                    <?= RichText::asHtml($el->title); ?>
                  </div>
                  <div class="text">
                    <?= RichText::asHtml($el->text); ?>
                  </div>
                </div>
                <?php $i++; } ?>
              </div>
            </div>
            
          </div>
        </div>
      </section>

      <section class="section-quote">
        <div class="wrapper">
          <div class="container-title">
            <?= RichText::asHtml($document->quote_title); ?>
          </div>
          <div class="container">
            <div class="container-quote">
              <?php foreach ($document->quote_allq as $el) { ?>
                <div class="quote">
                  <div class="author">
                    <img class="pp" src="<?= $el->img->url; ?>" alt="<?= $el->img->alt; ?>">
                    <div class="name">
                      <?= RichText::asText($el->name); ?>
                    </div>
                    <div class="job">
                      <?= RichText::asText($el->job); ?>
                    </div>
                  </div>
                  <q>
                    <?= RichText::asText($el->text); ?>
                  </q>
                </div>
              <?php } ?>
            </div>
            <div class="container-btn">
              <div class="btn">
                <svg class="circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 105" >
                  <use xlink:href="/img/home/section-quote/circle.svg#content"></use>
                </svg>
                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                  <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                </svg>
              </div>
            </div>
          </div>
          <div class="container-logo">
            <?php foreach ($document->quote_alll as $el) { ?>
              <div class="logo">
                <img src="<?= $el->img->url; ?>" alt="<?= $el->img->alt; ?>">
              </div>
            <?php } ?>
          </div>
        </div>
      </section>

      <?php include('common-section-start.php') ?>

    </main>

    <?php include('common-footer.php') ?>

    <script type="text/javascript" src="/script/minify/index-min.js"></script>
  </body>
</html>