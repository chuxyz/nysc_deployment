<?php
//check if this file isnt being accessed directly
 if (stristr(htmlentities($_SERVER['PHP_SELF']), "functions.php")) {
	   header("Location:../index.php");
    die();
}
include('config.php');
function get_state_id($state){
	//$get = mysql_fetch_array(mysql_query("SELECT state FROM callup WHERE state = '$callup'"));
	$state_id = mysql_fetch_array(mysql_query("SELECT id FROM state WHERE state = '$state'"));
	return $state_id[0];
}
function get_state_name($id){
	$state_name = mysql_fetch_array(mysql_query("SELECT state FROM state WHERE id = '$id'"));
	return $state_name[0];
}
function can_go_to_state($from_state,$to_state){
	$state1 = mysql_fetch_array(mysql_query("SELECT zone FROM state WHERE id = '$from_state'"));
	$state2 = mysql_fetch_array(mysql_query("SELECT zone FROM state WHERE id = '$to_state'"));
	if($state1[0] != $state2[0]){
		return true;
	}
	return false;
}
function generate_callup(){
	$row = mysql_query("SELECT id FROM callup WHERE callupId = '0'");
	$count = 0;
	if(mysql_num_rows($row) > 0){
	while($rows = mysql_fetch_array($row)){
		$coin = 0;
		while(1){
		$call = rand(111111,999999);
		$call = date('Y').$call;
		$check = mysql_query("SELECT callupId FROM callup WHERE callupId = '$call'");
		if(mysql_num_rows($check) <= 0){
			$in = mysql_query("UPDATE callup SET callupId = '$call' WHERE id='$rows[0]'");
			$count++;
			$coin = 1;
		}
		else{
			$coin = 0;
		}
		if($coin == 1) break;
		else continue;
		} //end 2nd while
	} //end 1st while
	return $count;
	}
	else return $count;
}

function random_post(){
	$row = mysql_query("SELECT id,state FROM callup WHERE postedTo = 'state'");
	if(mysql_num_rows($row) > 0){
	while($rows = mysql_fetch_array($row)){
		$my_state = (int) trim(get_state_id($rows[1]));
		while(1){
			$rand_state = rand(1,37);
			if(can_go_to_state($my_state,$rand_state)){
				$update = mysql_query("UPDATE callup SET postedTo = '".get_state_name($rand_state)."' WHERE id = '$rows[0]'");
				break;
			}
		}
	}
	}
	else{
	$_SESSION['msg'] = 'All Corp members has already been posted!';
	header("Location:admincp.php");
	return;
	}
	$_SESSION['msg'] = "You have successfully posted all corp members";
	header("Location:admincp.php");
}
function get_sch_name($callup){
	$query = mysql_fetch_array(mysql_query("SELECT schools.schName FROM schools INNER JOIN callup ON schools.institution=callup.institution WHERE callupId='$callup'"));
	return $query[0];
	
}
?>