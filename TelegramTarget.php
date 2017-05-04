<?php
namespace ruvents\log;

class TelegramTarget extends \CLogRoute
{

    public $token;

    public $chat;

    public function processLogs($logs)
    {
        $bot = new TelegramBot($this->token);
        $bot->sendMessage($this->chat, "a");

        //foreach($logs as $log){
        //    $bot->sendMessage($this->chat, $log[0]);
        //}

    }

}
