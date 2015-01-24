<?php
header('Content-type: text/xml');
require("../lib/XMLGenerator.class.php");
require('../lib/MySQL.class.php');
require('../lib/Page.class.php');
require('../lib/exceptions/MySQLException.class.php');
require('../lib/exceptions/PropertyException.class.php');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$xml = new DOMDocument('1.0','utf-8');

$root = $xml->createElement('page_info');
$xml->appendChild($root);

$pageID = $_REQUEST['pgID'];
if($pageID == null) {
	//XMLGenerator::generateContent($xml, $pageRoot, $pageID);
} else {
	XMLGenerator::generateContent($xml, $root, $pageID);
}

echo $xml->saveXML();
?>