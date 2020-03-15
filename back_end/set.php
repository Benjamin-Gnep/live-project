<?php
    header('Content-type: text/html; charset=UTF8');
    $time==$_GET["time"];
    $open_time=$_GET["open_time"];
    $close_time=$_GET["close_time"];
    $max=$_GET["max"];
    $total=$_GET["total"];
	$user="RemoteUser";
  	$host='123.57.41.237';
	$DBpassword='Remote1798164846';
    $dbName='Mask';
	$link=new mysqli($host,$user,$DBpassword,$dbName);
	if ($link->connect_error)
	{
		echo ("数据库连接出错\n");
	}
	$link->query("SET NAMES utf8");
	$sql='UPDATE * FROM manager where time ='+ $time ;		// sql查询
	$res=mysqli_query($link,$sql);
    
    $link->close();		// 记得关闭连接
?>