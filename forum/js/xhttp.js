//<script language="JavaScript">
function _createObj(){
	if (window.XMLHttpRequest) var objXMLHttp = new XMLHttpRequest();
	else {
		var MSXML = ['MSXML2.XMLHTTP.5.0', 'MSXML2.XMLHTTP.4.0', 'MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP', 'Microsoft.XMLHTTP'];
		for(var n = 0; n < MSXML.length; n ++){
			try{
				var objXMLHttp = new ActiveXObject(MSXML[n]);
				break;
			} catch(e) {}
		}
	}
	// mozilla某些版本没有readyState属性
	if (objXMLHttp.readyState == null){
		objXMLHttp.readyState = 0;
		objXMLHttp.addEventListener("load", function (){
			objXMLHttp.readyState = 4;
			if (typeof objXMLHttp.onreadystatechange == "function") objXMLHttp.onreadystatechange();
		} , false );
	}
	return objXMLHttp;
}

var _objXMLHttp = _createObj();

//发送请求(方法[post,get], 地址, 数据, 回调函数)
function _sendReq (method, url, data, callback,d){
	if(_objXMLHttp == null) return false;
	with(_objXMLHttp){
		try{
			open(method, url, true);
			// 设定请求编码方式
			setRequestHeader('Content-Type', 'text/xml; charset=utf-8');
			//setRequestHeader('Http-Accept', 'text/html');
			send(data);
			onreadystatechange = function (){
				if (_objXMLHttp.readyState == 4 && (_objXMLHttp.status == 200 || _objXMLHttp.status == 304)) callback(_objXMLHttp,d);
			}
		} catch(e) {alert(e);}
	}
	return true;
}

function getxmlbody(obj){return obj.responseXML.getElementsByTagName("remsgbody")[0].firstChild.nodeValue; }

//例子   
function _dealresult(obj){
	G('message').value = obj.responseText;
}

function IDRequest(){
	_sendReq("GET","xml.php","",dealresult);
}
//</script>  