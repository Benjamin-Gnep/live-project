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
	$result=[];		// 这个是要发送给前端的数组
	while($row=$res->fetch_assoc())
	{
		//array_push($result,$row);
		if($row['win']=='是')
		{
			//$rows=$row['name']+$row['IDnum']+$row['phone']+$row['num'];
			array_push($result,$row['name'],$row['IDnum'],$row['phone'],$row['num']);
			$link->close();	
			echo json_encode($result);
			return $result;
		}
		
	}
    echo json_encode($result);		// 这一步很关键，要把数组打包成json发送
	$link->close();		// 记得关闭连接
	return $result;
?>