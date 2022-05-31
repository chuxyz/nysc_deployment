<?php
session_start();
require_once('includes/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords($siteName).' | About Us'; ?></title>
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
  <h1 class="title"><span style="padding-left:40px;">About</span></h1>
    <div id="about">
    <span>This is a final year project that tries to simulate the possibilites of an <b>NYSC Online Posting System</b>. A system whereby students, fresh university graduates or prospective corp members can easily check their callup Numbers, Callup Letters and resolve various NYSC posting issues without having to visit their various institutions in order to resolve such issues , check their callup Number or even get their callup letters. All he/she has to do is to simply browse to the various sections of this website. Need to <a href="contact.php">contact us</a> you can simply visit our contact page. </span>
    </div>
  </div>
</div>
<div id="footer"><?php echo ucwords($siteName).". &copy; Copyright ".date('Y');?></div>
</body>
</html>