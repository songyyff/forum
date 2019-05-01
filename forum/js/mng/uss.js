//<SCRIPT language="JavaScript">
G('forumlist').style.height=51;
function selschboxs(s){
var i,os=document.getElementsByName('schboxs[]');
for(i=0;i<os.length;i++)os.item(i).checked=s;
}
function setforum(s){ for(i=0;i<fms.length;i++) G('forum'+fms[i]).checked=s; }
function ckstype(j){
	if(j.checked){
		var i,s=false,ob=G('sertag'),c=G('sertitle'),obj=G('ext3');
		if((i=parseInt(j.value))==2){
			G('state').disabled=s;
			G('sex').disabled=s;
			G('level').disabled=s;
			G('fromtime').disabled=s;
			G('totime').disabled=s;ckrigt(obj);
			obj.disabled=s;
		}else{
			resetsearchobj(!s);
			setright(s);
			ob.disabled=s;
		}
		c.innerHTML=i?"不填(表示所有)或填一个用户名"+(i==1?"。":"片段。"):"编号可以填写一个或多个，中间以逗号\",\"隔开。"
		ob.focus();
	}
}
function ckrigt(obj){
	var s=!obj.checked;
	G('rtequ').disabled=s;
	G('rtand').disabled=s;
	G('rnot').disabled=s;
	setright(!s);
}
function checktag(obj){
	obj.value=trim(obj.value);
	var msg=G('tagmsg');
	msg.innerHTML="";
	if(obj.value.length>0){
		var z=G('stui')
		if(z.checked||G('stu').checked){
			obj.value=obj.value.replace(/(\s*)/g,"").replace(/(,{2,})/g,",").replace(/(^,)|(,$)/g,"");
			if(z.checked){
				if(isnumberstr(obj.value))msg.innerHTML="编号是个以\",\"隔开的数字序列";
			}else if(!isusernames(obj.value))msg.innerHTML="是个以\",\"隔开的名字序列";
		}
		if(G('stup').checked)msg.innerHTML=obj.value.length>1?(isusername(obj.value)?"":"用户名片段含有非法字符"):"片段太短，至少两字符";
	}
	return msg.innerHTML==""?true:false;
}
function checkftime(obj){
	obj.value=trim(obj.value);
	var msg=G('fromtimemsg');
	msg.innerHTML="";
	if(!obj.disabled&&obj.value.length&&!isdate(obj.value)&&!isdatetime(obj.value)){ msg.innerHTML="时间格式不对"; return false; }
	return true;
}
function checkttime(obj){
	obj.value=trim(obj.value);
	var msg=G('totimemsg');
	msg.innerHTML="";
	if(!obj.disabled&&obj.value.length&&!isdate(obj.value)&&!isdatetime(obj.value)){ msg.innerHTML="时间格式不对"; return false; }
	return true;
}
//---------------------------------------------------
function expandsearch(){
	var obj=G('searchdiv');
	var isobj=G('issearch');
	if(obj.style.height==""){
		isobj.innerHTML="[+]";
		obj.style.height="1px";
	}else{
		isobj.innerHTML="[-]";
		obj.style.height="";
	}
}
var pobjs=new Array('state','level','sex','sertag','fromtime','totime','ext3','rtequ','rtand','rnot');
function resetsearchobj(s){for(var i=0;i<pobjs.length;i++) G(pobjs[i]).disabled=s;}
function setright(s){
	var i,v,t,r=G('right').value;
	for(i=0;i<r.length;i++){
		v=r.charCodeAt(i);
		t=v!=48?(v==49?"有":"否"):"无效";
		G('ritd'+i).innerHTML=s?"<a class=goldlink href=\"javascript:cksright("+i+")\">"+t+"</a>":t;
	}
}
function cksright(i){
	var r=G('right'),v=(r.value.charCodeAt(i)-47)%3;
	r.value=r.value.substr(0,i)+v+r.value.substr(i+1,r.value.length-i-1);
	G('ritd'+i).innerHTML="<a class=goldlink href=\"javascript:cksright("+i+")\">"+(v!=0?(v==1?"有":"否"):"无效")+"</a>";
}
ckstype(G('stu'));
ckstype(G('stui'));
ckstype(G('stup'));
function isserchsubmit(){
	var ckr=true;
	ckr=checktag(G('sertag'))&&ckr;
	ckr=checkftime(G('fromtime'))&&ckr;
	ckr=checkttime(G('totime'))&&ckr;
	if(!ckr) alert("查询表单填写有错误，无法查询，请检查查询参数");
	return ckr;
}
/*function submitform(){
	if(iscansubmit()) {
		resetsearchobj(false);
		G('mainform').submit();
	}
}
*/
function S(v){return document.styleSheets.item(0).rules[v].style;}
if(IE)for(i=0;i<6;i++)S(i).paddingBottom="0px";
