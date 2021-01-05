<?php namespace Config;

define("ROOT", str_replace("\\", "/", dirname(__DIR__)) . "/");

//Path to your project's root folder
define("FRONT_ROOT", "/MoviePass2/");
define("VIEWS_PATH", "Views/");

define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", FRONT_ROOT.VIEWS_PATH ."img/");

define("ICONS_PATH", FRONT_ROOT.VIEWS_PATH ."icons/");

define("SCSS_PATH", FRONT_ROOT.VIEWS_PATH ."scss/");
define("VENDOR_PATH", FRONT_ROOT.VIEWS_PATH ."vendor/");


define("DB_HOST", "localhost");
define("DB_NAME", "movie_pass");
define("DB_USER", "root");
define("DB_PASS", "");

?>




