<?php
    require("randFunction.php");       // 简易的加权随机数算法
    header("Content-type:text/html;charset=utf-8");
    //$json=array();        // 测试输出

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
            $time=$row['time'];        // 获取要摇号的活动是最新的当前活动
        }
    }

    $sql1="SELECT * FROM manage WHERE time = '".$time."'";		// sql查询manage表
    $res1=mysqli_query($link,$sql1);
    $total=0;       // 口罩总量
    while($row=$res1->fetch_assoc())
	{
        $total=$row['total'];        // 获取本次预约活动的口罩总量
    }

    $sql2="SELECT * FROM appointment WHERE time = '".$time."'";		// sql查询appointment表
	$res2=mysqli_query($link,$sql2);
    //$startID=0;
    //$endID=0;
    $idArray=array();
    $idNumArray=array();
    $weightArray=array();
    $numArray=array();
    $winArray=array();
    $win = "是";
	while($row=$res2->fetch_assoc())
	{      
        /*if($startID==0)
        {
            $startID=$row['id'];    // 本次预约成功的起始id，在加权算法中无需使用，故注释
        }
        if($endID<$row['id'])
        {
            $endID=$row['id'];      // 本次预约成功的结束id，在加权算法中无需使用，故注释
        }*/
        array_push($idArray,$row['id']);         // id的索引数组
        array_push($idNumArray,$row['IDnum']);   // IDnum的索引数组
        array_push($weightArray,100);            // 权重的索引数组，初始权重均为100
        array_push($numArray,$row['num']);       // 所需数量的索引数组
        array_push($winArray,$row['win']);       // 是否中奖的索引数组
    }

    //array_push($json,$total,$idArray,$idNumArray,$numArray,$winArray);          // 测试数据是否获取正常

    for($x=0;$x<count($idArray);$x++)
    {
        $sql3="SELECT * FROM appointment WHERE time < '".$time."' AND IDnum = '".$idNumArray[$x]."'";  // sql查询appointment表
        $res3=mysqli_query($link,$sql3);
        while($row=$res3->fetch_assoc())
	    {
            if($row['win']=="是")
            {
                $weightArray[$x]=round($weightArray[$x]*(1-0.1));      //每中签一次，权重*0.9
            }
            else if($row['win']=="否")
            {
                $weightArray[$x]=round($weightArray[$x]*(1+0.1));      //每未中签一次，权重*1.1
            }
        }
    }

    //array_push($json,$weightArray);             // 测试权重数据是否正常

    $flag=1;
    while($total>0)
    {
        $winID=MyRand($weightArray);     // 使用MyRand函数随机取得一个下标,范围为$winArray的长度
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
            $flag=0;   // 如果不存在用户未中签且需要的口罩数量小于当前所剩余数量的情况，将flag置0
        }
        if($flag==0)   // flag为0则跳出while循环
        {
            break;
        }
    }

    for($x=0;$x<count($idArray);$x++)
    {
        $sql4="UPDATE appointment SET win = '".$winArray[$x]."' WHERE id = '".$idArray[$x]."'" ;  // sql更新appointment表
        $res4=mysqli_query($link,$sql4);
    }

	//array_push($json , $res4);
	//echo json_encode($json);
    $link->close();
?>
