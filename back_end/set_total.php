<?php
    header('Content-type: text/html; charset=UTF8');
    $time==$_GET["time"];
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
    $sql="update users set total= '"."$total'
        where time = '".$time."'";		// sql查询
     $result= mysqli_query($conn,$sql);
    if($result){
        exit("<script>
            alert('修改成功');
            location.href='index.php'
            </script>");
        }
    else{
        exit("<script>
            alert('修改失败');
            location.href='index.php';
            </script>");
        }

    $link->close();		// 记得关闭连接
?>