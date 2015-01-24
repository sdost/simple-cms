<?php
class User 
{
    //-------- Constructor Method (overloaded virtually)
    function __construct($args) {
		$db = new MySQL;
		$db->table = 'dw_users';
		if ($args['passWord'] != null ) {
	    	// authenticate
		// echo $args['userName'].' -> '.$args['passWord'];
	    	$db->user_name = $args['userName'];
	    	$db->pass_word = $args['passWord'];
	    	if ($result = $db->load()) {
				foreach ($this->elem as $key => $value) {
					$this->$key = $result[0][$key];
				}
			}
	    	if ($this->id == null)
				throw new PropertyException('Login failed.');
		} else if ($args['userId'] != null ) {
	    	// retrieve by uid
	    	$db->id = $args['userId'];
			$db->active = '1';
		} else if ($args['userName'] != null) {
	    	// retrieve by user name
	    	$db->user_name = $args['userName'];
			$db->active = '1';
		} else {
	    	return;
		}
	
		if ($result = $db->load()) {
	    	foreach ($this->elem as $key => $value) {
				$this->$key = $result[0][$key];
			}
		}
    }
  
    //-------- Accessor Methods  
    function __set($name, $value) {	// set property by name to value
		// is property in associative array?
		if (!isset($this->elem[$name])) 
			throw new PropertyException($name.' is an invalid property for this object');
		// yes, set value
		$this->elem[$name] = $value;
    }
  
    function __get($name) {	// get property by name
		// is property in associative array?
		if(!isset($this->elem[$name])) 
			throw new PropertyException($name.' is an invalid property for this object');
		// yes, get value
		$r = $this->elem[$name];
		if ($r == '' | $r == -1) {
		    // the property has not been set
	    	return false;
		} else { 
	    	return $r;  //return requested property
		}
    }
  
    //-------- Other Methods
    function save() { // save user info in the database
		$db = new MySQL;
		$db->table = 'dw_users';
		foreach ($this->elem as $key => $value ) {
			$db->$key = $value;
		}
		$db->saveWithDates();
		return true;
    }
	
	function disable() {
		$db = new MySQL;
		$db->table = 'dw_users';
		$db->id = $this->id;
		$db->disable();
		return true;
	}
	
	function getCreationDate() {
		$db = new MySQL;
		$db->table = 'dw_users';
		$db->id = $this->id;
		if( $result = $db->getCreationDate() ) {
			$r = $result[0]['CreationDate'];
		}
		return $r;
	}
	
	function getLastUpdated() {
		$db = new MySQL;
		$db->table = 'dw_users';
		$db->id = $this->id;
		if( $result = $db->getLastUpdated() ) {
			$r = $result[0]['LastUpdated'];
		}
		return $r;
	}
	
    //-------- Class Variables
    private $elem = array (
		'id' => -1,
		'user_name' => '',
		'pass_word' => ''
	);
}
?>
