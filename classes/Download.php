<?php
//下載行為
class Download{
	private $_httpClient;
        private $_bot;
        private $_config;
        function __construct(Config $config){
		$this->_config = $config;
                $this->_httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->_config->Channel_Token());
                $this->_bot = new \LINE\LINEBot($this->_httpClient, ['channelSecret' => $this->_config->Channel_Secret()]);
	}
	public function figureOutType($json_string){
		$echoarray = json_decode($json_string,true);
		$type = $echoarray["events"][0]["message"]["type"];
		if($type == "video"){
			$this->_downloadVideo($echoarray["events"][0]["message"]["id"]);
		}
	}
	private function _downloadVideo($fileId){
		$response = $this->_bot->getMessageContent($fileId);
		if ($response->isSucceeded()) {
		    $tempfile = tmpfile();
		    $file = fopen("/mnt/file/video/".$fileId.".mp4","w+");
                    fwrite($file, $response->getRawBody());
                    fclose($file);
		    //fwrite($tempfile, $response->getRawBody());
		    //error_log($response->getRawBody());
		} else {
		    error_log($response->getHTTPStatus() . ' ' . $response->getRawBody());
		}
	}
}
