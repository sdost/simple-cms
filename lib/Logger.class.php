<?php
class Logger {
	
	//-------- Constructor Method (overloaded virtually)
	function __construct($args) {
		if( $args['fileName'] != null ) {
			$this->FileName = $args['fileName'];
			$this->FilePath = $args['filePath'];
		} else if( $args['filePath'] != null ) {
			$this->FilePath = $args['filePath'];
			$this->FilePrefix = $args['filePrefix'];
		} else throw new PropertyException("You must provide a filename and path, or path and file prefix to create a Logger object.");
	}

	//-------- Accessor Methods	
	function __set($name, $value) {	// set property by name to value
		if(!isset($this->elem[$name])) 
			throw new PropertyException($name.' is an invalid property for this object.');
		// yes, set value
		$this->elem[$name] = $value;
	}
	
	function __get($name) { // get property by name
		if(!isset($this->elem[$name]))
			throw new PropertyException($name.' is an invalid property for this object.');
		// yes, get value
		$r = $this->elem[$name];
		if( $r == '' | $r == -1 ) {
			// the property has not been set
			return false;
		} else {
			return $r;	//return requested property
		}
	}
	
	//-------- Other Methods
	function debug($str) {
		$this->writeToLog( "[DEBUG] ".$str );
	}
	
	function usage($str) {
		$this->writeToLog( "[USAGE] ".$str );
	}
	
	function process($str) {
		$this->writeToLog( "[PROCESS] ".$str );
	}
	
	function error($str) {
		$this->writeToLog( "[ERROR] ".$str );
	}
	
	function warn($str) {
		$this->writeToLog( "[WARNING] ".$str );
	}
	
	function writeToLog($str) {
		$dateOfEntry = date("[h:iA]");
		$userIp = $_SERVER['REMOTE_ADDR'];
		$hostDomain = gethostbyaddr($userIp);
		$userBrowser = $_SERVER['HTTP_USER_AGENT'];
		if( $this->FileName != null ) {
			$filename = $this->FilePath."/".$this->FileName.".log";
		} else {
			$dateOfLog = date("dmY");
			$filename = $this->FilePath."/".$this->FilePrefix."-".$dateOfLog.".log";
		}
		$logEntry = $dateOfEntry." ADDR => ".$hostDomain."(".$userIp."), CLIENT => ".$userBrowser.", MESSAGE => ".$str."\r\n";
		
		if ( !file_exists($filename) ){
			touch ($filename);
		}
		if (!$handle = fopen($filename, 'a')) {
			echo "Cannot open file ($filename)";
			exit;
		}
		while(!flock($handle, LOCK_EX)) { /* idle */ }
		if (!fwrite($handle, $logEntry)) {
			echo "Cannot write to file ($filename)";
			exit;
		}
		flock($handle, LOCK_UN);
		fclose($handle);
	}

	//-------- Class Variables
	private $elem = array( 
		'FileName'=>'',
		'FilePath'=>'',
		'FilePrefix'=>''
	);
}
?>