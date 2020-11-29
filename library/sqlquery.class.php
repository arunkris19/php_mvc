<?php
/*! 
Sqli Query class v3.2.1 
Created on 09-10-2018
Author: Anurag.R 
*/
class SQLQuery {
    protected $_dbHandle;
    protected $_result;
	protected $_mysqli_insert_id;
    /** Connects to database **/
    function connect($address,$account,$pwd,$name) 
    {
        
        //mysqli connect 09-10-2018
        $this->_dbHandle  = mysqli_connect($address,$account,$pwd,$name);
        if($this->_dbHandle )
        {
				mysqli_query($this->_dbHandle ,"SET time_zone = '{DEFAULT_TZ}'");
				mysqli_query($this->_dbHandle,'SET SESSION MAX_EXECUTION_TIME=15000;');
				return $this->_dbHandle;
        }
        else
        {	
           echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
           return 0;
           exit;
        }
    }
    /** Disconnects from database mysqli*/
    function disconnect() 
    {
         if(!($this->_dbHandle->close()))
	   		return 0;
		else
			return 1;
    }
    
    function selectAll() {
    	$query = 'select * from `'.$this->_table.'`';
    	return $this->query($query);
    }
    
    function select($id) {
    	$query = 'select * from `'.$this->_table.'` where `id` = \''.mysql_real_escape_string($id).'\'';
    	return $this->query($query, 1);    
    }
    /** Custom SQLi Query **/
	//function query($query)
	function query($query,$nodie='')
    {
       // $this->_result = mysqli_query( $this->_dbHandle,$query) or die('Query Failed'.mysqli_error());
	   
	    if($nodie != '')
		{ $this->_result = mysqli_query( $this->_dbHandle,$query); }
		else
		{ $this->_result = mysqli_query( $this->_dbHandle,$query) or die('Query Failed'.mysqli_error()); }
	   
	   
        $this->_mysqli_insert_id = mysqli_insert_id($this->_dbHandle);
        if (preg_match("/select/i",$query)) 
        {
        $result = array();
        $table = array();
        $field = array();
        while ($row = mysqli_fetch_assoc($this->_result)) {
        if($singleResult == 1) {
        mysqli_free_result($this->_result);
        return $row;
        }
        array_push($result,$row);
        }
        mysqli_free_result($this->_result);
        return($result);
        }
        return (bool)$this->_result;
	}
	/** Get Mysql insert id*/
	function getLastInsertId()
    {
		return mysqli_insert_id($this->_dbHandle);
	}
    /** Get number of rows **/
    function getNumRows() 
    {
        return mysqli_num_rows($this->_result);
    }
    /** Free resources allocated by a query **/
    function freeResult() 
    {
        mysqli_free_result($this->_result);
    }
    /** Get error string **/
    function getError() 
    {
        return mysqli_error($this->_dbHandle);
    }
}
