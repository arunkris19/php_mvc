<?php

function setReporting() 
{
	if (DEVELOPMENT_ENVIRONMENT == true) 
    {
		error_reporting(E_ERROR);
		ini_set('display_errors',1);
    } 
    else 
    {
		error_reporting(0);
		ini_set('display_errors',1);
	}
}
/** Check for Magic Quotes and remove them **/
function stripSlashesDeep($value) 
{
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}
function removeMagicQuotes() 
{
if ( get_magic_quotes_gpc() ) {
	$_GET    = stripSlashesDeep($_GET   );
	$_POST   = stripSlashesDeep($_POST  );
	$_COOKIE = stripSlashesDeep($_COOKIE);
}
}
/** Check register globals and remove them **/
function unregisterGlobals() 
{
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
		if(array_key_exists($value,$GLOBALS))
		{
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
		}
        }
    }
}
/** Main Call Function **/
function callHook() 
{
	$path = $_SERVER['REQUEST_URI'];
	//if no path is set get default controller
	$url = ($path == '' or $path == '/') ? DEFAULT_CONTROLLER : $path;
	//process path components
	$urlArray = array();
	$urlArray = explode("/",$url);
	//get rid of initial '/'
	array_shift($urlArray);
    
	$urlArray = count($urlArray) == 0 ? array($url) : $urlArray;
	$controller = $urlArray[0];
	array_shift($urlArray);
	$action = $urlArray[0];
	array_shift($urlArray);
	$queryString = $urlArray;
	$controllerName = $controller;
	
	if(strpos($controller,"_") === FALSE)
    {   
        if(preg_match('/[A-Z]/', $controller)) 
        {
            $tcontroller= strtolower($controller);
            $url = str_replace($controller,$tcontroller,$_SERVER['REQUEST_URI']);
            header("HTTP/1.1 301 Moved Permanently");
            header("Location:$url");
            die();            
        }  
        else
        {
            $controller = ucwords(str_replace('-','_',$controller));
        }  
	}
	else
    {
		$tcontroller = strtolower(str_replace('_','-',$controller));
		$url = str_replace($controller,$tcontroller,$_SERVER['REQUEST_URI']);
		header("HTTP/1.1 301 Moved Permanently");
		header("Location:$url");
		die();
	}
	
	$model = $controller.'Model';
	$controller = $controller.'Controller';

	if(!class_exists($controller))
    {
		$messageComponent = $controller;
		header("HTTP/1.0 404 Not Found");
		include(ROOT . DS . '404.html');  // provide your own HTML for the error page
		die();
	}
	
    $action = empty($action) ? DEFAULT_VIEW : $action; 
    if(strpos($action,'_')!==false)
    {
        /*mvc will not permit urls having _ */
        header("HTTP/1.0 404 Not Found");
		include(ROOT . DS . '404.html'); // provide your own HTML for the error page
		die();
    }
    $action = str_replace('-','_',$action);    

	$dispatch = new $controller($model,$controllerName,$action); 
    if ((int)method_exists($controller, $action)) {	   
		call_user_func_array(array($dispatch,$action),$queryString);
	} 
    else {
		/* Error Generation Code Here */ 
		$messageComponent = $controller.'.'.$action;
		header("HTTP/1.0 404 Not Found");
		include(ROOT . DS . '404.html'); // provide your own HTML for the error page
		die();
	}

}
/** Autoload any classes that are required **/
function __autoload($className) 
{

	if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) 
    {
        require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
	} 
    else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) 
    {
    	require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
	} 
    else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) 
    {
        require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
	} 
    else if (file_exists(ROOT . DS . 'application' . DS . 'helpers' . DS . strtolower($className) . '.php')) 
    {	
        require_once(ROOT . DS . 'application' . DS . 'helpers' . DS . strtolower($className) . '.php');
	} 
    else  
    {
		/* Error Generation Code Here */
		if(DEVELOPMENT_ENVIRONMENT === true){
			echo '<hr/>';
			echo "<code><big><b>Debug Info</b>:Class component 
					<b style='color:#cc3b3b'>{$className}</b> not found!</big></code>";
			echo '<hr/>';
		}
	}
}
setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();

