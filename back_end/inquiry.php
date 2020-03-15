<?php
    header('Content-type: text/html; charset=UTF8');
    $id=$_GET["id"];
	$user="RemoteUser";
  	$host='123.57.41.237';
	$DBpassword='Remote1798164846';
    $dbName='Mask';
    class User 
    {
    public $id;
    public $time;
    public $name;
    public $IDnum;
    public $phone;
    public $num;
    public $win;
    }
	$link=new mysqli($host,$user,$DBpassword,$dbName);
	if ($link->connect_error)
	{
		echo ("数据库连接出错\n");
	}
	$link->query("SET NAMES utf8");
	$sql='SELECT * FROM appointment where id ='+ $id ;		// sql查询
	$res=mysqli_query($link,$sql);
    $result=[];		// 这个是要发送给前端的数组
    if($res){
        //echo "查询成功";
        while ($row = mysqli_fetch_array($result,MYSQL_ASSOC))
        {
        
        $user = new User();
        $user->id = $row["id"];
        $user->time = $row["time"];
        $user->name = $row["name"];
        $user->IDnum = $row["IDnum"];
        $user->phone = $row["phone"];
        $user->num = $row["num"];
        $user->win = $row["win"];
        $data[]=$user;
        }
        $json = json_encode($data);//把数据转换为JSON数据.
        if($user->win == "否")
        echo false;
        else echo $json;
        }else{
        echo "查询失败";
        }
    $link->close();		// 记得关闭连接
?>