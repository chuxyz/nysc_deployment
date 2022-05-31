<?php
session_start();
require_once('../includes/config.php');
if(isset($_COOKIE['user'])||isset($_COOKIE['pwd'])){
	header('Location:admincp.php');
	exit;
}
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(empty($username)||empty($password)){
		$_SESSION['error'] = 'Username and Password field must be filled!';
		header('Location:index.php');
		exit;
	}
	$checkAdmin = mysql_query("SELECT * FROM admin WHERE username = '$username' AND password = '".md5($password)."'");
	if(mysql_num_rows($checkAdmin) <= 0){
		$_SESSION['error'] = 'Invalid Username or Password!';
		header('Location:index.php');
		exit;
	}
	else{
		$pwd = md5($password);
		setcookie('user',$username,time()+30*60,'/');
		setcookie('pwd',$pwd,time()+30*60,'/');
		header('Location:admincp.php');
		exit;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords($siteName).' | Call-Up Letter'; ?></title>
<link href="../styles/styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="../styles/cssmenu.css" rel="stylesheet" type="text/css" media="all" />
<link href="../styles/admin.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../jScripts/jq.js"></script>
<script type="text/javascript" src="../jScripts/jqscript.js"></script>
</head>

<body>
<div id="container">
  <div id="header"><div id="head-img"></div></div>
  <div id='cssmenu'>
<ul>
   <li><a href='index.php'><span>HOME</span></a></li>
   <li class='has-sub '><a href='#'><span>CHECK CALLUP</span></a>
      <ul>
         <li class='has-sub '><a href='../callupnumber.php'><span>CALLUP NUMBER</span></a>
         </li>
         <li class='has-sub '><a href='../callupletter.php'><span>CALLUP LETTER</span></a>
         </li>
      </ul>
   </li>
   <li><a href='about.php'><span>ABOUT</span></a></li>
   <li><a href='contact.php'><span>CONTACT</span></a></li>
</ul>
</div> <!--CSS MENU -->
<?php
if (isset($_SESSION['error'])){
echo '<div class="error">'.$_SESSION['error'].'</div>';
unset($_SESSION['error']);
}
?>
  <div id="dialog-container">
  <div id="dialog-box">
  <div class="login"><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table width="98%" border="0">
      <tr>
        <td><label>Username:</label></td>
        <td><input type="text" name="username" id="username" /></td>
      </tr>
      <tr>
        <td><label>Password:</label></td>
        <td><input type="password" name="password" id="password" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="login" type="submit" class="button" id="login2" value="Login" /></td>
      </tr>
    </table>
  </form>
  </div>
  </div>
  </div>
</div>
<div id="footer"><?php echo ucwords($siteName).". &copy; Copyright ".date('Y');?></div>
</body>
</html>