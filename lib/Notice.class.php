<?php
class Notice
{
    //-------- Constructor Method (overloaded virtually)
    function __construct($args) {
		$db = new MySQL;
		$db->table = 'dw_notices';
		if ($args['noticeId'] != null ) {
	    	// retrieve by uid
	    	$db->id = $args['noticeId'];
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
    function save() { // save page info in the database
		$db = new MySQL;
		$db->table = 'dw_notices';
		foreach ($this->elem as $key => $value ) {
			$db->$key = $value;
		}
		
		$db->saveWithDates();
		
		if( !$this->id ) {
			$this->id = $db->getLastInsertId();
		}
		
		return true;
    }
	
	function disable() {
		$db = new MySQL;
		$db->table = 'dw_notices';
		$db->id = $this->id;
		$db->disable();
		return true;
	}
	
	function getCreationDate() {
		$db = new MySQL;
		$db->table = 'dw_notices';
		$db->id = $this->id;
		if( $result = $db->getCreationDate() ) {
			$r = $result[0]['creation_date'];
		}
		return $r;
	}
	
	function getLastUpdated() {
		$db = new MySQL;
		$db->table = 'dw_notices';
		$db->id = $this->id;
		if( $result = $db->getLastUpdated() ) {
			$r = $result[0]['last_updated'];
		}
		return $r;
	}
	
	static function getAllNotices() {
		$db = new MySQL;
		$db->table = 'dw_notices';
		if( $result = $db->loadAll() ) {
			$r = $result;
		}
		return $r;
	}
	
    //-------- Class Variables
    private $elem = array (
		'id' => -1,
		'headline' => '',
		'long_text' => ''
	);
}
?>