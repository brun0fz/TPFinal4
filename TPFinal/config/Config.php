<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/TPFinal4/TPFinal/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "layout/styles/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", FRONT_ROOT.VIEWS_PATH . "img/");
define("ASSETS_PATH", FRONT_ROOT.VIEWS_PATH . "img/assets/");
define("VID_PATH", FRONT_ROOT.VIEWS_PATH . "video/");

//DATABASE LOCAL
define("DB_HOST", "localhost");
define("DB_NAME", "PetHero");
define("DB_USER", "root");
define("DB_PASS", "");

define("ENCRYPTPASS", "0e253a4119d31e6bf2021696f3d61729");

//DATABASE ONLINE
/*
define("DB_HOST", "bumivsrscryp1fqpzsmn-mysql.services.clever-cloud.com");
define("DB_NAME", "bumivsrscryp1fqpzsmn");
define("DB_USER", "u1x4he9n7ufecekv");
define("DB_PASS", "0ILV8Bkh48BjAsMBlf7E");
*/
?>




