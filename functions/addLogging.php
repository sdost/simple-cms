<?php
require("../lib/Logger.class.php");

session_name("dw_session");
session_start();

$systemLog = $_SESSION['DW_LOG'];
	
if( $systemLog == null ) {
	$systemLog = new Logger( array('filePath' => 'logs', 'filePrefix' => 'dw') );
	$_SESSION['DW_LOG'] = $systemLog;
}
?>