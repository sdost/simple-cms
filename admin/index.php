<?php
header('Content-type: text/html');
require('../functions/browser_detect.php');
require('../functions/strFunctions.php');
require('../lib/MySQL.class.php');
require('../lib/Page.class.php');
require('../lib/exceptions/MySQLException.class.php');
require('../lib/exceptions/PropertyException.class.php');

error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_name("admin_session");
session_start();
$userId = $_SESSION['USER_INFO']['ID'];

if( $userId == null ) {
	header('Location: login.php');
}

$pageId = $_REQUEST['pgId'];

$page = null;
try {
	if( $pageId == null ) {
		$page = new Page( array() );
	} else {
		$page = new Page( array('pageId'=>$pageId) );
	}
} catch( PropertyException $pe ) {
	echo "ERROR: ".$pe->getMessage();
} catch( MySQLException $mse ) {
	echo "ERROR: ".$mse->getMessage();
}
?>
<html>
<head>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript;e4x=1">

commObject = function()
{
  this.OnSuccess = function()
  {
  	var response = this.GetResponseText(); // bug 270553
	response = response.replace('<?php echo('<?xml version="1.0" encoding="utf-8"?>'); ?>', ''); // bug 336551
	var e4x = new XML(response);
	updateForm(e4x);
  }

  this.GetData = function(id)
  {
	 this.InitializeRequest('GET', 'getPageInfo.php?pgID='+id );
	 this.Commit(null);
  }
}
commObject.prototype = new ajax();

var listObject;
var oFCKeditor;

window.onload = function()
{
	oFCKeditor = new FCKeditor( 'pgContent', '640', '480', 'Simplified' );
	oFCKeditor.BasePath	= '/admin/fckeditor/';
	oFCKeditor.ReplaceTextarea();
	listObject = new commObject();
}
function updateForm(data) {
	var form = document.getElementById('editForm');
	
	form.pgId.value = data.@id;
	form.pgName.value = data.@name;
	document.getElementById('banner_file').innerHTML = "Current: <span style=\"color: #000099;\">"+data.banner.text()+"</span>";
	document.getElementById('up_file').innerHTML = "Current: <span style=\"color: #000099;\">"+data.icon_up.text()+"</span>";
	document.getElementById('over_file').innerHTML = "Current: <span style=\"color: #000099;\">"+data.icon_over.text()+"</span>";
	document.getElementById('down_file').innerHTML = "Current: <span style=\"color: #000099;\">"+data.icon_down.text()+"</span>";
	form.pgFrontFlag.checked = data.@front == 'Y' ? true : false;
	form.pgFrontPos.value = data.@front_order;
	try {
		var editor = FCKeditorAPI.GetInstance('pgContent');
		editor.SetHTML( data.content.text() ); 
	} catch(e) {
		editor.SetHTML('');
	}
}
</script>
</head>
<body>
<link rel="stylesheet" type="text/css" href="css/admin.css" />
<form id="editForm" method="post" enctype="multipart/form-data" action="submitPage.php">
	<fieldset>
        <legend>Page Editor</legend>
        <div class="fields">
        	<label for="pgSelect">Select Page:</label>
            <select id="pgSelect" name="pgSelect" onChange="listObject.GetData(this.value)">
            	<option value='-1'>New Page</option>
				<?php 
					$pages = Page::getAllPages();
					foreach($pages as $pg) {
						if( $pg['id'] == $page->id ) {
							echo '<option value=\''.$pg['id'].'\' selected>'.$pg['page_name'].'</option>';
						} else {
							echo '<option value=\''.$pg['id'].'\'>'.$pg['page_name'].'</option>';
						}
					}
				?>
            </select><br /><br />
            <label for="pgName">Page Name:</label><input  type="text" name="pgName" id="pgName" value="<?php echo $page->page_name; ?>" /><br /><br />
            
            <label for="pgBanner">Banner:</label><input type="file" name="pgBanner" id="pgBanner" /><br />
            <div id="banner_file" class="notice">Current: <?php echo $page->page_banner; ?></div><br />
            
            <label for="pgIcon">Icon (Up):</label><input type="file" name="pgIconUp" id="pgIconUp" /><br />
            <div id="up_file" class="notice">Current: <?php echo $page->page_icon_up; ?></div><br />
            <label for="pgIcon">Icon (Over):</label><input type="file" name="pgIconOver" id="pgIconOver" /><br />
            <div id="over_file" class="notice">Current: <?php echo $page->page_icon_over; ?></div><br />
            <label for="pgIcon">Icon (Down):</label><input type="file" name="pgIconDown" id="pgIconDown" /><br />
            <div id="down_file" class="notice">Current: <?php echo $page->page_icon_down; ?></div><br />
            
            <label for="pgFrontFlag">Front Page?</label>
            <input type="checkbox" name="pgFrontFlag" id="pgFrontFlag" value="front" <?php if( $page->front_page_flag == 'Y' ) echo "checked"; ?>/>
			<label for="pgFrontPos">Front Page Position:</label>
            <select id="pgFrontPos" name="pgFrontPos">
            	<?php
					$pages = Page::getFrontPages();
					$pageCnt = count($pages);
					for( $i = 1; $i <= $pageCnt; $i++ ) {
						if( $page->front_page_order == $i ) {
							echo '<option value=\''.$i.'\' selected>'.$i.'</option>';
						} else {
							echo '<option value=\''.$i.'\'>'.$i.'</option>';
						}
					}
				?>
            </select>
        </div>
            
        <div class="content"><textarea name="pgContent" id="pgContent"><?php echo $page->page_info; ?></textarea></div>
    
        <span class="submit"><input class="editSubmit" type="submit" value="Save" /></span>
    </fieldset>
    <input type="hidden" id="pgId" name="pgId" value="<?php echo $page->id; ?>" />
</form>
</div>
</body>
</html>