<?php

if (stristr($_SERVER['HTTP_HOST'], ".yoobee.net.nz")){
	

define("DEV ENVIRONMNENT", false);
//production phase

ini_set('display_errors', false);
ini_set('log_errors', 1);
ini_set('error_log', getcwd() . "/php-error.log");

define("MAILGUN_KEY", '');
define("MAILGUN_DOMAIN" , '');

define("DB_HOST", 'localhost');
define("DB_NAME", 'raulmalq_schlock');
define("DB_USER", 'raulmalq_RSD');
define("DB_PASSWORD", 'rerm9207');

} else {

define("DEV ENVIRONMNENT", true);
//local development phase

ini_set('display_errors', true);
ini_set('log_errors', 1);
ini_set('error_log', getcwd() . "/php-error.log");

define("MAILGUN_KEY", 'key-32d563349310ff041b03b4015120d421');
define("MAILGUN_DOMAIN" , 'sandbox528ac6793aa4452db9f48a0ed1ceb297.mailgun.org');


define("DB_HOST", 'localhost');
define("DB_NAME", 'schlock');
define("DB_USER", 'root');
define("DB_PASSWORD", '');

}