<?php
header('Content-type: text/html');
require('../functions/browser_detect.php');
require('../functions/strFunctions.php');
require('../lib/MySQL.class.php');
require('../lib/Page.class.php');
require('../lib/exceptions/MySQLException.class.php');
require('../lib/exceptions/PropertyException.class.php');
?>
<html>
<head>
</head>
<body>
<link rel="stylesheet" type="text/css" href="css/admin.css" />
<form id="loginForm" method="post" enctype="multipart/form-data" action="doLogin.php">
	<fieldset>
        <legend>Admin Login</legend>
        <div class="fields">
            <label for="login">Username: </label><input  type="text" name="login" id="login" /><br />
            <label for="password">Password: </label><input type="password" name="password" id="password" /><br />
        </div>
        
        <span class="submit"><input class="loginSubmit" type="submit" value="Login" /></span>
    </fieldset>
</form>
</div>
</body>
</html>