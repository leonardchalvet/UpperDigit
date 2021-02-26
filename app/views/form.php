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

    <link rel="stylesheet" type="text/css" href="/style/css/tunnel.css">

  </head>
  
  <body>

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
                      <div class="el" data-subscription="<?php echo $i; ?>">
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
                    <h2>Créez votre compte.</h2>
                    <p>Afin de mieux se connaîre, veuillez remplir les champs ci-dessous</p>
                  </div>
                  <div class="container-form">
                    <form onSubmit="return false;">
                      <div class="container-col">
                        <div class="col">
                          <div class="title">
                            Informations personnelles
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Nom*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Prénom*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Téléphone*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Adresse postale*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Code Postal*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Pays/Région*">
                            <div class="error">Error</div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="title">
                            Sécurité
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Votre adresse mail*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Mot de passe* ">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Confimez votre mot de passe*">
                            <div class="error">Error</div>
                          </div>
                          <div class="checkbox">
                            <input required type="checkbox">
                            <div class="text">
                              J'ai lu et j'accepte les <a href="">Conditions Générales d'Utilisations.</a>
                            </div>
                          </div>
                          <div class="checkbox">
                            <input type="checkbox">
                            <div class="text">
                              Je souhaite être informé des actualités, publications et offres de MesQuestions.fr
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="title">Informations professionnelles</div>
                          <div class="input">
                            <input required type="text" placeholder="Nom de votre société*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Numéro de SIRET*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Siège social*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Adresse professionnelle*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Code Postal*">
                            <div class="error">Error</div>
                          </div>
                          <div class="input">
                            <input required type="text" placeholder="Pays*">
                            <div class="error">Error</div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="container-nav">
                  <div class="btn btn-prev">
                    <div class="btn-text">
                      Quitter
                    </div>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                    </svg>
                  </div>
                  <div class="btn btn-next style-disable">
                    <div class="btn-text">
                      Continuer
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
                    <h2>Procédez au paiement.</h2>
                    <p>Veuillez remplir les champs ci-dessous afin de procéder au paiement.</p>
                  </div>
                  <div class="container-col">
                    <div class="col-pay">
                      <div class="title">Informations de paiement</div>
                      <div class="container-services">
                        <div class="service">
                          <img src="/img/tunnel/gg-pay.svg" alt="">
                        </div>
                        <div class="service">
                          <img src="/img/tunnel/apple-pay.svg" alt="">
                        </div>
                      </div>
                      <div class="container-sep">
                        <div class="line"></div>
                        <div class="text">
                          Ou payer par carte bancaire
                        </div>
                        <div class="line"></div>
                      </div>
                      <div class="container-cb">
                        <div class="container-img">
                          <img src="/img/tunnel/cb-plaholder-1.png" alt="">
                          <img src="/img/tunnel/cb-plaholder-2.png" alt="">
                        </div>
                      </div>
                      <form onSubmit="return false;">
                        <div class="container-input">
                          <div class="input">
                            <input type="text" placeholder="Titulaire de la carte*">
                          </div>
                          <div class="input">
                            <input type="text" placeholder="Numéro de carte*">
                          </div>
                          <div class="input">
                            <input type="text" placeholder="MM/AA*">
                          </div>
                          <div class="input">
                            <input type="text" placeholder="CVV*">
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-recap">
                      <div class="title">Récapitualitf de votre commande</div>
                      <div class="container-recap">
                        <div class="infos">
                          <div class="container-name">
                            <div class="name-1">Léonard</div>
                            <div class="name-2">
                            Chalvet
                            </div>
                          </div>
                          <div class="abonnement">
                            Abonnement Particulier
                          </div>
                        </div>
                        <div class="container-price">
                          <div class="text">
                            Montant total à payer
                          </div>
                          <div class="price">
                            32€/mois
                          </div>
                        </div>
                        <div class="container-text">
                          <p>
                            En poursuivant, vous acceptez nos conditions d’abonnement. Votre abonnement sera automatiquement renouvelé et votre mode de paiement enregistré sera facturé, à moins que vous ne résiliez votre abonnement à tout moment avant le prochain cycle de facturation.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>  
                </div>    
                <div class="container-nav">
                  <div class="btn btn-prev">
                    <div class="btn-text">
                      Retour
                    </div>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
                    </svg>
                  </div>
                  <div class="btn btn-next">
                    <div class="btn-text">
                      Payer et confirmer
                    </div>
                    <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                      <use xlink:href="/img/common/icn-arrow.svg#content"></use>
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
                    Paiement validé.
                  </h2>
                  <p>
                    Accédez désormais à votre compte MesQuestions.fr
                  </p>
                  <div class="container-btn">
                    <a href="" class="btn">
                      <span class="btn-text">Accéder à votre compte</span>
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