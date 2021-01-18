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

    <script type="text/javascript" src="/script/minify/jQuery.3.3.1-min.js"></script>

  </head>
  
  <body>

    <?php include('common-header.php') ?>

    <main>
      
    </main>

    <?php include('common-footer.php') ?>

    <script type="text/javascript" src="/script/minify/common-min.js"></script>
    <script type="text/javascript" src="/script/minify/index-min.js"></script>
  </body>
</html>