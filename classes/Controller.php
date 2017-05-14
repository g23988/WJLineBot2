<?php
//控制行為
class Controller{
	private $_client;
	private $_config;
        function __construct(Config $config){
                $this->_config = $config;
        }
	function think($info){
		$message = $info["Messages"][0]["Body"];
		$message_arr = json_decode($message,true);
		if(!is_null($message_arr["events"][0]["message"]) && $message_arr["events"][0]["message"]["type"] == "text"){
			$talk = new Talk($this->_config);
			$talk->reply_message($info);
		}
		var_dump($message_arr);
	}
}
