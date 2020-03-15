<?php
    header("Content-type:text/html;charset=utf-8");
    $json=array();

    $time=$_GET["time"];    // 获取要开奖的活动是第几次活动
    //$time=1;              //测试用
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

    $sql1="SELECT * FROM manage WHERE time = '".$time."'";		// sql查询
    $res1=mysqli_query($link,$sql1);
    $total=0;    // 口罩总量
    while($row=$res1->fetch_assoc())
	{
        $total=$row['total'];    // 获取本次预约活动的口罩总量
    }

    $sql2="SELECT * FROM appointment WHERE time = '".$time."'";		// sql查询
	$res2=mysqli_query($link,$sql2);
    $startID=0;
    $endID=0;
    $idArray=array();
    $numArray=array();
    $winArray=array();
    $win = "是";
	while($row=$res2->fetch_assoc())
	{      
        if($startID==0)
        {
            $startID=$row['id'];    // 本次预约成功的起始id
        }
        if($endID<$row['id'])
        {
            $endID=$row['id'];      // 本次预约成功的结束id
        }
        array_push($idArray,$row['id']);     // id的索引数组
        array_push($numArray,$row['num']);   // 所需数量的索引数组
        array_push($winArray,$row['win']);   // 是否中奖的索引数组
    }

    //array_push($json,$total,$idArray,$numArray,$winArray);

    $flag=1;
    while($total>0)
    {
        $winID=mt_rand(0,$endID-$startID);     // 随机取得一个中签用户id
        if($winArray[$winID]=="否" && $numArray[$winID]<=$total)  // 若该用户未中签且需要的口罩数量小于当前所剩余数量
        {
            $winArray[$winID]="是";            // 该用户的中奖标志设为1
            $total=$total-$numArray[$winID];   // 口罩剩余数量减少
        }
        for($x=0;$x<count($idArray);$x++){
            if($winArray[$x]=="否" && $numArray[$x]<=$total)  // 如果还存在用户未中签且需要的口罩数量小于当前所剩余数量
            {
                $flag=1;
                break;
            }
            $flag=0;   // 如果不存在 用户未中签且需要的口罩数量小于当前所剩余数量 的情况，将flag置0
        }
        if($flag==0)   // flag为0则跳出while循环
        {
            break;
        }
    }


    for($x=0;$x<count($idArray);$x++)
    {
        $sql3="UPDATE appointment SET win = '".$winArray[$x]."' WHERE id = '".$idArray[$x]."'" ;  // sql插入
        $res3=mysqli_query($link,$sql3);
    }

	//array_push($json , $res3);
	$link->close();
	//echo json_encode($json);

?>
