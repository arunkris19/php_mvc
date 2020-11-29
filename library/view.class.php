<?php
class View {

	protected $variables = array();
	protected $widgets;
	protected $_controller;
	protected $_view;
	protected $_header;
	protected $_footer;

	function __construct($controller){
		$this->_controller = $controller;
	}
	function load($baseType,$view='index') {
		
		$this->_view = $baseType. DS . $view;	
	}

	/** Set a header template **/
	function setHeader($baseType,$header='header'){
		$this->_header = $baseType. DS . $header;
	}

	/** Set a footer template **/
	function setFooter($baseType,$footer='footer'){
		$this->_footer = $baseType. DS . $footer;
	}

	/** Set Widgets **/
	function addWidget($name, $widget){
		$this->widgets[$name] = $widget;
	}

	/** Set Variables **/
	function set($name,$value) {
		$this->variables[$name] = $value;
	}

	/** Display Template **/

    function render() {
    	
		if(file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_view . '.php')){
			$this->renderView();
		}
		
	}
	
	/** Render widget **/
	function renderWidget($widget) {
		@include(ROOT. DS .'application'. DS .'widgets'. DS .$this->widgets[$widget]. DS .'widget.php');
	}

	function renderView(){
		//extract all the preset variables
		extract($this->variables);
		$widgets = $this->widgets;

		@include_once(ROOT . DS . 'application' . DS . 'views' . DS . $this->_header . '.php');
		@include_once(ROOT . DS . 'application' . DS . 'views' . DS . $this->_view . '.php');
		@include_once(ROOT . DS . 'application' . DS . 'views' . DS . $this->_footer . '.php');
	}

}
