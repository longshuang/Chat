<?php
/**
 * 入口池
 */

use GatewayWorker\Gateway;
use Workerman\Worker;

class GatewayWorkerService
{
    public $GatewayWorker;

    //初始化
    public function init()
    {
        //实例一个入口池
        $this->GatewayWorker = new Gateway('text://0.0.0.0:7272');
        //入口池名称
        $this->GatewayWorker->name = 'GatewayWorker';
        //进程数
        $this->GatewayWorker->count = 4;
        //本机ip,分布式时使用内网ip
        $this->GatewayWorker->lanIp = '127.0.0.1';
        //进程端口 2500 2501 2502 2503
        $this->GatewayWorker->startPort = 2500;
        //将入口池注册到注册池
        $this->GatewayWorker->registerAddress = '127.0.0.1:6666';

        //回调
        $this->GatewayWorker->onWorkerStart = array($this, 'onWorkerStart');
    }

    //进程初始化
    public function onWorkerStart($worker)
    {
        //初始化mysql

        //初始化redis
    }

    public function runAll()
    {
        if (is_null($this->GatewayWorker)) {
            return;
        }
        //若不是在根目录启动,则运行runAll()
        if (!defined('GLOBAL_START')) {
            Worker::runAll();
        }
    }
}

$GatewayWorkerService = new GatewayWorkerService();
$GatewayWorkerService->init();
$GatewayWorkerService->runAll();






