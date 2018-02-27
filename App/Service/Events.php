<?php

use GatewayWorker\Lib\Gateway;

/**
 * Class Events 业务事件处理
 * @package App
 */
class Events
{
    /**
     * 客户端连接
     * @param $client_id
     * @throws Exception
     */
    public static function onConnect($client_id)
    {
        //发送给当前连接客户端
        $ClientMessage = 'welcome to join us';
        Gateway::sendToClient($client_id, $ClientMessage);
        //发送给所有客户端
        $AllMessage = $client_id . ' is coming';
        Gateway::sendToAll($AllMessage);
    }


    /**
     * 接收客户端消息
     * @param $client_id
     * @param $message
     * @throws Exception
     */
    public static function onMessage($client_id, $message)
    {
        $message = json_decode($message,true);
        switch ($message['type']) {
            case 'login':
                Gateway::bindUid($client_id,$message['uid']);
                break;
            case 'PL':
                Gateway::sendToClient($message['client_id'], $message['msg']);
                break;
            case 'toAll':
                Gateway::sendToAll($message['msg']);
                break;
            default:
                $array['client_id'] = $client_id;
                $array['message'] = $message;
                var_dump($array);
                break;
        }

    }


    /**
     * 关闭客户端连接
     * @param $client_id
     */
    public static function onClose($client_id)
    {
        Gateway::closeClient($client_id);
    }

}