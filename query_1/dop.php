<html>
<head>
<meta charset="utf-8">
<title>
查询结果界面
</title>
<style>
.main{
	text-align:center;	
}

table{
	margin:0 auto;	
	border:1px solid black;
}

table td{
	text-align:center;
	border:1px solid black;
	width:100px;
}
</style>
</head>
<body>
<div id="main">
<?php
$sid=$_GET["sid"];
$uid=$_GET["uid"];
$con=@mysql_connect("localhost","root","wuwei");
if($con)
{
	@mysql_select_db("test",$con);
	$sql="select * from data where sid='".$sid."' and uid='".$uid."'";
	//$sql="select * from data where sid=201129060228"." and uid=412326199108031";
	$result=@mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		$row=@mysql_fetch_array($result);
		$file="data.xml";
		writeXML($file,$row);		
		$tag1=array("学院","学号","姓名","班级","派遣地","备注1","性别","身份证号","录取审批表1","录取审批表2","高考信息表","高中档案","毕业生登记");
		$tag2=array("学籍表","体检表","团关系1","团关系2","党员1","党员2","奖惩表1","奖惩表2","专升本1","专升本2","教师资格证1","教师资格证2","备注2");
		for($i=0;$i<13;$i++)
		{
			$arr1[]=$row[$i];
			$arr2[]=$row[$i+13];
		}
		echo "<h1 align='center'>查询结果</h1>";
		printTable($tag1,$arr1);
		printTable($tag2,$arr2);
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

function printTable($tag,$arr)
{	
	echo "<table cellspacing=0>";
	for($i=0;$i<2;$i++)
	{
		echo "<tr>";
		for($j=0;$j<13;$j++)
		{
			if($i==0)
			{
				echo "<td>".$tag[$j]."</td>";
			}
			else if($i==1)
			{
				echo "<td>".$arr[$j]."</td>";
			}
		}
		echo "</tr>";
	}
	echo "</table>";
	echo "<p></p>";
}
?>

</div>
</body>

</html>