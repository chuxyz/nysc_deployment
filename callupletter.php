<?php
session_start();
require_once('includes/config.php');
if(isset($_POST['check'])){
	$callup_id = $_POST['callupid'];
	if(empty($callup_id)){
		$_SESSION['msg'] = 'Please input your callup number';
		header('Location:callupletter.php');
		exit;
	}
	$check = mysql_query("SELECT * FROM callup WHERE callupId='$callup_id'");
	$confirm = mysql_fetch_array(mysql_query("SELECT checkLetter FROM admin WHERE username = 'admin'"));
	if(mysql_num_rows($check)<=0){
		$_SESSION['msg'] = 'This callup Number does not exist';
		header('Location:callupletter.php');
		exit;
	}
	else{
		if($confirm[0] == 'no'){
			$_SESSION['msg'] = 'This action has been disabled! Please try again later';
			header('Location:callupletter.php');
			exit;
		}
		else{
		$_SESSION['callup'] = $callup_id;
		header('Location:viewcallup.php');
		exit;
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords($siteName).' | Call-Up Letter'; ?></title>
<link href="styles/styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/cssmenu.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/callupletter.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="jScripts/jq.js"></script>
<script type="text/javascript" src="jScripts/jqscript.js"></script>
</head>

<body>
<div id="container">
  <div id="header"><div id="head-img"></div></div>
  <div id='cssmenu'>
<ul>
   <li><a href='index.php'><span>HOME</span></a></li>
   <li class='has-sub '><a href='#'><span>CHECK CALLUP</span></a>
      <ul>
         <li class='has-sub '><a href='callupnumber.php'><span>CALLUP NUMBER</span></a>
         </li>
         <li class='has-sub '><a href='callupletter.php'><span>CALLUP LETTER</span></a>
         </li>
      </ul>
   </li>
   <li><a href='about.php'><span>ABOUT</span></a></li>
   <li><a href='contact.php'><span>CONTACT</span></a></li>
</ul>
</div> <!--CSS MENU -->
<?php
if(isset($_SESSION['msg'])){
echo '<div class="error">'.$_SESSION['msg'].'</div>';
unset($_SESSION['msg']);
}
?>
  <div id="dialog-container">
  <div id="dialog-box">
  <div id="login"><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="callupid">Enter Call-Up Number:</label><br />
    <input type="text" name="callupid" id="callupid" /><input name="check" type="submit" class="button" value="View CallUp" />
  </form>
  </div>
  <p>
  To view and print your callup letter, you must be a bonafide graduate of any recognized Nigerian institution, and must have seen your name published on our website. <br/> Login Now to view/print your details now.
  </p>
  <span class="view-callup"><a href="callupnumber.php">Not gotten my Callup Number Yet?</a></span>
  </div>
  </div>
</div>
<div id="footer"><?php echo ucwords($siteName).". &copy; Copyright ".date('Y');?></div>
</body>
</html>