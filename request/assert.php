<?php
function assertRequest($requestType){
	if(!is_string($requestType)){
		return false;
	}
	if($_SERVER["REQUEST_METHOD"]===$requestType){
		$args=func_get_args();
		for($i=1;$i<count($args);$i++){
			if(!array_key_exists($args[$i],$_REQUEST)){
				return false;
			}
		}
		return true;
	}
	return false;	
}

function assertSession(){
		if(session_status()!=PHP_SESSION_ACTIVE){
			echo "inactive session";
			return false;
		}
		$args=func_get_args();
		$arg=[];
		foreach($args as $arg){
			if(!array_key_exists($arg,$_SESSION)){
				return false;
			}
		}
		return true;
}
?>