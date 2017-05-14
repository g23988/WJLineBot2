<?php
//存取sqs
class Sqs{
	private $_client;
	private $_config;
        function __construct(Config $config){
		$this->_config = $config;
		$this->_client = new \Aws\Sqs\SqsClient([
	                'version' => 'latest',
                	'region' => 'us-west-2'
        	]);
	}
	public function sendCommonMessage($json){
		$result = $this->_client->sendMessage([
			'MessageBody' => $json, // REQUIRED
			'QueueUrl' => $this->_config->SQS_QueueUrl(), // REQUIRED
			'MessageGroupId' => 'echoBot',
		]);
		return $result;
	}
	
	public function getFIFOMessage(){
		$result = $this->_client->receiveMessage([
			'QueueUrl' => $this->_config->SQS_QueueUrl(), // REQUIRED
			]);
		return $result;
	}
}
