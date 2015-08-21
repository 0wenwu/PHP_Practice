function getXMLHttpObject()
{
	var xmlHttp=null;
	try
	{
		xmlHttp=new XMLHttpRequest();
	}
	catch(e)
	{
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

function ajax(xmlHttp,url,data,doResult)
{
	if(xmlHttp==null)
	{
		alert("请使用IE或者chrome浏览器登录查询！");
	}
	else
	{
		xmlHttp.onreadystatechange=doResult;	
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");	
		xmlHttp.send(data);
	}
	
}

var xmlHttp=getXMLHttpObject();;
function doResult()
{
	if(xmlHttp.readyState==4)
	{		
		alert(xmlHttp.responseText);				
	}	
}

function submit()
{
	if(address.value==""||tel.value==""||customer.value=="")
	{
		alert("联系电话或联系电话或收货地址不能为空！");
	}
	else
	{
		var info="您输入的信息为：\n"+"联系姓名:"+customer.value+"\n"+"联系电话:"+tel.value+"\n"+"送货地址："+address.value+"\n"+"备注:"+note.value+"\n";
		if(confirm(info))
		{
			var url="PHP/mail.php";
			var data="address="+address.value+"&tel="+tel.value+"&customer="+customer.value+"&note="+note.value;
			ajax(xmlHttp,url,data,doResult);
		}		
	}
}

