<?php
error_reporting(0);
session_start();

$con = mysql_connect("localhost", "root", "");
mysql_select_db("app_zpw2000a", $con);

$standard=170000;
$sgroup=$_GET['group'];//传感器组别
$timestamp=date("YmdHis");//采集时间戳
//$samplecode=$sgroup.'T'.$timestamp;//采集编号生成
$samplecode="A01T20191121145347";
$pic=$_SESSION['name'];//责任人
$file_path="information/sample/".$samplecode.".txt";
time_sleep_until(time()+1);//延时20秒后收集数据
mysqli_query($con , "set names utf8");

if(file_exists($file_path)){
	$file_arr=file($file_path);
	for($i=0;$i<count($file_arr);$i++){
		$error=0;
		$sample_arr=explode(' ',$file_arr[$i]);
        if($sample_arr[0]<($standard-$standard*0.05)||$sample_arr[0]>($standard+$standard*0.05)){//传感器误差过大,则加入警报日志
			$error=1;
		$sql = "SELECT * FROM report WHERE sensorid = '$sample_arr[1]' and timestamp='$sample_arr[3]'";
		$res = mysql_query($sql);
		$colum = mysql_fetch_array($res);
		if($colum['sensorid']==""){//查看是否已有警报日志，如果没有则插入
		    $sql = "INSERT INTO report (sensorid,sensorgroup,timestamp,samplecode,pic,reason)
		    VALUES($sample_arr[1],'$sample_arr[2]',$sample_arr[3],'$samplecode','$pic','传感器值误差过大')";
		    $result = mysql_query($sql);
			echo "<script>alert('您有新的警报日志！');location='userinterface.php'</script>";
		}
		}

        if($sample_arr[3]-20191121145347>=16){//传感器采集异常,则加入警报日志（这里采用了调试时间戳，其实判断条件应该为 if($sample_arr[3]-$timestamp>=16）
			$error=1;
		$sql = "SELECT * FROM report WHERE sensorid = '$sample_arr[1]' and timestamp='$sample_arr[3]'";
		$res = mysql_query($sql);
		$colum = mysql_fetch_array($res);
		if($colum['sensorid']==""){//查看是否已有警报日志，如果没有则插入
		    $sql = "INSERT INTO report (sensorid,sensorgroup,timestamp,samplecode,pic,reason)
		    VALUES($sample_arr[1],'$sample_arr[2]',$sample_arr[3],'$samplecode','$pic','传感器采集异常')";
		    $result = mysql_query($sql);
			echo "<script>alert('您有新的警报日志！');location='userinterface.php'</script>";
		}
		}

		$sql = "SELECT * FROM sensor WHERE sensorid = '$sample_arr[1]'";
		$res = mysql_query($sql);
		$colum = mysql_fetch_array($res);
		if($colum['sensorid']==""){//查看传感器id是否存在于系统中，如果不存在，则警报
			$error=1;
		$sql = "SELECT * FROM report WHERE sensorid = '$sample_arr[1]' and timestamp='$sample_arr[3]'";
		$res = mysql_query($sql);
		$colum = mysql_fetch_array($res);

		if($colum['sensorid']==""){//查看是否已有警报日志，没有则插入
		    $sql = "INSERT INTO report (sensorid,sensorgroup,timestamp,samplecode,pic,reason)
		    VALUES('$sample_arr[1]','$sample_arr[2]','$sample_arr[3]','$samplecode','$pic','虚假传感器id')";
		    $result = mysql_query($sql);
		}
		echo "<script>alert('系统遭到攻击，请尽快查看警报日志！');location='userinterface.php'</script>";
		}

		$sql = "SELECT * FROM sensor WHERE sensorgroup = '$sample_arr[2]'";
		$res = mysql_query($sql);
		$colum = mysql_fetch_array($res);
		if($colum['sensorgroup']==""){//查看传感器组别是否存在于系统中，如果不存在，则警报
			$error=1;
		$sql = "SELECT * FROM report WHERE sensorgroup = '$sample_arr[2]' and timestamp='$sample_arr[3]'";
		$res = mysql_query($sql);
		$colum = mysql_fetch_array($res);
		if($colum['sensorid']==""){//查看是否已有警报日志，没有则插入
		    $sql = "INSERT INTO report (sensorid,sensorgroup,timestamp,samplecode,pic,reason)
		    VALUES('$sample_arr[1]','$sample_arr[2]','$sample_arr[3]','$samplecode','$pic','虚假传感器组别')";
		    $result = mysqli_query($con,$sql);
		}
		echo "<script>alert('系统遭到攻击，请尽快查看警报日志！');location='userinterface.php'</script>";
		}

		$sql = "SELECT * FROM sample WHERE sensorid = '$sample_arr[1]' and timestamp='$sample_arr[3]'";
		$res = mysql_query($sql);
		$colum = mysql_fetch_array($res);
		if($colum['sensorid']==""){//若没有该采集记录则插入采集记录

		    $sql = "INSERT INTO sample (sensorid,sensorgroup,timestamp,value,samplecode,error,pic)
		    VALUES($sample_arr[1],'$sample_arr[2]',$sample_arr[3],$sample_arr[0],'$samplecode',$error,'$pic')";
		    $result = mysql_query($sql);

		}

	}
}
fclose($file_arr);
echo "<script>alert('采集完成！');location='userinterface.php'</script>";

?>