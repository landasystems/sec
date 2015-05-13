<?php

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

// change the following paths if necessary
require_once(dirname(__FILE__) . '/../../../common/config/seclaunch.php');
require_once(dirname(__FILE__) . '/../../../common/globals.php');
require_once(dirname(__FILE__) . '/../../../common/lib/yii/yii.php');

$config_app = require(dirname(__FILE__) . '/../../config/main.php');
$config_index = array(
    'theme' => 'uc',
);
$_SESSION['date_launch'] = 'Mar 25, 2015 12:00:00';
//$config_index = array();
$config = CMap::mergeArray($config_index, $config_app);

Yii::createWebApplication($config)->run();
?>
