<?php

/**
 * Shaarli REST API
 */

$configFile = __DIR__.'/config.php';

if( !file_exists($configFile) )
	exit('Please setup your config.php');

require $configFile;

require __DIR__.'/vendor/autoload.php';

/**
 * Database configuration
 * doc: http://paris.readthedocs.org/en/latest/configuration.html#setup
 */

if(!defined('DB_TYPE')) {
    define('DB_TYPE', 'mysql');
}

if(DB_TYPE=="sqlite"){
	// sqlite
	ORM::configure('sqlite:./database/database.db');
}elseif(DB_TYPE=="mysql"){
	// mysql
	ORM::configure('mysql:host='. DB_HOST .';dbname='. DB_NAME);
	ORM::configure('username', DB_USER);
	ORM::configure('password', DB_PASS);
}else{
	die("Error in config.php. DB_TYPE is not sqlite or mysql");
}