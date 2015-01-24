<?php
header('Content-type: text/xml');
require('../functions/strFunctions.php');
require('../lib/MySQL.class.php');
require('../lib/Page.class.php');
require('../lib/exceptions/MySQLException.class.php');
require('../lib/exceptions/PropertyException.class.php');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

//include('addLogging.php');

$pageId = $_REQUEST['pgId'];

$page = null;
try {
	if( $pageId == null ) {
		$page = new Page( array() );
		$page->save();
	} else {
		$page = new Page( array('pageId'=>$pageId) );
	}
} catch( PropertyException $pe ) {
	echo "ERROR: ".$pe->getMessage();
} catch( MySQLException $mse ) {
	echo "ERROR: ".$mse->getMessage();
}

$page->page_name = $_REQUEST['pgName'];
$page->page_info = $_REQUEST['pgContent'];
$page->front_page_flag = isset($_REQUEST['pgFrontFlag']['front']) ? 'Y' : 'N';

if( $page->front_page_flag == 'Y' ) {
	$page->front_page_order = $_REQUEST['pgFrontPos'];
}

$pgId = $page->id;

$bannerPath = "content/banners/".$pgId;
if(is_dir("../".$bannerPath) == false) {
	mkdir("../".$bannerPath, 0777, true);
}

$iconPath = "content/icons/".$pgId;
if(is_dir("../".$iconPath) == false) {
	mkdir("../".$iconPath, 0777, true);
}

if( $_FILES['pgBanner']['name'] != '' ) {
	$bannerName = $_FILES['pgBanner']['name'];
	
	if(file_exists("../".$bannerPath."/".$bannerName)) {
		echo("<warning>A file with the name [".$bannerName."] already exists in directory [".$bannerPath."]</warning>");
	} else {
		move_uploaded_file($_FILES['pgBanner']['tmp_name'], "../".$bannerPath."/".$bannerName) or die("Upload failed.");
	}
	$page->page_banner = $bannerPath."/".$bannerName;
}

if( $_FILES['pgIconUp']['name'] != '' ) {
	$iconUpName = $_FILES['pgIconUp']['name'];
	
	if(file_exists("../".$iconPath."/".$iconUpName)) {
		echo("<warning>A file with the name [".$iconUpName."] already exists in directory [".$iconPath."]</warning>");
	} else {
		move_uploaded_file($_FILES['pgIconUp']['tmp_name'], "../".$iconPath."/".$iconUpName) or die("Upload failed.");
	}
	$page->page_icon_up = $iconPath."/".$iconUpName;
}

if( $_FILES['pgIconOver']['name'] != '' ) {
	$iconOverName = $_FILES['pgIconOver']['name'];
	
	if(file_exists("../".$iconPath."/".$iconOverName)) {
		echo("<warning>A file with the name [".$iconOverName."] already exists in directory [".$iconPath."]</warning>");
	} else {
		move_uploaded_file($_FILES['pgIconOver']['tmp_name'], "../".$iconPath."/".$iconOverName) or die("Upload failed.");
	}
	$page->page_icon_over = $iconPath."/".$iconOverName;
}

if( $_FILES['pgIconDown']['name'] != '' )
{
	$iconDownName = $_FILES['pgIconDown']['name'];
	
	if(file_exists("../".$iconPath."/".$iconDownName)) {
		echo("<warning>A file with the name [".$iconDownName."] already exists in directory [".$iconPath."]</warning>");
	} else {
		move_uploaded_file($_FILES['pgIconDown']['tmp_name'], "../".$iconPath."/".$iconDownName) or die("Upload failed.");
	}
	$page->page_icon_down = $iconPath."/".$iconDownName;
}

if( $page->save() )
{
	if( $page->front_page_flag == 'Y' ) {
		$frontPages = Page::getFrontPages();
		foreach( $frontPages as $frntPg ) {
			if( $frntPg->id == $page->id ) continue;
			
			if( $frntPg->front_page_order >= $page->front_page_order ) {
				$frntPg->front_page_order++;
				$frntPg->save();
			}
		}
	}

	header("Location: index.php?pgId=".$page->id);
}
else
{
	echo "<status>FAIL</status>";
}
?>