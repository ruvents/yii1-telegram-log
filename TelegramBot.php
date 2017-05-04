<?php
namespace ruvents\log;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;

class TelegramBot extends \CComponent
{
    const API_BASE_URL = 'https://api.telegram.org/bot';

    public $token;

    private $_client;

    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        if ($this->_client) {
            return $this->_client;
        }

        return new Client();
    }

    public function sendMessage($chat_id, $text, $parse_mode = null, $disable_web_page_preview = null, $disable_notification = null, $reply_to_message_id = null, $reply_markup = null)
    {

        $client = $this->getClient();

        $body = json_encode(compact('chat_id', 'text', 'parse_mode', 'disable_web_page_preview', 'disable_notification', 'reply_to_message_id', 'reply_markup'));
        $headers = [
            'Content-Type' => 'application/json'
        ];

        try{
            $url = self::API_BASE_URL . $this->token . '/sendMessage';
            $request = $client->createRequest('POST', $url, $headers ,$body);
            $request->send();
        }catch (\Exception $e){
            return false;
        }

        return true;
    }
}
