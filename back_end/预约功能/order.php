<?php
	require ('config.php');
	
	$name = $_POST['name'];
	$IDnum = $_POST['ID_num'];
	$phone = $_POST['phone'];
	$num = $_POST['num'];
	
	$db = new mysqli($host,$user,$DBpassword,$dbName);
	
	if(mysqli_connect_errno()){
		echo "错误：无法连接到数据库，请稍后再次重试";
		exit;
	}
	
	$db->query("SET NAMES utf8");
	$query = "select * from manage where id=(select max(id) from manage)";
	$result = $db -> query($query);
	$row = $result->fetch_assoc();
	$time = $row['time'];
	
	$query = "insert into appointment(time,name,IDnum,phone,num,win) 
	values('1','$name','$IDnum','$phone','$num','否')";
	$result = $db->query($query);
	
	if($result){
		
		echo "<p>预约成功\n</p>";
	}
	else{
		
		echo "<p>系统出错，请稍后再试</p>";
	}
	
	$query = "select * from appointment where IDnum = '"+$IDnum+"'";
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	$id = $row['id'];
	echo "<p>预约编号为："+$id+"</p>";


?>
	
	
	
	
	
	
	