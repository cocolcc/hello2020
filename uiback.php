<?php 
error_reporting(0);
$con = mysql_connect("localhost", "root", "");
mysql_select_db("app_zpw2000a", $con);

$uiback=$_POST['uiback'];

if($uiback!=''){
	$sql = "truncate table houtai_uiback"; 
    $res = mysql_query($sql); 
    $sql = "INSERT INTO houtai_uiback (url) VALUES ('$uiback')";
	$res = mysql_query($sql); 
	session_start();
	$_SESSION['uiback']=$uiback;

	echo "<script type='text/javascript'>alert('修改成功');location='userinterface.php';</script>";
}

?>