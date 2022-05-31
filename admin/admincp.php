<?php
session_start();
if(isset($_GET['a'])&&$_GET['a'] == 'logout'){
	setcookie('user','',time()-3600,'/');
	setcookie('pwd','',time()-3600,'/');
	$_SESSION['error'] = 'You are successfully logged out!';
	header('Location:index.php');
	exit;
}
if(!(isset($_COOKIE['user'])&&isset($_COOKIE['pwd']))){
	$_SESSION['error'] = 'You are not logged in or Your session has expired!';
	header('Location:index.php');
	exit;
}
else{
		setcookie('user',$_COOKIE['user'],time()+30*60,'/');
		setcookie('pwd',$_COOKIE['pwd'],time()+30*60,'/');
}
require_once('../includes/functions.php');
if(isset($_POST['upload'])){
	if($_FILES['details']['error'] == 4){
		$msg = 'No File Selected!';
		$_SESSION['msg'] = $msg;
		header('Location:admincp.php');
		exit;
	}
	else{
	$file = fopen($_FILES['details']['tmp_name'],"r");
	$count = 0;
	$batch = mysql_fetch_array(mysql_query("SELECT batch FROM admin WHERE id = 1"));
	while(! feof($file)){
		$records = fgetcsv($file);
		if($records[0]=='Surname'||$records[0]=='')
		continue;
		$check = mysql_query("SELECT * FROM callup WHERE surname = '$records[0]' AND otherName = '$records[1]' AND dob = '$records[2]' AND state = '$records[3]' AND department = '$records[4]' AND facultyName = '$records[5]'");
		if(mysql_num_rows($check) > 0){
			continue;
		}
		else{
			$upload = mysql_query("INSERT INTO callup(surname,otherName,dob,state,department,facultyName,institution,gradYr,batch) VALUES('$records[0]','$records[1]','$records[2]','$records[3]','$records[4]','$records[5]','$records[6]','$records[7]','$batch[0]')");
		$count++;
		}
	}
fclose($file);
if($count == 0)
$msg = 'No Record Update! Empty file selected or the exact file has already been uploaded before!';
else
$msg = $count.' Records Uploaded Successfully!';
$_SESSION['msg'] = $msg;
//unset($_POST['upload']);
header('Location:admincp.php');
exit;
	}
}
if(isset($_GET['a'])&& $_GET['a'] == 'generateCallups'){
	generate_callup();
	$_SESSION['msg'] = "You have successfully assigned callup number to corp members";
	header("Location:admincp.php");
	exit;
}
if(isset($_GET['a'])&& $_GET['a'] == 'postCorpers'){
	random_post();
	exit;
}
if(isset($_POST['batch'])){
	$b = $_POST['b'];
	$update = mysql_query("UPDATE admin SET batch = '$b'");
	$_SESSION['msg'] = 'Current Batch is set to '.$b;
}
if(isset($_POST['addsch'])){
	$schName = $_POST['schname'];
	$schId = $_POST['schid'];
	$sch = mysql_query("SELECT * FROM schools WHERE institution = '$schId' OR schName = '$schName'");
	if(empty($schId)||empty($schName)){
		$_SESSION['msg2'] = 'All fields are required!';
	}
	elseif(mysql_num_rows($sch) > 0){
		$_SESSION['msg2'] = 'The Institution you are trying to add already exists';
	}
	else{
		$schName = ucwords($schName);
		$schId = strtoupper($schId);
		$query = mysql_query("INSERT INTO schools(institution,schName) VALUES('$schId','$schName')");
		if($query){
			$_SESSION['msg2'] = "You have successfully added $schName($schId)"; 
		}else{
			$_SESSION['msg2'] = mysql_error();
		}
	}
}
if(isset($_POST['confirm'])){
	if(isset($_POST['cn'])){
		$cn = $_POST['cn'];
		$update = mysql_query("UPDATE admin SET checkNo = '$cn'");
	}
	if(isset($_POST['cl'])){
		$cl = $_POST['cl'];
		$update = mysql_query("UPDATE admin SET checkLetter = '$cl'");
	}
	$_SESSION['msg2'] = 'Action Taken';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords($siteName).' | CallUp Letter'; ?></title>
<link href="../styles/styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="../styles/cssmenu.css" rel="stylesheet" type="text/css" media="all" />
<link href="../styles/admin.css" rel="stylesheet" type="text/css" media="all" />
<link href="../styles/popups.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../jScripts/jq.js"></script>
<script type="text/javascript" src="../jScripts/jqscript.js"></script>
</head>

<body>
<div id="transparent"></div>
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
   <li><a href='../about.php'><span>ABOUT</span></a></li>
   <li><a href='../contact.php'><span>CONTACT</span></a></li>
</ul>
</div> <!--CSS MENU -->
<div id="top-search">
<span style="float:right; padding-right:10px;"><b><?php echo $_COOKIE['user']; ?></b>&nbsp;(<a href="admincp.php?a=logout" style=" text-decoration:none; line-height:30px;">Logout</a>)</span>
<ul class="admin-button">
<li><a href=""><button>Add Details</button></a></li>
<li><a href="statistics.php"><button>Statistics</button></a></li>
<li><a href="#" id="new-record"><button>Upload New Record</button></a></li>
<li><a href="admincp.php?a=generateCallups"><button>Generate Callups</button></a></li>
<li><a href="admincp.php?a=postCorpers"><button>Post Corpers</button></a></li>
</ul>    
</div>
<?php
if(isset($_SESSION['msg'])){
echo '<div class="error">'.$_SESSION['msg'].'</div>';
unset($_SESSION['msg']);
}
?>
<div id="settings">
<?php
if(isset($_SESSION['msg2'])){
echo '<div class="error" style="margin-bottom:10px;">'.$_SESSION['msg2'].'</div>';
unset($_SESSION['msg2']);
}
?>
<div id="confirm-buttons" style="float:right;">
<?php
$d = '';
$e = '';
$f = '';
$g = '';
$confirm = mysql_fetch_array(mysql_query("SELECT checkNo,checkLetter FROM admin WHERE username = 'admin'"));
switch($confirm[0]){
	case 'no':
	$d = 'disabled="disabled"';
	break;
	case 'yes':
	$e = 'disabled="disabled"';
	break;
}
switch($confirm[1]){
	case 'no':
	$f = 'disabled="disabled"';
	break;
	case 'yes':
	$g = 'disabled="disabled"';
	break;
}
?>
<h1>Activate/Disable</h1>
<ul>
<li><form action="admincp.php" method="post"><label>Activate Callup Number:&nbsp;</label><input name="cn" type="hidden" value="no" /><input name="confirm" type="submit" value="NO" <?php echo $d; ?> /></form></li>
<li><form action="admincp.php" method="post"><input name="cn" type="hidden" value="yes" /><input name="confirm" type="submit" value="YES" <?php echo $e; ?> /></form></li>
<li><form action="admincp.php" method="post"><label>Activate Callup Letter:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input name="cl" type="hidden" value="no" /><input name="confirm" type="submit" value="NO" <?php echo $f; ?> /></form></li>
<li><form action="admincp.php" method="post"><input name="cl" type="hidden" value="yes" /><input name="confirm" type="submit" value="YES" <?php echo $g; ?> /></form></li>
</ul>
</form>
</div>
<div id="activate"></div>
<div class="addsch">
<form action="admincp.php" method="post">
<label>Institution:</label><br />
<input name="schname" type="text" /><br />
<label>School ID: (e.g. UNN)</label><br />
<input name="schid" type="text" /><br />
<input name="addsch" type="submit" value="Add Institution" style="width:230px; margin-top:5px;" />
</form>
</div>
</div>
<div id="batch-buttons">
<?php
$a = '';
$b = '';
$c = '';
$batch = mysql_fetch_array(mysql_query("SELECT batch FROM admin WHERE username = 'admin'"));
switch($batch[0]){
	case 'A':
	$a = 'disabled="disabled"';
	break;
	case 'B':
	$b = 'disabled="disabled"';
	break;
	case 'C':
	$c = 'disabled="disabled"';
	break;
}
?>
<h1>Select Batch</h1>
<ul>
<li><form action="admincp.php" method="post"><input name="b" type="hidden" value="A" /><input name="batch" type="submit" value="BATCH A" <?php echo $a; ?> /></form></li>
<li><form action="admincp.php" method="post"><input name="b" type="hidden" value="B" /><input name="batch" type="submit" value="BATCH B" <?php echo $b; ?> /></form></li>
<li><form action="admincp.php" method="post"><input name="b" type="hidden" value="C" /><input name="batch" type="submit" value="BATCH C" <?php echo $c; ?> /></form></li>
</ul>
</form>
</div>

</div>
<div id="footer"><?php echo ucwords($siteName).". &copy; Copyright ".date('Y');?></div>

<div id="pop-up">
<a href="#"><img src="../images/cancel.png" width="20" height="20" /></a>
<fieldset>
<legend>Upload Details</legend>
<form action="" method="post" enctype="multipart/form-data">
<table width="200" border="0">
  <tr>
    <td><input type="file" name="details" id="details" style="border:1px solid #CCC;" /></td>
  </tr>
  <tr>
    <td><input name="upload" type="submit" class="button" id="upload" value="upload" /></td>
  </tr>
</table>

</form>
</fieldset>
</div>
</body>
</html>