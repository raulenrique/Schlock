<?php 

date_default_timezone_set("Pacific/Auckland");

error_reporting(E_ALL);

// function my_autoloader($class){
// 	require 'classes/'.$class.'.php';
// }
// spl_autoload_register('my_autoloader');


require '../schlock-config.inc.php';

require 'vendor/autoload.php';

session_start();
session_regenerate_id(true);

$auth = new App\Services\AuthenticationService();

App\Views\View::registerAuthenticationService($auth);
App\Controllers\Controller::registerAuthenticationService($auth);

require "routes.php";

// require "databasecreation.php";


