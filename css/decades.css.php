<?php

header('Content-type: text/css');
require('../functions/strFunctions.php');
require('../functions/browser_detect.php');
require('../lib/MySQL.class.php');
require('../lib/Page.class.php');
require('../lib/exceptions/MySQLException.class.php');
require('../lib/exceptions/PropertyException.class.php');

session_name("decades_session");
session_start();

$pageID = $_SESSION['PAGE_INFO']['ID'];


$ie = browser_detection('browser') == 'ie' ? true : false;
$top_offset = 0;
$left_offset = 18;

if( $ie ) {
	$top_offset = -7;
	$left_offset = -2;
}

$menuList = Page::getFrontPages();
?>

body {

	<?php if( isset($pageID) ) { ?>background: url(../content/image/decadesheader1.jpg) no-repeat top left;<? } else { ?>background: url(../content/image/decadesheader2.jpg) no-repeat top left;<? } ?>
	<a href="http://www.smerc.com/">
}

div#header {

	line-height: 0px;

	<?php if( isset($pageID) ) { ?>height: <? echo(170+$top_offset); ?>px;<? } else { ?>height: <? echo(185+$top_offset); ?>px;<? } ?>

     <a href="http://www.smerc.com/">    

    width: 100%;
    margin: 0px;
    padding: 0px;
    font-size: 0px;
}

div#main_body {

	width: 100%;
	
    min-height: <?php echo count($menuList)*45+24+100; ?>px;
    padding: 0px;
    margin-top: 0px;
    margin-left: auto;
    margin-right: auto;
}

div#footer {

	width: 100%;
	margin-top: 50px;
	height: 60px;
	background: url(../content/image/bottomgraphic.png) repeat-x;
}

.menu {

	margin-top: 0px;
    padding: 0px;
    margin-left: 45px;
    float: left;
    width: 188px;
    height: 100%;
}

.menu_block {

	margin: 0px;
	padding: 5px;
    border-collapse: collapse;
    border-left: 1px solid #999999;
    border-right: 1px solid #999999;
    border-bottom: 1px solid #999999;
}

.menu_header {

	background: url(../content/image/categoriesbox_title.png) no-repeat top left;
	height: 24px;
    width: 188px;
    border-collapse: collapse;
    border-left: 1px solid #999999;
}

.menu_item img {

	border: none;
	vertical-align: middle;
}

.menu_item a img {

	height: 45px;
    width: 175px;
    border-width: 0;
}

<?php

	foreach($menuList as $item)

	{

?>

.menu_item a#<?php echo "id_".$item['id']; ?> {

	background: url(../<?php echo $item['page_icon_over']?>) no-repeat -9999px -9999px;
	background: url(../<?php echo $item['page_icon_down']?>) no-repeat -9999px -9999px;
}

<?php if($item['id'] == $pageID) { ?>

.menu_item a#<?php echo "id_".$item['id']; ?> img {

	background: url(../<?php echo $item['page_icon_down']?>) no-repeat 0px;

}

<?php } else { ?>

.menu_item a#<?php echo "id_".$item['id']; ?> img {

	background: url(../<?php echo $item['page_icon_up']?>) no-repeat 0px;

}

<?php } ?>

.menu_item a#<?php echo "id_".$item['id']; ?>:hover img {

	background: url(../<?php echo $item['page_icon_over']?>) no-repeat -6px;

}

<?php

	}

?>

.about_header {

	background: url(../content/image/aboutdecades_title.png) no-repeat top left;
    margin-top: 20px;
	height: 24px;
    width: 188px;
    border-collapse: collapse;
    border-left: 1px solid #999999;
}

.about_block {

	font-family: Gill Sans, Tahoma, sans-serif;
    font-size: 12px;
    margin: 0px;
	padding: 5px;
    border-collapse: collapse;
    border-left: 1px solid #999999;
    border-right: 1px solid #999999;
    border-bottom: 1px solid #999999;

}

.content {

	margin-top: 0px;
    padding: 0px;
	width: 480px;
    <?php if( isset($pageID) ) { ?>margin-left: 250px; <?php } else { ?> margin-left: 215px; <?php } ?>
}

.content_header {

	margin: 0px;
    padding: 0px;
	width: 100%;
    border-collapse: collapse;

}

.content_header img {

	border: none;
    vertical-align: bottom;

}

.content_block {

	font-family: Gill Sans, Tahoma, sans-serif;
    font-size: 12px;
	margin: 0px;
	width: 100%;
    border: 1px solid #999999;
    border-collapse: collapse;
    padding-left: 10px;
    padding-right: 10px;

}



.breadcrumb {

	font-family: Gill Sans, Tahoma, sans-serif;

    font-size: 12px;

}

.breadcrumb a {

	color: #FF0000;

    text-decoration: none;

}

div#top {

	width: 100%;
    height: 23px;
    margin-left: auto;
    margin-right: auto;
    text-align: right;
    vertical-align: middle;

}

div#top a {

	font-family: Gill Sans, Tahoma, sans-serif;
	font-size: 14px;
    text-decoration: none;
	color: #FFFFFF;
    padding-right: 165px;
    vertical-align: middle;

}

div#top a img {

	border: none;
    vertical-align: middle;

}

div#crumb {

	padding-top: 7px;
	width: 100%;
	height: 37px;
    text-align: center;
    vertical-align: middle;

}

#notices_container {

	width: 99%;
    margin: 0 auto;
    padding: 1em 0;
    font-family: Gill Sans, Tahoma, sans-serif;
    font-size: 12px;
    text-align: center;

}

ul#notices_list {

	width: 100%;
    text-align: left;
	list-style: none;
	padding: 0;
	margin: 0 auto;

}

ul#notices_list li {

    display: block;
	margin: 0;
	padding: 0;
}

ul#notices_list li table {

	height: 70px;
    border-top: 2px dotted #640002;
    padding: 0px;
    margin: 0px;
    border-collapse: collapse;
    vertical-align: middle;
}

.left_bar {

	width: 5px;
    background: #640002;

}

.notice_entry {

	vertical-align: middle;
	white-space: nowrap;
    padding-left: 10px;
	text-align: left;
}

.notice_entry a {

	color: #640002;
    font-size: 14px;
    text-decoration: none;

}

.notice_entry a img {

	vertical-align: middle;
	padding-right: 5px;
    cursor: pointer;
    border: none;

}

.separator {

	width: 100%;

}

.entry_date {

	font-family: Gill Sans, Tahoma, sans-serif;
	vertical-align: middle;
	white-space: nowrap;
	color: #999999;

}

ul#news_list {

	width: 100%;
    text-align: left;
	list-style: none;
	padding: 0;
	margin: 0 auto;

}

ul#news_list li {

    display: block;
	margin: 0;
	padding: 0;

}

ul#news_list li table {

	height: 85px;
    padding: 0px;
    margin: 0px;
    border-collapse: collapse;

}

.news_icon {

	text-align: left;

}

.news_entry {

	width: 100%;
	vertical-align: top;

}

.headline {

	margin-top: 10px;
	color: #990000;
    font-size: 16px;

}

.full_button {

	white-space: nowrap;
    vertical-align: bottom;

}

.full_button img {

	vertical-align: middle;
    border: none;
    margin-right: 2px;	

}

.full_button a {

	color: #990000;
    text-decoration: none;

}

#columns {

	width: 771px;
    text-align: center;
}

#columns table {

	width: 100%;
    margin: 0px;
    margin-top: 506px;
    margin-left: <? echo 15+$left_offset; ?>px;
    padding: 0px;
    font-family: Gill Sans, Tahoma, sans-serif;
    font-size: 12px;
}

#columns table td {

    padding: 5px;
}

#column_left {

	width: 245px;
	border-left: 2px solid #999999;
    border-right: 2px solid #999999;
    border-bottom: 2px solid #999999;
}

#column_middle {

	width: 245px;
	border-left: 2px solid #999999;
    border-right: 2px solid #999999;
    border-bottom: 2px solid #999999;
}

#column_right {

	width: 245px;
	border-left: 2px solid #999999;
    border-right: 2px solid #7B3034;
    border-bottom: 2px solid #999999;
}

.desc {

	padding-left:5px;
	padding-right:5px;
	text-align: left;
    height: 300px;
    background-color: #CCCCCC;
}

.video {

	width: 232px;
    height: 174px;
    padding-top: 5px;
    background-color: #CCCCCC;
}