<?php
//讀取設定檔
class Config{
        private $_Replytime;
        private $_Config_string,$_Channel_ID,$_Channel_Secret,$_Channel_Token;
        private $_Redis_Sever,$_Redis_Port,$Redis_Timeout;
        private $_Elk_Server,$_Elk_Port,$_Elk_Index,$_Elk_Type;
	private $_SQS_QueueUrl;
        private $_Config_path = __DIR__."/../conf/config.json";
        function __construct(){
                $this->_Config_string = json_decode(file_get_contents($this->_Config_path,FILE_USE_INCLUDE_PATH),true);
                $this->_Replytime = $this->_Config_string["system"]["Replytime"];
                $this->_Channel_ID = $this->_Config_string["line_bot_conf"]["Channel_ID"];
                $this->_Channel_Secret = $this->_Config_string["line_bot_conf"]["Channel_Secret"];
                $this->_Channel_Token = $this->_Config_string["line_bot_conf"]["Channel_Token"];
                $this->_Redis_Server = $this->_Config_string["redis"]["Server"];
                $this->_Redis_Port = $this->_Config_string["redis"]["Port"];
                $this->_Redis_Timeout = $this->_Config_string["redis"]["Timeout"];
                $this->_Elk_Server = $this->_Config_string["elasticsearch"]["Server"];
                $this->_Elk_Port = $this->_Config_string["elasticsearch"]["Port"];
                $this->_Elk_Index = $this->_Config_string["elasticsearch"]["Index"];
                $this->_Elk_Type = $this->_Config_string["elasticsearch"]["Type"];
		$this->_SQS_QueueUrl = $this->_Config_string["aws_sqs"]["QueueUrl"];
        }
        //system setting
        function Replytime($Replytime=null){
                $this->_Replytime = isset($Replytime) ? $Replytime : $this->_Replytime;
                return $this->_Replytime;
        }
        //line bot setting
        function Channel_ID($channel_ID=null){
                $this->_Channel_ID = isset($channel_ID) ? $channel_ID : $this->_Channel_ID;
                return $this->_Channel_ID;
        }
        function Channel_Secret($channel_Secret=null){
                $this->_Channel_Secret = isset($channel_Secret) ? $channel_Secret : $this->_Channel_Secret;
                return $this->_Channel_ID;
        }
        function Channel_Token($channel_Token=null){
                $this->_Channel_Token = isset($channel_Token) ? $channel_Token : $this->_Channel_Token;
                return $this->_Channel_Token;
        }
        //redis setting
        function Redis_Server($redis_Server=null){
                $this->_Redis_Server = isset($redis_Server) ? $redis_Server : $this->_Redis_Server;
                return $this->_Redis_Server;
        }
        function Redis_Port($redis_Port=null){
                $this->_Redis_Port = isset($redis_Port) ? $redis_Port : $this->_Redis_Port;
                return $this->_Redis_Port;
        }
        function Redis_Timeout($redis_Timeout=null){
                $this->_Redis_Timeout = isset($redis_Timeout) ? $redis_Timeout : $this->_Redis_Timeout;
                return $this->_Redis_Timeout;
        }
        //elastic search
        function Elk_Server($elk_Server=null){
                $this->_Elk_Server = isset($elk_Server) ? $elk_Server : $this->_Elk_Server;
                return $this->_Elk_Server;
        }
        function Elk_Port($elk_Port=null){
                $this->_Elk_Port = isset($elk_Port) ? $elk_Port : $this->_Elk_Port;
                return $this->_Elk_Port;
        }
        function Elk_Index($elk_Index=null){
                $this->_Elk_Index = isset($elk_Index) ? $elk_Index : $this->_Elk_Index;
                return $this->_Elk_Index;
        }
        function Elk_Type($elk_Type=null){
                $this->_Elk_Type = isset($elk_Type) ? $elk_Type : $this->_Elk_Type;
                return $this->_Elk_Type;
        }
	//aws sqs
	function SQS_QueueUrl($sqs_QueueUrl=null){
		$this->_SQS_QueueUrl = isset($sqs_QueueUrl) ? $sqs_QueueUrl : $this->_SQS_QueueUrl;
		return $this->_SQS_QueueUrl;
	}

}



?>
