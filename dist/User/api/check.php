<?php

require ('config.php');
// 预约查询

//判断身份证号码是否合法
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
	
	//预约判断
	function cheak_IDnum(){
	header("Content-type:textml;charset=utf-8");
	$IDnum = $_GET["ID_num"];//前端获取用户身份号码
	$phone = $_GET['phone'];
	if (isCreditNo($IDnum)==false) return false;
	$user="RemoteUser";
	$host='123.57.41.237';
	$DBpassword='Remote1798164846';
	$dbName='Mask';
	$link = new mysqli($host,$user,$DBpassword,$dbName);
	if ($link->connect_error) {
	    echo ("错误: 无法连接到数据库. 请稍后再次重试.");
	}
	$sql = "SELECT * FROM appointment WHERE IDname ='".$IDnum."' or phone ='".$phone."'";
	$link->query('SET NAMES UTF8');
	$res = $link->query($sql);//返回结果
	$key = 0;
	while($row=$res->fetch_assoc()){
		$key++;
	}
	if($key == 0){
		return false;
	}
	$sql = "SELECT * FROM appointment WHERE IDname ='".$IDnum."' and phone ='".$phone."' and win = '是'";
	$res = $link->query($sql);
	$query = "select * from manage where id=(select max(id) from manage)";
	$result = $db -> query($query);
	$row = $result->fetch_assoc();
	$ti = $row['time'];
	for($i=0;$i<$num_results;$i++){
		$row = $result->fetch_assoc();
		$time = $ti - $row['time'];
		if($time <= 3){
			return false;
		}
	}
	$link->close();
	return true;
	}
?>