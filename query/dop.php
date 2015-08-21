<?php
$sid=$_POST["sid"];
$uid=$_POST["uid"];
$con=@mysql_connect("url","username","password");
if($con)
{
	@mysql_select_db("test",$con);
	$sql="select * from data where sid='".$sid."' and uid='".$uid."'";
	//$sql="select * from data where sid=201129060228"." and uid=412326199108031";
	$result=@mysql_query($sql);
	$count=mysql_num_rows($result);
	if($count>0)
	{
		$row=@mysql_fetch_array($result);
		$file="data.xml";
		writeXML($file,$row);
		for($i=0;$i<count($row);$i++)
		{
			@$arr[$i]=urlencode($row[$i]);
		}
		$arr=json_encode($arr);
		$arr=urldecode($arr);
		echo $arr;	
		
	}
	else
	{
		echo "数据库中无匹配数据，请检查输入证件号是否正确！";
	}
	mysql_close($con);
}
else
{
	echo "网络故障，连接不上数据库:\n".mysql_error();
}


function writeXML($path,$data)
{
	$dom=new DOMDocument("1.0","utf-8");
	$dom->formatOutput=true;
	if(file_exists($path))
	{
		$dom->load($path);
		$stus=$dom->getElementsByTagName("个人信息")->item(0);		
	}
	else
	{
		$stus=$dom->createElement("个人信息");
	}
	$stu=$dom->createElement("同学");
	$tag=array("学院","学号","姓名","班级","派遣地","备注1","性别","身份证号","录取审批表1","录取审批表2","高考信息表","高中档案","毕业生登记","学籍表","体检表","团关系1","团关系2","党员1","党员2","奖惩表1","奖惩表2","专升本1","专升本2","教师资格证1","教师资格证2","备注2");
	for($i=0;$i<count($tag);$i++)
	{
		$node=$dom->createElement($tag[$i],$data[$i]);
		$stu->appendChild($node);
	}
	$stus->appendChild($stu);
	$dom->appendChild($stus);
	$dom->save($path);
}
?>
