<?php
// 标记是全局启动
define('GLOBAL_START', 1);
//根目录
define('ROOT_PATH',__DIR__);
//项目根目录
define('APP_ROOT',ROOT_PATH.'/App');
//项目启动目录
define('APP_START_ROOT',APP_ROOT.'/Service');
//日志目录
define('LOG_PATH',ROOT_PATH.'/Runtime');
//引入自动加载
require_once __DIR__ . '/Gateway/vendor/autoload.php';
//检测文件
require_once __DIR__.'/check.php';
