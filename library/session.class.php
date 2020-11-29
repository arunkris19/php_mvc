<?php
class Session{
	static public function set($key,$value){
		@session_start();
		$_SESSION[$key] = $value;
	}

	static public function get($key){
		@session_start();
		return $_SESSION[$key];
	}

	static public function dump($key){
		@session_start();
		unset($_SESSION[$key]);
	}
}

