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

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

    <link rel="stylesheet" type="text/css" href="/style/css/tunnel.css">

  </head>
  
  <body>

    <?php include('common-lightbox.php') ?>

    <main>
      
      <section class="section-tunnel">
        <div class="wrapper">
          
          <div class="sidebar">
            <a class="logo" href="">
              <img src="/img/common/logo.svg" alt="">
            </a>
            <div class="container-illu">
              <?php foreach ($document->common_images as $i) { ?>
                <img src="<?= $i->img->url; ?>" alt="<?= $i->img->alt; ?>">
              <?php } ?>
            </div>
            <p><?= RichText::asText($document->common_text); ?></p>
          </div>

          <div class="content">
            
            <div class="header">
              <div class="container-tab">
                <?php $i=1; foreach ($document->common_images as $t) { ?>
                  <div class="tab">
                    <div class="num">
                      <span><?php echo $i; ?></span>
                    </div>
                    <div class="text"><?= RichText::asText($t->text); ?></div>
                  </div>
                <?php $i++; } ?>
              </div>
              <div class="container-line">
                <div class="line"></div>
              </div>
            </div>

            <div class="container-step">

              <div class="step step-1">
                <div class="content-step">
                  <div class="container-text">
                    <h2><?= RichText::asText($document->subscription_title); ?></h2>
                    <p><?= RichText::asText($document->subscription_text); ?></p>
                  </div>
                  <div class="container-el">
                    <?php $i=1; foreach ($document->body as $slice) { ?>
                      <div class="el" data-subscription="<?php echo $i; ?>" data-stripe="<?= RichText::asText($slice->primary->stripe); ?>">
                        <?php if(strlen($slice->primary->tag[0]->text) > 0) { ?>
                          <div class="bdg">
                            <span><?= RichText::asText($slice->primary->tag); ?></span>
                          </div>
                        <?php } ?>
                        <div class="title"><?= RichText::asText($slice->primary->title); ?></div>
                        <div class="price">
                          <span><?= RichText::asText($slice->primary->price); ?><?= RichText::asText($slice->primary->symbol); ?></span>
                          <span><?= RichText::asText($slice->primary->by); ?></span>
                        </div>
                        <div class="desc"><?= RichText::asText($slice->primary->description); ?></div>
                        <div class="container-btn">
                          <div class="btn">
                            <span class="btn-text">
                              <?= RichText::asText($slice->primary->btntext); ?>
                            </span>
                          </div>
                        </div>
                        <ul>
                          <?php $i=1; foreach ($slice->items as $item) { ?>
                            <li>
                              <?php if($item->check) { ?>
                                <img class="icn" src="/img/tunnel/icn-1.svg" alt="">
                              <?php } else { ?>
                                <img class="icn" src="/img/tunnel/icn-2.svg" alt="">
                              <?php } ?>
                              <div class="text">
                                <?= RichText::asText($item->list); ?>
                              </div>
                            </li>
                          <?php } ?>
                        </ul>
                      </div>
                    <?php $i++; } ?>
                  </div>
                  <input type="hidden">
                </div>
                <div class="container-nav">
                  <div class="btn btn-prev">
                    <div class="btn-text">
                      <?= RichText::asText($document->subscription_btntextr); ?>
                    </div>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                    </svg>
                  </div>
                  <div class="btn btn-next style-disable">
                    <div class="btn-text">
                      <?= RichText::asText($document->subscription_btntextn); ?>
                    </div>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="step step-2">
                <div class="content-step">
                  <div class="container-title">
                    <h2><?= RichText::asText($document->informations_title); ?></h2>
                    <p><?= RichText::asText($document->informations_text); ?></p>
                  </div>
                  <div class="container-form">
                    <form onSubmit="return false;">
                      <input name="intent" type="text" value="0" style="display:none">
                      <input name="product" type="text" value="0" style="display:none">
                      <div class="container-col">
                        <div class="col">
                          <div class="title">
                            <?= RichText::asText($document->informations_lc_title); ?>
                          </div>
                          <div class="input">
                            <input required name="lastname" type="text" placeholder="<?= RichText::asText($document->informations_lc_lastname); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="firstname" type="text" placeholder="<?= RichText::asText($document->informations_lc_firstname); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="phone" type="text" placeholder="<?= RichText::asText($document->informations_lc_phone); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="adress" type="text" placeholder="<?= RichText::asText($document->informations_lc_adress); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="zipcode" type="text" placeholder="<?= RichText::asText($document->informations_lc_zipcode); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="country" type="text" placeholder="<?= RichText::asText($document->informations_lc_country); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="title">
                            <?= RichText::asText($document->informations_rc_title); ?>
                          </div>
                          <div class="input">
                            <input required name="mail" type="email" placeholder="<?= RichText::asText($document->informations_rc_mail); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="password-1" type="password" placeholder="<?= RichText::asText($document->informations_rc_password); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="password-2" type="password" placeholder="<?= RichText::asText($document->informations_rc_confirmepassword); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="checkbox">
                            <input name="cgu1" type="checkbox">
                            <input name="cgu2" type="number" style="display:none;">
                            <div class="text">
                              <?= RichText::asHtml($document->informations_rc_checkboxcgu); ?>
                            </div>
                          </div>
                          <div class="checkbox">
                            <input type="checkbox" name="inform1">
                            <input type="number" name="inform2" style="display:none;">
                            <div class="text">
                              <?= RichText::asText($document->informations_rc_checkboxinform); ?>
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="title"><?= RichText::asText($document->informations_pc_title); ?></div>
                          <div class="input">
                            <input required name="company" type="text" placeholder="<?= RichText::asText($document->informations_pc_company); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="siret" type="text" placeholder="<?= RichText::asText($document->informations_pc_siret); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="headoffice" type="text" placeholder="<?= RichText::asText($document->informations_pc_headoffice); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="pc_adress" type="text" placeholder="<?= RichText::asText($document->informations_pc_adress); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="pc_zipcode" type="text" placeholder="<?= RichText::asText($document->informations_pc_zipcode); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                          <div class="input">
                            <input required name="pc_country" type="text" placeholder="<?= RichText::asText($document->informations_pc_country); ?>">
                            <div class="error"><?= RichText::asText($document->common_error); ?></div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="container-nav">
                  <div class="btn btn-prev">
                    <div class="btn-text">
                      <?= RichText::asText($document->informations_btntextr); ?>
                    </div>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                    </svg>
                  </div>
                  <div class="btn btn-next style-disable">
                    <div class="btn-text">
                      <?= RichText::asText($document->informations_btntextn); ?>
                    </div>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                    </svg>
                  </div>
                </div>
              </div>

              <div class="step step-3">
                <div class="content-step">
                  <div class="container-title">
                    <h2><?= RichText::asText($document->payment_title); ?></h2>
                    <p><?= RichText::asText($document->payment_text); ?></p>
                  </div>
                  <div class="container-col">
                    <div class="col-pay">
                      <div class="title"><?= RichText::asText($document->payment_lt_title); ?></div>
                      <div class="container-cb">
                        <div class="container-img">
                          <?php foreach ($document->payment_lc_logos as $l) { ?>
                            <img src="<?= $l->img->url; ?>" alt="<?= $l->img->alt; ?>">
                          <?php } ?>
                        </div>
                      </div>
                      <form onSubmit="return false;">
                        <div class="container-steps"></div>
                        <div class="container-input">
                          <div class="input">
                            <input class="cardholderName" type="text" placeholder="<?= RichText::asText($document->payment_lc_name); ?>">
                          </div>
                          <div class="container-input-stripe input">
                            <div id="cardNumber-element"></div>
                            <div class="placeholder"><?= RichText::asText($document->payment_lc_number); ?></div>
                          </div>
                          <div class="container-input-stripe input">
                            <div id="cardExpiry-element"></div>
                            <div class="placeholder"><?= RichText::asText($document->payment_lc_date); ?></div>
                          </div>
                          <div class="container-input-stripe input">
                            <div id="cardCvc-element"></div>
                            <div class="placeholder"><?= RichText::asText($document->payment_lc_cvv); ?></div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-recap">
                      <div class="title"><?= RichText::asText($document->payment_rc_title); ?></div>
                      <div class="container-recap">
                        <div class="infos">
                          <div class="container-name">
                            <div class="name-1"></div>
                            <div class="name-2"></div>
                          </div>
                          <div class="abonnement">
                            <?= RichText::asText($document->payment_rc_subscription); ?>
                          </div>
                        </div>
                        <div class="container-price">
                          <div class="text">
                            <?= RichText::asText($document->payment_rc_amount); ?>
                          </div>
                          <div class="price"></div>
                        </div>
                        <div class="container-text">
                          <p>
                            <?= RichText::asText($document->payment_rc_text); ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>  
                </div>    
                <div class="container-nav">
                  <div class="btn btn-prev">
                    <div class="btn-text">
                      <?= RichText::asText($document->payment_btntextr); ?>
                    </div>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                    </svg>
                  </div>
                  <div class="btn btn-next">
                    <div class="btn-text">
                      <?= RichText::asText($document->payment_btntextn); ?>
                    </div>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                    </svg>
                    <svg class="btn-load style-none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;" width="25px" height="25px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                      <path d="M10 50A40 40 0 0 0 90 50A40 42.5 0 0 1 12 50" fill="#212121" stroke="none">
                        <animateTransform attributeName="transform" type="rotate" dur="0.9900990099009901s" repeatCount="indefinite" keyTimes="0;1" values="0 50 51.25;360 50 51.25"></animateTransform>
                      </path>
                    </svg>
                  </div>
                </div>  
              </div>

              <div class="step step-4">
                <div class="content-step">
                  <div class="icn">
                    <img src="/img/tunnel/icn-check.svg" alt="">
                  </div>
                  <h2>
                    <?= RichText::asText($document->validation_title); ?>
                  </h2>
                  <p>
                    <?= RichText::asText($document->validation_text); ?>
                  </p>
                  <div class="container-btn">
                    <a href="<?= checkUrl($document->validation_btnlink); ?>" class="btn">
                      <span class="btn-text"><?= RichText::asText($document->validation_btntext); ?></span>
                      <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                        <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </section>

    </main>

    <script type="text/javascript" src="/script/minify/tunnel-min.js"></script>
  </body>
</html>

<script>
//$('.step-1').removeClass('style-show');
//$('.step-3').addClass('style-show');
</script>



