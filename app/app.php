<?php

/*
 * This is the main file of the application, including routing and controllers.
 *
 * $app is a Slim application instance, see the framework documentation for more details:
 * http://docs.slimframework.com/
 *
 * The order of the routes matter, as it will define the priority of routes. For that reason we
 * need to keep the more "generic" routes, such as the pages route, at the end of the file.
 *
 * If you decide to change the URLs, make sure to change PrismicLinkResolver in LinkResolver.php
 * as well to make sures links in your site are correctly generated.
 */

use Prismic\Api;
use Prismic\Predicates;

require_once 'includes/http.php';

/*
 *  --[ INSERT YOUR ROUTES HERE ]--
 */

// Index page
$app->get('/', function ($request, $response) use ($app, $prismic) {

    $api = $prismic->get_api(); // PART 1 - Call api

    //PART 2 - Call Header & Footer
    $header = $api->getByUID('header', 'header');
    $footer = $api->getByUID('footer', 'footer');
    $lightbox = ""; //$api->getByUID('lightbox', 'lightbox', $options);

    //PART 3 - Call home page (ask to client for default languages)
    $document = $api->getByID(''); //For get ID, print_r($document) in home views, ctrl-c [id]

    render($app, 'home', array('document' => $document, 'lightbox' => $lightbox, 'header' => $header, 'footer' => $footer));
    
});

// Call page with name => https://url.com/namepage
$app->get('/{uid}', function ($request, $response, $args) use ($app, $prismic) {
    $api = $prismic->get_api(); // PART 1 - Call api

    //PART 2 - Call Header & Footer
    $header = $api->getByUID('header', 'header');
    $footer = $api->getByUID('footer', 'footer');
    
    //PART 3 - Call current page
    $document = NULL;
    $nType = 0;
    $arrayTypes = ['']; // UPDATE NAME OF CUSTOM TYPE HERE (only if exist in CONTENT)
    $arrayView = ['']; // NAME IN "VIEWS" FOLDER, ALWAYS SAME POSITION BETWEEN "arrayTypes" & "arrayView"
    foreach ($arrayTypes as $type) {
        $document = $api->getByUID($type, $args['uid']);
        
        $nType++;
        if($document != NULL) {
            break;
        }
    }

    //PART 4 - Call good view
    if($document != NULL) {
      render($app, $arrayView[$nType-1], array('document' => $document, 'header' => $header, 'footer' => $footer));
    }
    else {
      header('Location: /'); // 404 or /
      exit;
    }
});

// Call page with language and name => https://url.com/language/namepage
$app->get('/{lg}/{uid}', function ($request, $response, $args) use ($app, $prismic) {
    $api = $prismic->get_api(); // PART 1 - Call api

    //PART 2 - Select languages
    $allLang = switchLanguages($args['lg']);
    if(!$allLang) {
        header('Location: /'); // 404 or /
        exit;
    }
    $options = false;
    foreach ($allLang as $lang) {
        $testReturn = $api->getByUID('header',   'header', [ 'lang' => $lang ] );
        if($testReturn) {
            $options = [ 'lang' => $lang ];
            break;
        }
    }
    if(!$options) {
        header('Location: /'); // 404 or /
        exit;
    }

    //PART 3 - Call Header & Footer & Lightbox
    $header   = $api->getByUID('header',   'header',   $options);
    $footer   = $api->getByUID('footer' ,  'footer',   $options);
    $lightbox = ""; //$api->getByUID('lightbox', 'lightbox', $options);

    //PART 4 - Call current page
    $document = NULL;
    $nType = 0;
    $arrayTypes = ['']; // UPDATE NAME OF CUSTOM TYPE HERE (only if exist in CONTENT)
    $arrayView  = ['']; // NAME IN "VIEWS" FOLDER, ALWAYS SAME POSITION BETWEEN "arrayTypes" & "arrayView"
    foreach ($arrayTypes as $type) {
        $document = $api->getByUID($type, $args['uid'], $options);
        $allLang = $api->getByUID($type, $args['uid'], [ 'lang' => '*' ] );
        
        $nType++;
        if($document != NULL) {
            break;
        }
    }

    //PART 5 - Call good view
    if($document != NULL) {
      if($arrayView[$nType-1] == 'post') {
      	header('Location: /'.$args['lg'].'/blog/'.$args['uid']. '');
      	exit(); 
      }
      else if($arrayView[$nType-1] == 'blog') {
      	$options['pageSize'] = 8;
  	  	$posts = $api->query(Predicates::at('document.type', 'page_blog'), $options);
  	  	render($app, $arrayView[$nType-1], array('document' => $document, 'posts' => $posts, 'header' => $header, 'footer' => $footer, 'lightbox' => $lightbox));
      }
      else {
      	render($app, $arrayView[$nType-1], array('document' => $document, 'header' => $header, 'footer' => $footer, 'lightbox' => $lightbox));
      }
    }
    else {
      header('Location: /'); // 404 or /
      //header('Location: /'.$args['lg'].'/404'); // 404 or /
      exit;
    }
});

//ADD LANGUAGES FOR MORE POSSIBILITIES
function switchLanguages($lg) {

    $lglg = '';
    switch (strtoupper($lg)) {

        case 'FR': return [ 'fr-fr', 'fr-be', 'fr-ca', 'fr-lu', 'fr-ch' ];
        case 'EN': return [ 'en-us', 'en-au', 'en-eu', 'en-bz', 'en-ca', 'en-de', 'en-gb', 'en-in', 'en-ie', 'en-jm', 'en-nz', 'en-ph', 'en-pl', 'en-za', 'en-tt' ];
        case 'US': return [ 'en-us', 'en-au', 'en-eu', 'en-bz', 'en-ca', 'en-de', 'en-gb', 'en-in', 'en-ie', 'en-jm', 'en-nz', 'en-ph', 'en-pl', 'en-za', 'en-tt' ];
        case 'DE': return [ 'de-at', 'de-de', 'de-li', 'de-lu', 'de-ch' ];
        case 'ES': return [ 'es-ar', 'es-bo', 'es-cl', 'es-co', 'es-cr', 'es-do', 'es-ec', 'es-sv', 'es-gt', 'es-hn', 'es-mx', 'es-ni', 'es-pa', 'es-py', 'es-pe', 'es-pr', 'es-es', 'es-uy', 'es-ve' ];
        case 'IT': return [ 'it-it', 'it-ch' ];
        case 'JP': return [ 'ja-jp' ];
        
        default: return false;
    }

    //return [ 'lang' => $lglg ];
}