<?php
// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION, '5.3.0', '<')) die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('DEBUG', true);

define('MYSQL_DATABASE', 'think');
define('MYSQL_USERNAME', 'root');
define('MYSQL_PASSWORD', '');
// 定义应用目录
define('APP_NAME', 'App');
define('TEMP_PATH', './Data/');

define('MODULE_LIST', 'Index,Admin');
define('APP_PATH', './'.APP_NAME.'/');

require './hdphp/hdphp.php';
