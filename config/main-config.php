<?php
// config app

define('HOST_APP',$_SERVER['HTTP_HOST']);

// config JWT 

define('SECRET_TOKEN','app-secrer-token');
define('HASH_TOKEN','HS512');


// config database 
define('DB_CONNECTION','mysql');
define('DB_HOST'     , "localhost");
define('DB_DATABASE' , "crud-rest-api-php");
define('DB_USERNAME' , "root");
define('DB_PASSWOR'  , "");