<?php
//下載行為
class Download{
	private $_httpClient;
        private $_bot;
        private $_config;
	private $_redis;
        function __construct(Config $config){
		$this->_config = $config;
                $this->_httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->_config->Channel_Token());
                $this->_bot = new \LINE\LINEBot($this->_httpClient, ['channelSecret' => $this->_config->Channel_Secret()]);
		$this->_redis = new Predis\Client([
			'scheme' => 'tcp',
			'host'   => $this->_config->Redis_Server(),
			'port'   => $this->_config->Redis_Port(),
		]);
	}
	public function figureOutType($json_string){
		$echoarray = json_decode($json_string,true);
		$type = $echoarray["events"][0]["message"]["type"];
		if($type == "video"){
			$this->_pushInRedis($echoarray["events"][0]["message"]["id"]);
		}
	}
	private function _downloadVideo($fileId){
		$response = $this->_bot->getMessageContent($fileId);
		if ($response->isSucceeded()) {
		    $tempfile = tmpfile();
		    $file = fopen("/mnt/file/video/".$fileId.".mp4","w+");
                    fwrite($file, $response->getRawBody());
                    fclose($file);
		} else {
		    error_log($response->getHTTPStatus() . ' ' . $response->getRawBody());
		}
	}
	private function _pushInRedis($fileId){
		$this->_redis -> rpush('video_list',$fileId);
	}
	private function _pullFromRedis(){
		$fileId = $this->_redis -> lpop('video_list');
		return $fileId;
	}
	public function downloadVideo(){
		$temp_fileId = '';
		while(true){
			$temp_fileId = $this->_pullFromRedis();
			if ($temp_fileId != '') {
				echo $temp_fileId."\n";
				sleep(1);
				$this->_downloadVideo($temp_fileId);
			}else{
				echo "no such video";
				break;
			}
		}
	}
}
