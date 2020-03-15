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
	$sql='SELECT * FROM appointment';		// sql查询
	$res=mysqli_query($link,$sql);	
    $TIME=$_GET['time'];
    $result=[];	
	while($row=$res->fetch_assoc())
	{
		//array_push($result,$row);
		if($row['win']=='是'&&$row['time']==$TIME)
		{
            array_push($result,$row['name']);		
		}
    }
    echo json_encode($result);
	$link->close();		// 记得关闭连接
	return $result;
?>