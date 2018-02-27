<?php
/**
 * 业务池
 */

use GatewayWorker\BusinessWorker;
use Workerman\Worker;
class BusinessWorkerService{

    public $businessWorker;
    //初始化
    public function init(){
        //实例一个业务Worker容器
        $this->businessWorker = new BusinessWorker();
        //Worker容器名称
        $this->businessWorker->name = 'BusinessWorker';
        //进程数
        $this->businessWorker->count = 4;
        //将业务池注册到注册池
        $this->businessWorker->registerAddress = '127.0.0.1:6666';
    }

    //启动
    public function runAll(){

        if(is_null($this->businessWorker)){
            return ;
        }

        //若不是在根目录启动,则运行runAll()
        if (!defined('GLOBAL_START')) {
            Worker::runAll();
        }
    }

}

$BusinessWorkerService = new BusinessWorkerService();
$BusinessWorkerService->init();
$BusinessWorkerService->runAll();

