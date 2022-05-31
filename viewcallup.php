<?php
session_start();
if(!isset($_SESSION['callup'])){
	$_SESSION['msg'] = 'Unauthorised access! Please try again';
	header('Location:callupletter.php');
	exit;
}
require_once('includes/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIEW CALL UP</title>
<link href="styles/viewcallup.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/styles.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="jScripts/jq.js"></script>
<script type="text/javascript" src="jScripts/jqscript.js"></script>
</head>

<body>
<div id="cover">
<div id="logo">
<img src="images/logo2.fw.png" style="z-index:2;" />
<span id="title">
<h2 id="nig">FEDERAL REPUBLIC OF NIGERIA</h2>
<h2 id="nysc">NATIONAL YOUTH SERVICE CORPS</h2>
</span>
</div>
<div id="letter-body">
<h2>
<?php
$array = mysql_fetch_array(mysql_query("SELECT * FROM callup WHERE callupId = '".$_SESSION['callup']."'"));
$fullName = $array['surname'].', '.$array['otherName'];
echo strtoupper($fullName);
?>
</h2>
<div id="sub-cover">
<div id="educational">
<h3>Educational Information</h3>
<table width="98%" border="0" cellpadding="5">
    <tr>
      <td align="left"><b>Department</b></td>
      <td align="right"><?php echo $array['department']; ?></td>
    </tr>
    <tr>
      <td align="left"><b>Faculty</b></td>
      <td align="right"><?php echo $array['facultyName']; ?></td>
    </tr>
    <tr>
      <td align="left"><b>School</b></td>
      <td align="right"><?php echo get_sch_name($array['callupId']); ?></td>
    </tr>
    <tr>
      <td align="left"><b>Year of Graduation</b></td>
      <td align="right"><?php echo $array['gradYr']; ?></td>
    </tr>
    <tr>
      <td align="left"><b>NYSC Callup Number</b></td>
      <td align="right"><?php echo $array['callupId']; ?></td>
    </tr>
    <tr>
      <td align="left"><b>NYSC Batch</b></td>
      <td align="right"><?php echo $array['batch']; ?></td>
    </tr>
    <tr>
      <td align="left"><b>State Posted To</b></td>
      <td align="right"><?php echo $array['postedTo']; ?></td>
    </tr>
  </table>
</div>
<div id="personal"><h3>Bio Data</h3>
  <table width="98%" border="0" cellpadding="10" cellspacing="10">
    <tr>
      <td align="left"><b>Surname</b></td>
      <td align="right"><?php echo $array['surname']; ?></td>
    </tr>
    <tr>
      <td align="left"><b>Other Name</b></td>
      <td align="right"><?php echo $array['otherName']; ?></td>
    </tr>
    <tr>
      <td align="left"><b>Date of Birth</b></td>
      <td align="right"><?php echo $array['dob']; ?></td>
    </tr>
    <tr>
      <td align="left"><b>State of Origin</b></td>
      <td align="right"><?php echo $array['state']; ?></td>
    </tr>
  </table>
</div>
</div>
</div>
</div>
<span><a href="#" id="print">Print</a></span>
</body>
</html>