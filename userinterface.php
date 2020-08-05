<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<title>
			高速铁路补偿电容监测系统
		</title>
		<link rel="stylesheet" href="css/userinterface.css">
		<link rel="stylesheet" href="css/original.css">
	</head>
	<body background="img/000.jpg" style="background-repeat: no-repeat;background-size:cover">

		<header>
		<div class="box"align="center">
			<h1 style="color:darkorange">
				欢迎来到补偿电容监测系统
			</h1>
		</div>
			<div class="rnav" align="center">
			<h3>您好<?php error_reporting(0); session_start();echo $_SESSION['name'];?></h3>
				<a href="Homepage.html">
					<h2>登出</h2>
				</a>
			</div>
		</header>
		<div class="nav">
		<h2 style="color:red">最近的十次警报</h2>
		<?php
		error_reporting(0);
        session_start();

        $con = mysql_connect("localhost", "root", "");
        mysql_select_db("app_zpw2000a", $con);

		echo "<table>";
		$sql = "SELECT * FROM report ORDER BY timestamp DESC";
		$res = mysql_query($sql);
		for($i=0;$i<10;$i++){
			if($colum = mysql_fetch_array($res)){
			echo "<br><br><tr>发生在{$colum['timestamp']}</tr>
			<br><tr>传感器id为{$colum['sensorid']}</tr>
			<br><tr>传感器组别为{$colum['sensorgroup']}</tr>
			<br><tr>故障原因为{$colum['reason']}</tr>";
			echo "<br>";
			}
		}
		echo "</table>";
		echo "<a href='report.php'>查看更多</a>";
		?>

		</div>
        <script type='text/javascript'>
		function sampleGroup1(){
			location.href="sample.php?group=A01";
		}
		function sampleGroup2(){
			location.href="sample.php?group=A02";
		}
		</script>

        <div class="box" align="center">
		     <h2 style="color:blue">手动采集数据</h2>
             <br>
			 <input style="width:30%; height:10%;"  type="button" value="组别1" onclick="sampleGroup1()"/>
			 <br>
			 <br>
			 <input  style="width:30%; height:10%;" type="button"  value="组别2" onclick="sampleGroup2()"/>
		</div>

		<div class="box" align="center">
		<h2 style="color:blue">最近的一次采集</h2>
		<div class="table1" align="center" style="background-color:white;width:65%;">
		<?php
		error_reporting(0);
        session_start();

        $con = mysql_connect("localhost", "root", "");
        mysql_select_db("app_zpw2000a", $con);

		echo "<table border='1'><tr><td>采集时间</td><td>传感器id</td><td>传感器组别</td><td>传感器值</td><td>传感器错误类型</td>";
		$sql = "SELECT * FROM sample ORDER BY timestamp DESC";
		$res = mysql_query($sql);
		$colum = mysql_fetch_array($res);
		$charge=$colum['pic'];
		echo "传感器采集批次为{$colum[samplecode]}<br>";
		$sql = "SELECT * FROM sample WHERE samplecode='$colum[samplecode]' ORDER BY timestamp DESC";
		$res = mysql_query($sql);
        while($colum = mysql_fetch_array($res)){
			echo "<tr><td>{$colum['timestamp']}</td>
			<td>{$colum['sensorid']}</td>
			<td>{$colum['sensorgroup']}</td>
			<td>{$colum['value']}</td>
			<td>{$colum['error']}</td></tr>";
		}
		echo "<br>负责人为{$charge}";
		echo "</table>";
		echo "<a href='sample_out.php'>查看更多</a>";
		?>
		</div>
		</div>






							<div class="box" align="center">
							<h2 style="color:blue">搜 索 信 息</h2>
							<form action="search.php" method="post" name="keyword">
                                    <br>
									<input style="width:30%; height:10%;" name="keyword" type="text" />
									<br>
									<input  style="width:31%; height:11%;" type="submit" value="Search" />
							</form>
							<br>
							<div class="text1" align="center">
							<h3>搜索功能使用细则</h3>
							<p align="left">
							<br>
							1.能搜索的信息有：警报日志、批量采集信息。
							<br>
							<br>
							2.在警报日志的搜索中，关键词是时间。可以具体到年、月、日。如2019、201911、20191120等都是合法的输入项。【排列顺序为日期的降序，即日期最近的优先显示】
							<br>
							<br>
							3.在批量采集信息的搜索中，关键词为传感器所在的组号(由字母A起头)、传感器的id（由2020起头）、或是传感器的采集编号（传感器组号和采集时间戳相关）。【排列顺序为日期的降序，即日期最近的优先显示】
							<br>
							<br>
							</p>
							</div>
							</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>	
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>	
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>	
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>	
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
	</body>
</html>