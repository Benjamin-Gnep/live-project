<?php
	header('Content-type: text/html; charset=UTF8');
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
	$sql='SELECT * FROM administrators';		// sql查询
	$res=mysqli_query($link,$sql);	
	$ID=$_GET['id'];
	$PASSWORD=$_GET['password'];
	while($row=$res->fetch_assoc())
	{
		//array_push($result,$row);
		if($row['id']==$ID&&$row['password']==$PASSWORD)
		{
			$link->close();	
			return true;
		}
	}
	$link->close();		// 记得关闭连接
	return false;
?>