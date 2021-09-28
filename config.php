<?php

/****************************************************
 * This is the configuration file,
 * the only necessary change is the repository URL,
 * other changes are optional
 ****************************************************/

/*
 * Change this for the URL of your repository
 */
define('PRISMIC_URL', 'https://upperdigit.prismic.io/api/v2');
define('PRISMIC_TOKEN', null);

/*
 * Your site metadata
 */
define('SITE_TITLE', 'upperdigit');
define('SITE_DESCRIPTION', 'upperdigit');

/*
 * Set to true to display error details
 */
define('DISPLAY_ERROR_DETAILS', true);


/*
 * DB LOCAL
 */
define("DB_HOST","localhost");
define("DB_BASE","upperdigit");
define("BD_USER","root");
define("BD_PASSWORD","root");

/*
 * DB ALWAYS DATA
 *
define("DB_HOST","mysql-agence-me.alwaysdata.net");
define("DB_BASE","agence-me_upperdigit");
define("BD_USER","agence-me");
define("BD_PASSWORD","BrunoxUpper");*/

/* 
 * STRIPE
 */
define("STRIPE_TVA", "txr_1JIZJxFhVHJZbiNtCoDYvxa3");
define("STRIPE", "sk_test_51ITTz8FhVHJZbiNtRXPJV5sjeURaaezfgu5b1EkTEEDC6rdu40ePchl5D7ziDfRqsfUdaqkJAOejz5InhuIkZhUk00meP0tJwv");