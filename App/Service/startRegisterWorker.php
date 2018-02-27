<?php
/**
 * 注册池
 */

use \Workerman\Worker;
use \GatewayWorker\Register;

class RegisterService
{
    public $registerWorker;
    //进程初始化
    public  function init()
    {
        //实例一个注册池,设置监听ip和端口
        $this->registerWorker = new Register('text://0.0.0.0:6666');
        //注册池名称
        $this->registerWorker->name = 'RegisterWorker';
        //日志文件
        Worker::$stdoutFile = LOG_PATH . '/GatewayWorker.log';
    }

    //进程启动
    public  function runAll()
    {
        var_dump($this->registerWorker);
        if(is_null($this->registerWorker)){
            return ;
        }
        //若不是在根目录启动,则运行runAll()
        if (!defined('GLOBAL_START')) {
            Worker::runAll();
        }
    }
}

$RegisterService = new RegisterService();
$RegisterService->init();
$RegisterService->runAll();


