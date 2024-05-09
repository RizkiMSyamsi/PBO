<?php 
	session_start();
	$db = mysqli_connect("localhost", "root", "");
	mysqli_select_db($db,"market");
	
	// settings
	$url = "http://localhost/Mart/";
	$title = "market";
	$no = 1;
	
	function alert($command){
		echo "<script>alert('".$command."');</script>";
	}
	function redir($command){
		echo "<script>document.location='".$command."';</script>";
	}
	function validate_admin_not_login($command){
		if(empty($_SESSION['iam_admin'])){
			redir($command);
		}
	}
?>