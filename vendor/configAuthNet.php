<?php

class configAuthNet {
	//2779RutZpQF
       //594X2d5Ez3qL6TgC
    //Simon
	private $dev = array('login'=>'2779RutZpQF',
		'transkey'=>'594X2d5Ez3qL6TgC',
		'sandbox'=>true);
	
	function __construct() {
		
		$cfg = $this->dev;
		
		// AuthNet API Credentials
		define("AUTHORIZENET_API_LOGIN_ID", $cfg['login']);
		define("AUTHORIZENET_TRANSACTION_KEY", $cfg['transkey']);
		define("AUTHORIZENET_SANDBOX", $cfg['sandbox']);    
	}	
}