<?php
class MySQLException extends Exception {
	// constructor
    function __construct($message, $code = 0)
    {
        // Logger::logException(&$m);
		parent::__construct($message, $code);

        $this->cleanUp();
    }

    function cleanUp()
    {
        // generic cleanup code here
    }
}
?>