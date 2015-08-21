function reset()
{
	ip1.value="";
	ip2.value="";
	ip1.focus();
	delRow(tb1);
	delRow(tb2);
	tb1.style.display="none";
	tb2.style.display="none";
	tip.innerHTML="完成重置，请重新输入！";
}

function addRow(t,arr)
{
	var rowCount=t.rows.length;
	var row=t.insertRow(rowCount);
	rowCount++;
	var cellCount=t.rows.item(0).cells.length;
	for(var i=0;i<cellCount;i++)
	{
		var cell=row.insertCell(i);
		cell.innerHTML=arr[i];
	}
}

function delRow(t)
{
	var rowCount=t.rows.length;
	while(rowCount>1)
	{
		t.deleteRow(rowCount-1);
		rowCount--;
	}
	
}

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
		try
		{
			var info=eval(xmlHttp.responseText);
			var arr1=new Array();
			var arr2=new Array();
			for(var i=0;i<13;i++)
			{
			arr1[i]=info[i];
			arr2[i]=info[i+13];
			}
			addRow(tb1,arr1);
			addRow(tb2,arr2);
			tb1.style.display="block";
			tb2.style.display="block";
			tip.innerHTML="查询完成！<br/>(如果结果不完整，网络传输过程出现丢失，请重新查询！)";
		}
		catch(e)
		{
			tip.innerHTML=xmlHttp.responseText;
		}		
	}	
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
		delRow(tb1);
		delRow(tb2);
		tb1.style.display="none";
		tb2.style.display="none";
		var url="dop.php";
		var data="sid="+ip1.value+"&uid="+ip2.value;
		ajax(xmlHttp,url,data,doResult);
		
	}
}