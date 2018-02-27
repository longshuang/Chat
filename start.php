<?php
ini_set('display_errors', 'on');

use Workerman\Worker;

//引入初始化文件
require_once __DIR__ . '/init.php';
//加载所有启动文件，以便启动所有服务
foreach (glob(APP_START_ROOT . '/start*.php') as $startFile) {
    require_once $startFile;
}

// 运行所有服务
Worker::runAll();