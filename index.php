<?php 

use Core\Application;

define('BASE_PATH',__DIR__);

define('DB_FOLDER_PATH', BASE_PATH.'/db');

define('APP_FOLDER_PATH',BASE_PATH.'/app');

require_once __DIR__.'/vendor/autoload.php';

$config = require_once __DIR__.'/config/main.php';

$url = empty($_GET['route']) == true ? null : $_GET['route'];
$app = new Application($url,$config);