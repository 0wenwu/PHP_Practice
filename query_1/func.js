function reset()
{
	ip1.value="";
	ip2.value="";
	ip1.focus();	
	tip.innerHTML="完成重置，请重新输入！";
}


function submit()
{
	if(ip1.value==""||ip2.value=="")
	{
		alert("学号和身份证不能为空！");
	}
	else
	{	
		tip.innerHTML="正在查询.....<br/>(如果2、3分钟过后仍未查出结果，请重新查询！)";		
		var url="dop.php";
		var url=url+"?sid="+ip1.value+"&uid="+ip2.value;
		location.href=url;		
	}
}