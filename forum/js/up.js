//调查表数据
scnewsurvey=sceditsurvey=1;
newsurvey=editsurvey=0;

function N(o,n){var i=0;while(o&&i++<n){o=o.nextSibling;}return o;}
function msnum(v){if(x=!isnumber(v.value)){scTo(v);alert("只能是数字!");v.focus();}return x;}
function scTo(o){for(var y=0;o;y+=o.offsetTop,o=o.offsetParent);scrollTo(0,y-100)}

function isurvey(){
if(scnewsurvey){
	var s=document.createElement("SCRIPT");
	s.type="text/javascript";
	s.src = "../js/pro/suv.js";
	document.body.appendChild(s);
}else issurvey();
}

function esurvey(o){
if(sceditsurvey){
	o.innerHTML="[取消修改]";
	var s=document.createElement("SCRIPT");
	s.type="text/javascript";
	s.src = "../js/pro/suy.js";
	document.body.appendChild(s);
}else{
	if(editsurvey&&!confirm("确定放弃所有修改吗？\n所有调查表的修改将丢失！"))return;
	ebuildsuv();
	o.innerHTML=editsurvey?"[取消修改]":"[修改调查]";
}
}

//提交表单
function orderform(){
	if(newsurvey&&checksuv())return;
	if(editsurvey&&checkesuv())return;
	for(i=0;i<upfilenum;i++){
		newfileobj=G("newupfilename" + i);
		if(newfileobj != null && trim(newfileobj.value)=="")deletenewfile(i);
	}
	var m="提交错误：\n\n";
	if(vtype<3&&G('replaytitle').value.length<1)m+="必须为帖子起一个标题!\n\n";
	if(G('replaycontent').value.length<10)m+="内容长度必须大于10个字符!";
	if(m.length>10)alert(m);
	else G("mainform").submit();
}
//为新上载文件 
function upfilesclass(){
	this.filepath = "";
	this.filename = "";
	this.comment = "";
	this.price = 0;
	this.id = 0;
}
var upfilearray = new Array();
var upfilenum = 0;
var deletedupfilenum = 0;
var upfilefirst="<hr><table id=newfiletable width=100% border=0 cellpadding=5 cellspacing=0><TR height=22 class=bar2><TD width=227 class=bdtb1>&nbsp;文件名(修改)</TD><td class=bdtb1>&nbsp;注释</td><td width=30 class=bdtb1>价格</td><td width=20 align=center class=bdtb1>删</td></TR><tr id=newfiletr" + upfilenum + "><TD width=227><input id=newupfilename" + upfilenum + " name=uploadfiles[] type=file onchange=\"javascript:adduploadfiles()\"></TD><td><input type=text id=newfilecom name=filecom[] class=innewfilecom></td><td><input class=input30 type=text id=newprice0 name=fileprice[] onchange=\"pricechange(0)\" value=0></td><td class=td20><a class=goldlink href=javascript:deletenewfile(" + upfilenum + ")>删</a></td></tr></.table>";

function adduploadfiles(){
	var isf=!IE;
	if(upfilenum){
		newfileobj=G("newupfilename" + (upfilenum-1));
		if(newfileobj == null || newfileobj.value.replace(/(^\s*)|(\s*$)/g,"") != ""){
			var newfiletableobj = G("newfiletable");
			var newfilelist = newfiletableobj.children;
			var filetbody = newfiletableobj.getElementsByTagName("tbody");
			trnew = newfiletableobj.insertRow(-1);
			trnew.setAttribute("id","newfiletr" + upfilenum );
			td1 = trnew.insertCell(-1);
			td1.style.width = 227;
			td2 = trnew.insertCell(-1);
			td3 = trnew.insertCell(-1);
				td4 = trnew.insertCell(-1);
			td4.className="td20"; 
			var x = document.createElement("INPUT");
			x.type = "file";
			x.name = "uploadfiles[]";
			x.setAttribute("id","newupfilename" + upfilenum );
			x.className="innewfilecom";
			if(isf) x.setAttribute("onchange","javascript:adduploadfiles()");
			else x.attachEvent("onchange",adduploadfiles);
			td1.appendChild(x);
			td2.appendChild(x=document.createElement("INPUT"));
			x.type = "text";
			x.name = "filecom[]";
			x.className="innewfilecom"; 
			x.style.width = x.parentNode.offsetWidth-10;
			x=document.createElement("INPUT");
			x.type = "text";
			x.name = "fileprice[]";
			x.value = "0";
			x.className = "input30";
			x.setAttribute("id","newprice" + upfilenum );
			if(isf)x.setAttribute("onchange","javascript:pricechange("+upfilenum+")");
			else x.attachEvent("onchange",new Function("pricechange("+upfilenum+")"));
			td3.appendChild(x);
			x = document.createElement("A");
			x.innerHTML = "删";
			x.href = "javascript:deletenewfile(" + upfilenum + ")";
			x.className = "goldlink";
			td4.appendChild(x);
			upfilenum++;
		}
	}else {
		G("uploadfilesinput").innerHTML = upfilefirst;
		with(G("newfilecom")){style.width=parentNode.offsetWidth;}
		upfilenum++;
	}
}
function pricechange(id){
	var obj=G("newprice"+id);
	obj.value=trim(obj.value);
	regserch = /([^0-9])/;
	var resultarray = regserch.exec(obj.value);
	if(resultarray) { 
		alert("价格输入不合法，只能是数字");
		obj.value = "0"; 
	}
}
function deletenewfile(newfilenum){
	var delrow = G("newfiletr" + newfilenum);
	delrow.parentNode.removeChild(delrow);
	deletedupfilenum++;
	if(deletedupfilenum == upfilenum){
		upfilenum = 0;
		deletedupfilenum = 0;
		G("uploadfilesinput").innerHTML = "";
	}
}

//为已上传文件------------------------
function addalteraction(id){
	//alert(G("addalter" + id).checked);
	var obj = G("adddelete" + id);
	G("adddelete" + id).disabled=G("addalter" + id).checked;
	if(!obj.checked)setalteraction(id);
}
function setalteraction(id){
	var addcomobj = G("addcom" + id),
	addalterobj = G("addalter" + id),
	addpriceobj = G("addprice" + id);
	if(addalterobj.checked){
		addcomobj.innerHTML = "<input type=text class=addcominput id=inputaddfilecom" + id + " name=addfilecom" + id + " value=\""+fquot(addcomobj.innerHTML)+"\">" ;
		addpriceobj.innerHTML = "<input type=text class=input30 id=inputaddfileprice" + id + " name=addfileprice" + id + " value=\"" + parseInt(addpriceobj.innerHTML) + "\"  onchange=\"pricechange(this)\">" ;
		with(addcomobj){
			firstChild.style.width=offsetWidth-50;
		}
	}else{
		addcomobj.innerHTML = rpspc(G("inputaddfilecom" + id).value);
		addpriceobj.innerHTML = rpspc(G("inputaddfileprice" + id).value);
	}
}
function adddeleteaction(id){
	var addalterobj = G("addalter" + id),
	addfilenameobj = G("addfilename" + id)
	adddel=G("adddelete" + id);
	addalterobj.disabled=adddel.checked;
	if(adddel.checked){
		if(addalterobj.checked){
			addalterobj.checked = false;
			setalteraction(id);
		}
		//G("addalter" + id).disabled = true;	
		regserh = />(.*)</;
		regserh.exec(addfilenameobj.innerHTML);
		addfilenameobj.innerHTML = RegExp.$1;
	}else{
		addfilenameobj.innerHTML = "<a class=goldlink href=\"javascript:ei.Attach(" + id + ")\">" + addfilenameobj.innerHTML + "</a>";
	}
}