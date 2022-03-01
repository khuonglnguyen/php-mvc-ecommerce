<?php
	// APP ROOT
	define('APP_ROOT', dirname(dirname(__FILE__)));
	
	// URL ROOT (Liens dynamiques)
    if(strpos($_SERVER['HTTP_HOST'], "localhost") !== false || strpos($_SERVER['HTTP_HOST'], "127.0.0.1") !== false){
        define('URL_ROOT', "http://" . $_SERVER['HTTP_HOST'] . str_replace("/index.php", "", $_SERVER['SCRIPT_NAME']));
    } else {
        define('URL_ROOT', "https://".$_SERVER['HTTP_HOST'].str_replace("/index.php", "", $_SERVER['SCRIPT_NAME']));
    }
	// Nom du site
	define('SITE_NAME', str_replace("/public/index.php", "", $_SERVER['SCRIPT_NAME']));