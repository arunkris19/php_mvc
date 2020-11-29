<?php
class Model extends SQLQuery {
	protected $_model;

	function __construct() {

		/*$this->connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$this->_model = get_class($this);
		$this->_table = strtolower($this->_model)."s";*/
	}

	function __destruct() {
	}
	
	function getTemplate($templatename){
	//echo getcwd().'/application/models/subtemplates/'.$templatename.'.php';
		if(file_exists('application/models/subtemplates/'.$templatename.'.php')) {
			//return file_get_contents('application/models/subtemplates/'.$templatename.'.php');	
			//echo getcwd().'/application/models/subtemplates/'.$templatename.'.php';
			return getcwd().'/application/models/subtemplates/'.$templatename.'.php'	; 
			}
		else echo 'No File';
	}
	
	 /*?>function getTemplate($templatename){
		echo "Success";
	}<?php */
	
	
} ?>
