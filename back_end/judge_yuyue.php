<?php
header("Content-type:textml;charset=utf-8");
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
$IDnum = $_GET["IDnum"];//前端获取用户身份号码
if (isCreditNo($IDnum)==false) return false;
$host = '数据库地址';
$user = "数据库用户名";
$DBpassword = '数据库密码';
$dbName = 'Mask';
$link = new mysqli($host, $user, $DBpassword, $dbName);
if ($link->connect_error) {
    echo ("错误: 无法连接到数据库. 请稍后再次重试.");
}
$sql = "SELECT * FROM appointment WHERE IDnum ='" . $IDnum. "'";
$link->query('SET NAMES UTF8');
$res = $link->query($sql);//返回结果
if ($res){
    $row=$res->fetch_assoc();
    //此前三次预约中成功中签,return false;
    //如果本次摇号已经登记过， return false;
}

$link->close();
return true;
}
?>