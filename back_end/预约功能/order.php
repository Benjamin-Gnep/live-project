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
	
	function isCreditNo($vStr){
		$vCity = array(
				'11','12','13','14','15','21','22',
				'23','31','32','33','34','35','36',
				'37','41','42','43','44','45','46',
				'50','51','52','53','54','61','62',
				'63','64','65','71','81','82','91'
		);
		if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;
		if (!in_array(substr($vStr, 0, 2), $vCity)) return false;
		$vStr = preg_replace('/[xX]$/i', 'a', $vStr);
		$vLength = strlen($vStr);
		if ($vLength == 18) {
			$vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
		} else {
			$vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
		}
		if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
		if ($vLength == 18) {
			$vSum = 0;
			for ($i = 17 ; $i >= 0 ; $i--) {
				$vSubStr = substr($vStr, 17 - $i, 1);
				$vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr , 11));
			}
			if($vSum % 11 != 1) return false;
		}
		return true;
	}

	
	if (isCreditNo($IDnum)==false){
		$json = "身份证号输入格式错误，请重新输入";
		echo json_encode($json);
		exit;
	}
	
	$query = "SELECT * FROM appointment WHERE IDnum ='".$IDnum."' or phone ='".$phone."'";
	$db->query('SET NAMES UTF8');
	$result = $db->query($query);//返回结果
	$num_results = $result->num_rows;
	if($num_results > 0){
		$json = "身份信息已录入";
		echo json_encode($json);
		exit;
	}
	
	$sql = "SELECT * FROM appointment WHERE IDnum ='".$IDnum."' and phone ='".$phone."' and win = '是'";
	$res = $db->query($sql);
	
	$query = "select * from manage where id=(select max(id) from manage)";
	$result = $db -> query($query);
	$row = $result -> fetch_assoc();
	$ti = $row['time'];
	$num_results = $res->num_rows;
	for($i=0;$i<$num_results;$i++){
		$ro = $res -> fetch_assoc();
		$time = $ti - $ro['time'];
		if($time <= 3){
			$json = "该手机号或者身份证号在此前三次预约中成功中签，预约失败";
			echo json_encode($json);
			exit;
		}
	}
	
	
	$query = "insert into appointment(time,name,IDnum,phone,num,win) 
	values('$ti','$name','$IDnum','$phone','$num','否')";
	echo $query;
	$result = $db->query($query);
	
	if($result){
		
		$json = "预约成功";
		echo json_encode($json);
	}
	else{
		
		$json = "系统出错，请稍后再试";
		echo json_encode($json);
		exit;
	}
	
	$query = "select * from appointment where IDnum = '".$IDnum."'";
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	$id = $row['id'];
	$json = "预约编号为：".$id;
	echo json_encode($json);

	$result -> free();
	$db -> close();
?>
	
	
	
	
	
	
	