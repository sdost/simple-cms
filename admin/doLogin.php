<?php
header('Content-type: text/html');
require('../functions/browser_detect.php');
require('../functions/strFunctions.php');
require('../lib/MySQL.class.php');
require('../lib/User.class.php');
require('../lib/exceptions/MySQLException.class.php');
require('../lib/exceptions/PropertyException.class.php');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_name("admin_session");
session_start();

$username = $_REQUEST['login'];
$password = $_REQUEST['password'];

$user = null;
try {
	$user = new User(array('userName'=>$username, 'passWord'=>$password));
} catch( PropertyException $pe ) {
	echo "ERROR: ".$pe->getMessage();
} catch( MySQLException $mse ) {
	echo "ERROR: ".$mse->getMessage();
}

if( $user == null ) {
	header('Location: login.php');
} else {
	$_SESSION['USER_INFO']['ID'] = $user->id;
	header('Location: index.php');
}
?>
