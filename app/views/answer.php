<?php 
use Prismic\Dom\RichText;
$document = $WPGLOBAL['document']->data;

$question = $_POST['question'];
$answer = $_POST['answer'];

?>
<html>
  <head>

    <title><?= RichText::asText($document->global_title); ?></title>

    <meta name="description" content="<?= RichText::asText($document->global_description); ?>" />

    <meta http-equiv="content-type" content="text/html; charset=utf8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/style/css/answer.css">

  </head>
  
  <body>

    <?php include('common-header.php') ?>

    <main>
      
      <div class="container-lightbox">
        <div class="lightbox lightbox-1">
          <div class="cross">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" >
              <use xlink:href="/img/common/icn-cross.svg#content"></use>
            </svg>
          </div>
          <h3>Ces informations vous ont-elles étés utiles ?</h3>
          <p class="desc">
            Dans l’optique d’améliorer notre service et nos réponses, veuillez répondre à notre enquête de satifaction afin d’améliorer no
          </p>
          <div class="container-action">
            <div class="btn">
              <div class="btn-text">Oui</div>
            </div>
            <div class="btn">
              <div class="btn-text">Non</div>
            </div>
          </div>
          <p class="text">
            Merci de votre réponse et de votre visite. À bientôt !
          </p>
        </div>
        <div class="lightbox lightbox-2">
          <div class="cross">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" >
              <use xlink:href="/img/common/icn-cross.svg#content"></use>
            </svg>
          </div>
          <h3>Merci de votre confiance !</h3>
          <p class="desc">
            Vous avez atteint le nombre de recherches gratuites.<br>
            <br>
            Pour continuer l'expérience, nous vous invitons à vous créer un compte afin de pouvoir continuer à poser vos questions 
          </p>
          <div class="container-btn">
            <div class="btn">
              <div class="btn-text">Abonnez-vous dès maintenant</div>
              <svg class="btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 16" >
                <use xlink:href="/img/common/icn-arrow.svg#content"></use>
              </svg>
            </div>
          </div>
          <p class="text">
            Vous êtes déjà inscrit ? <a href="">Connectez-vous</a>
          </p>
        </div>
      </div>

      <section class="section-search">
        <div class="wrapper">
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
                <input type="text" placeholder="<?= RichText::asText($document->answer_placeholder); ?>">
                <div class="container-action">
                  <button>
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
                <div class="container-placeholder">
                  <ul>
                    <li>
                      <div class="title">Questions récurentes</div>
                    </li>
                    <li>
                      <a href="">Comment faire sa comptabilité ?</a>
                    </li>
                    <li>
                      <a href="">Comment faire sa comptabilité ?</a>
                    </li>
                    <li>
                      <a href="">Comment faire sa comptabilité ?</a>
                    </li>
                    <li>
                      <a href="">Comment faire sa comptabilité ?</a>
                    </li>
                  </ul>
                </div>
                <div class="container-result">
                  <ul>
                    <li>
                      <a href="">Comment faire sa comptabilité ?</a>
                    </li>
                    <li>
                      <a href="">Comment faire sa comptabilité ?</a>
                    </li>
                    <li>
                      <a href="">Comment faire sa comptabilité ?</a>
                    </li>
                    <li>
                      <a href="">Comment faire sa comptabilité ?</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </section>

      <section class="section-answer">
        <div class="wrapper">
          <div class="container-answer">
            <div class="answer">
              <h2><?php echo($question); ?></h2>
              <p><?php echo($answer); ?></p>
              <p class="blur-answer"></p>
            </div>
            <div class="container-informations">
              <?= RichText::asHtml($document->answer_question); ?>
              <div class="container-action">
                <div class="btn">
                  <div class="btn-text"><?= RichText::asText($document->answer_btnyes); ?></div>
                </div>
                <div class="btn">
                  <div class="btn-text"><?= RichText::asText($document->answer_btnno); ?></div>
                </div>
              </div>
            </div>
            <div class="resp">
              <?= RichText::asHtml($document->answer_title); ?>
              <?= RichText::asHtml($document->answer_text); ?>
            </div>
          </div>
          <div class="container-questions">
            <h2><?= RichText::asHtml($document->answer_questionr); ?></h2>
            <ul>
              <li>
                <a href="">
                  <span class="link-text">Quel est le but de la comptabilité ?</span>
                  
                </a>
              </li>
              <li>
                <a href="">
                  <span class="link-text">Quel est le but de la comptabilité ?</span>
                </a>
              </li>
              <li>
                <a href="">
                  <span class="link-text">Quel est le but de la comptabilité ?</span>
                </a>
              </li>
            </ul>
          </div>  
        </div>
      </section>

      <?php include('common-section-start.php') ?>

    </main>

    <?php include('common-footer.php') ?>

    <script type="text/javascript" src="/script/minify/answer-min.js"></script>
  </body>
</html>