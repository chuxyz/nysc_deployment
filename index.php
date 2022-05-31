<?php
session_start();
require_once('includes/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords($siteName).' | Home'; ?></title>
<link href="styles/styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/cssmenu.css" rel="stylesheet" type="text/css" media="all" />
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
  <div id="right-nav">
  <div id="in-right">
  <div id="sideNav">
  <ul class="menu">
  <li><h1 class="nav-title">MENU</h1></li>
  </ul>
  <ul id="quick-links">
  <li><div class="right-caret-black"></div><a href='index.php'>Home</a></li>
         <li><div class="right-caret-grey"></div><a href='callupnumber.php'><span>Callup Number</span></a>
         </li>
         <li><div class="right-caret-grey"></div><a href='callupletter.php'><span>Callup Letter</span></a>
         </li>
   </li>
   <li><div class="right-caret-black"></div><a href='about.php'><span>About</span></a></li>
   <li><div class="right-caret-black"></div><a href='contact.php'><span>Contact</span></a></li>
  </ul>
  </div>
  </div>
  </div>
  <div id="main">
  <div id="imgBox">
  <img src="images/nysc1.png" width="100%" height="100%" />
  </div>
  <div id="info">
  <h1 id="guidelines">&laquo;&nbsp;GUIDELINES ON HOW TO NAVIGATING THROUGH THIS SITE&nbsp;&raquo;</h1>
  <ul>
  <li>From the Homepage, click on <a href="callupnumber.php">Callup Number</a> and use the top search options to check your callup by searching by your school, your department or your Surname.</li>
  <li>Now with your obtained callup number, simply click on the link <a href="callupletter.php">Callup Letter</a></li>
  <li>Now input your callup number in the textfield to view/print your callup letter.</li>
    </ul>
  </div>
  </div>
</div>
<div id="footer"><?php echo ucwords($siteName).". &copy; Copyright ".date('Y');?></div>
</body>
</html>