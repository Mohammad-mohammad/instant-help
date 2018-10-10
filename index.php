<?php
date_default_timezone_set('Asia/Damascus');
$yii = dirname(__FILE__).'/framework/yii.php';
$config = dirname(__FILE__).'/protected/config/front.php';
  
// Remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
  
require_once($yii);
Yii::createWebApplication($config)->runEnd('front');