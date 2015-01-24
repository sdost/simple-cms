<?php
class Page 
{
    //-------- Constructor Method (overloaded virtually)
    function __construct($args) {
		$db = new MySQL;
		$db->table = 'page_table'; 
		if ($args['pageId'] != null ) {
	    	// retrieve by uid
	    	$db->id = $args['pageId'];
			$db->active = '1';
		} else if ($args['pagePos'] != null ) {
			$db->front_page_order = $args['pagePos'];
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
		$db->table = 'page_table';
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
		$db->table = 'page_table';
		$db->id = $this->id;
		$db->disable();
		return true;
	}
	
	function getPageLinks() {
		$r = array();
		$db = new MySQL;
		$db->table = "links_table";
		$db->id = $this->id;
		if( $result = $db->load() ) {
			foreach( $result as $value ) {
				$r[] = $value['dest_id'];
			}
		}
		return $r;
	}
	
	function getCreationDate() {
		$db = new MySQL;
		$db->table = 'page_table';
		$db->id = $this->id;
		if( $result = $db->getCreationDate() ) {
			$r = $result[0]['creation_date'];
		}
		return $r;
	}
	
	function getLastUpdated() {
		$db = new MySQL;
		$db->table = 'page_table';
		$db->id = $this->id;
		if( $result = $db->getLastUpdated() ) {
			$r = $result[0]['last_updated'];
		}
		return $r;
	}
	
	static function getFrontPages() {
		$db = new MySQL;
		$db->table = 'page_table';
		$db->front_page_flag = 'Y';
		if( $result = $db->loadAndOrder('front_page_order') ) {
			$r = $result;
		}
		return $r;
	}
	
	static function getAllPages() {
		$db = new MySQL;
		$db->table = 'page_table';
		if( $result = $db->loadAll() ) {
			$r = $result;
		}
		return $r;
	}
	
    //-------- Class Variables
    private $elem = array (
		'id' => -1,
		'page_name' => '',
		'page_banner' => '',
		'page_icon_up' => '',
		'page_icon_over' => '',
		'page_icon_down' => '',
		'page_info' => '',
		'front_page_flag' => '',
		'front_page_order' => ''
	);
}
?>