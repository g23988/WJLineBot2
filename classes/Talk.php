<?php
//控制chat行為
class Talk{
	private $_httpClient;
	private $_bot;
	private $_config;
        function __construct(Config $config){
		$this->_config = $config;
		$this->_httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->_config->Channel_Token());
		$this->_bot = new \LINE\LINEBot($this->_httpClient, ['channelSecret' => $this->_config->Channel_Secret()]);
	}
	public function reply_message($json_string){
		$echoarray = json_decode($json_string,true);
		$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
		$response = $this->_bot->replyMessage($echoarray["events"][0]["replyToken"], $textMessageBuilder);
		$log = $response->getHTTPStatus() . ' ' . $response->getRawBody();
		
		if($response->getHTTPStatus()!=200) return false;
		return true;
	}
}
