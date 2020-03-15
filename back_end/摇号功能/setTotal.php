<?php
    header("Content-type:text/html;charset=utf-8");
    $total=$_GET["total"];
    //$total=100;

    $user="RemoteUser";
  	$host='123.57.41.237';
	$DBpassword='Remote1798164846';
	$dbName='Mask';
	$link=new mysqli($host,$user,$DBpassword,$dbName);
	if ($link->connect_error)
	{
		echo ("sss");
    }
    mysqli_set_charset($link, "utf8");

    $sql0="SELECT * FROM manage";		// sql查询manage表
    $res0=mysqli_query($link,$sql0);
    $time=0;       // 摇号的活动次数
    while($row=$res0->fetch_assoc())
	{
        if($time<$row['time'])
        {
            $time=$row['time'];        // 获取当前最新的活动次数
        }
    }

    $sql1="UPDATE manage SET total = '".$total."' WHERE time = '".$time."'" ;  // sql更新manage表
    $res1=mysqli_query($link,$sql1);

    $link->close();
?>
