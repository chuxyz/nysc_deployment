<?php
session_start();
require_once('../includes/config.php');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords($siteName).' | Call-Up Letter'; ?></title>
<link href="../styles/styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="../styles/cssmenu.css" rel="stylesheet" type="text/css" media="all" />
<link href="../styles/callupnumber.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="../jScripts/jq.js"></script>
<script type="text/javascript" src="../jScripts/jqscript.js"></script>
</head>

<body>
<div id="container">
  <div id="header"><div id="head-img"></div></div>
  <div id='cssmenu'>
<ul>
   <li><a href='../index.php'><span>HOME</span></a></li>
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
<div id="stat">
  <table width="98%" border="0" align="center">
    <tr>
      <td><b>State</b></td>
      <td><b>Number of candidates from state</b></td>
      <td><b>Number of candidates posted to state</b></td>
    </tr>
    <?php
	$state = mysql_query("SELECT state FROM state");
	while($states = mysql_fetch_array($state)){
		$from_state = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM callup WHERE state = '$states[0]'"));
		$to_state = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM callup WHERE postedTo = '$states[0]'"));
      echo "<tr><td>$states[0]</td>
      <td align=\"right\">$from_state[0]</td>
      <td align=\"right\">$to_state[0]</td></tr>";
	}
	$total = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM callup"));
	echo "<tr><td>Total</td><td align=\"right\">$total[0]</td><td align=\"right\">$total[0]</td></tr>";
	?>
  </table>
</div>
</div>
<div id="footer"><?php echo ucwords($siteName).". &copy; Copyright ".date('Y');?></div>
</body>
</html>