<?php
session_start();
require_once('includes/config.php');
if(isset($_POST['checkCallup'])){
	$inst = $_POST['university'];
	$course = $_POST['department'];
	$name = $_POST['names'];
	$_SESSION['inst'] = $inst;
	$_SESSION['course'] = $course;
	$_SESSION['name'] = $name;
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords($siteName).' | Call-Up Letter'; ?></title>
<link href="styles/styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/cssmenu.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/callupnumber.css" rel="stylesheet" type="text/css" media="all" />
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
<div id="top-search">
<?php
$confirm = mysql_fetch_array(mysql_query("SELECT checkNo FROM admin WHERE username='admin'"));
if($confirm[0] == 'no'){
	$d = 'disabled="disabled"';
}else{
	$d = '';
}
?>
    <form id="callup" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <table width="98%" border="0">
        <tr align="center">
          <td><select name="university" class="simpleform" id="university" <?php echo $d; ?>>
            <option value="">-- University --</option>
            <?php
			$sch = mysql_query("SELECT institution,schName FROM schools ORDER BY schName ASC");
			while(list($sid,$schname) = mysql_fetch_array($sch)){
				echo "<option value=\"$sid\">$schname</option>";
			}
            ?>
          </select></td>
          <td><select name="department" class="simpleform" id="department" <?php echo $d; ?>>
            <option value="">-- Department --</option>
            <?php
			$dept = mysql_query("SELECT DISTINCT department FROM callup ORDER BY department ASC");
			while($depts = mysql_fetch_array($dept)){
				echo "<option value=\"$depts[0]\">$depts[0]</option>";
			}
			?>
          </select></td>
          <td><input name="names" type="text" class="simpleform" id="names" value="Enter Your Surname" style="color:#DBB7B7;" <?php echo $d; ?> /></td>
          <td><input name="checkCallup" type="submit" id="checkCallup" value="Check Callup" <?php echo $d; ?> /></td>
        </tr>
      </table>
    </form>
</div>
<?php
if(isset($_SESSION['msg'])){
echo '<div class="error">'.$_SESSION['msg'].'</div>';
unset($_SESSION['msg']);
}
?>
<div id="result">
<?php 
if($confirm[0] == 'yes'){
	$display = ' style="display:none;"';
}else{
	$display = '';
}
?>
<h1 class="check-back"<?php echo $display; ?>>THIS SERVICE IS CURRENTY CLOSED!<br /> PLEASE CHECK BACK LATER!</h1>
 <?php
	$inst = @$_SESSION['inst'];
	$course = @$_SESSION['course'];
	$name = @$_SESSION['name'];
	if(isset($_POST['checkCallup'])||isset($_GET['page'])){
		echo '
  <table width="98%" border="1" cellpadding="10" class="resultTable">
    <tr align="center">
      <td><b>Surname</b></td>
      <td><b>Other Names</b></td>
      <td><b>Date of Birth</b></td>
      <td><b>State</b></td>
      <td><b>Department</b></td>
      <td><b>Faculty</b></td>
      <td><b>Institution</b></td>
      <td><b>Year of Graduation</b></td>
      <td><b>Callup Number</b></td>
    </tr>';
	 ////////////PAGINATION STARTS HERE$inst = @$_POST['university'];
	 if(empty($inst)&&empty($course)&&empty($name)){
		$_SESSION['msg'] = 'You must fill at least one field '.$_SESSION['course'];
		header('Location:callupnumber.php');
		exit;
	}
	elseif(empty($inst)&&empty($course)&&!empty($name)){
		$query = "surname LIKE '%$name%'";
	}
	elseif(empty($inst)&&empty($name)&&!empty($course)){
		$query = "department LIKE '%$course%'";
	}
	elseif(empty($name)&&empty($course)&&!empty($inst)){
		$query = "institution LIKE '%$inst%'";
	}
	elseif(empty($name)&&!(empty($course)&&empty($inst))){
		$query = "institution LIKE '%$inst%' AND department LIKE '%$course%'";
	}
	elseif(!(empty($name)&&empty($course))&&empty($inst)){
		$query = "institution LIKE '%$inst%' AND surname LIKE '%$name%'";
	}
	elseif(!(empty($name)&&empty($inst))&&empty($course)){
		$query = "institution LIKE '%$inst%' AND surname LIKE '%$name%'";
	}
	else $query = "department LIKE '%$course%' AND institution LIKE '%$inst%' AND surname LIKE '%$name%'";
	 $record = mysql_num_rows(mysql_query("SELECT * FROM callup WHERE $query"));
	 $total_pages = ceil($record/$rows_per_page);
	 if (isset($_GET['page']) && is_numeric($_GET['page'])) {
		 $current_page = (int) $_GET['page'];
		 } 
		 else $current_page = 1;
		 if ($current_page > $total_pages) {
   			$current_page = $total_pages;
			}
			if ($current_page < 1) {
				$current_page = 1;
				}
				$start_offset = ($current_page - 1) * $rows_per_page;
				//////////////////////////////////////////
	$run = mysql_query("SELECT * FROM callup WHERE $query LIMIT $start_offset,$rows_per_page");
	while($data = mysql_fetch_array($run)){
	echo "<tr>
      <td>$data[1]</td>
      <td>$data[2]</td>
      <td>$data[3]</td>
      <td>$data[4]</td>
      <td>$data[5]</td>
      <td>$data[6]</td>
      <td>$data[7]</td>
      <td>$data[8]</td>
      <td>$data[9]</td>
    </tr>";
	}
	 echo '</table>';
	echo "<div class=\"notification\"><b>Showing $record Results</b></div>";
				/////////////////////////////////////////
				echo '<div class="pagination">';
				if ($current_page > 1) {
					echo " <a href='{$_SERVER['PHP_SELF']}?page=1'><<</a> ";
					$prev_page = $current_page - 1;
					echo " <a href='{$_SERVER['PHP_SELF']}?page=$prev_page'><</a> ";
					}
					// loop to show links to range of pages around current page
					for ($x = ($current_page - $link_range); $x < (($current_page + $link_range) + 1); $x++) {
						// if it's a valid page number...
						if (($x > 0) && ($x <= $total_pages)) {
							// if we're on current page...
							if ($x == $current_page) {
								// 'highlight' it but don't make a link
								echo " <span style=\"background: #8080ff; border:1px solid #666;\"><b>$x</b></span> ";
								// if not current page...
								} else {
									// make it a link
									echo " <a href='{$_SERVER['PHP_SELF']}?page=$x'>$x</a> ";
									} // end else
									} // end if
									} // end for
									// if not on last page, show forward and last page links       
									if ($current_page != $total_pages) {
										// get next page
										$next_page = $current_page + 1;
										// echo forward link for next page 
										echo " <a href='{$_SERVER['PHP_SELF']}?page=$next_page'>></a> ";
										// echo forward link for lastpage
										echo " <a href='{$_SERVER['PHP_SELF']}?page=$total_pages'>>></a> ";
										} // end if
							echo '</div>';
	} //end $_POST['checkCallup']
	
	?>
</div>
</div>
<div id="footer"><?php echo ucwords($siteName).". &copy; Copyright ".date('Y');?></div>
</body>
</html>