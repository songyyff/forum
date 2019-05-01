if(fms.length==1) G('forum'+fms[0]).checked=true;
G('forumlist').style.height=77;
function setforum(s){ for(i=0;i<fms.length;i++) G('forum'+fms[i]).checked=s; }
function ckstype(j){
if(j.checked){
	var s=false,ob=G('sertag'),v=parseInt(j.value);
	if(v){
		var c=G('sertitle');
		if(v==3)c.innerHTML="不填(表示所有)或填一个用户名片段。";else c.innerHTML="不填(表示所有)或只能填一个。";
		G('items').disabled=s;
		G('serht').disabled=s;
		G('serhb').disabled=s;
		G('serstr').disabled=s;
		obj=G('ext0');obj.disabled=s;ckext(obj);
		obj=G('ext1');obj.disabled=s;ckext(obj);
		obj=G('ext3');obj.disabled=s;ckrigt(obj);
	}else{
		resetpageobj(!s);
		setright(s);
		ob.disabled=s;
	}
	if(v==0||v==4)G('sertitle').innerHTML="编号可以同时填写多个，中间以逗号\",\"隔开。";
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
function ckext(obj){
if(obj.checked){
	var s=true,v=parseInt(obj.value),t=G('ftottime'),t1=G('ftottime1');
	if(v==0){
		s=false;
		if(t.checked)ckftottime(t);else ckftottime(t1);
	}else{
		s=true;
		G('fromtime').disabled=s;
		G('totime').disabled=s;
		G('sectonow').disabled=s;
	}
	t.disabled=s;
	t1.disabled=s;
	G('packnum').disabled=v==1?false:true;
}
}
function ckftottime(obj){
var s;
if(obj.value==1)s=true;else s=false;
G('fromtime').disabled=s;
G('totime').disabled=s;
G('sectonow').disabled=!s;
}
function checktag(obj){
obj.value=trim(obj.value);
var msg=G('tagmsg');
msg.innerHTML="";
if(obj.value.length>0){
	if(G('stu').checked)msg.innerHTML=isusername(obj.value)?(obj.value.length>1?"":"用户名长度不够"):"用户名含有非法字符";
	if(G('stui').checked&&!isnumber(obj.value)) msg.innerHTML="用户编号是个数字";
	if(G('stri').checked||G('stii').checked){
		obj.value=obj.value.replace(/(\s*)/g,"").replace(/(,{2,})/g,",").replace(/(^,)|(,$)/g,"");
		if(isnumberstr(obj.value)) msg.innerHTML="编号是个以\",\"隔开的数字序列";
	}
	if(G('stup').checked)msg.innerHTML=obj.value.length>1?(isusername(obj.value)?"":"用户名片段含有非法字符"):"片段太短，至少两字符";
}
return msg.innerHTML==""?true:false;
}
function checkserstr(obj){
return true;
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
var mustnum="必须是大于零的数字";
function checksec(obj){
obj.value=trim(obj.value);
var msg=G('secmsg');
msg.innerHTML="";
if(!obj.disabled&&!isnumber(obj.value)){msg.innerHTML=mustnum;return false;}
return true;
}
function checkpack(obj){
obj.value=trim(obj.value);
var msg=G('packmsg');
msg.innerHTML="";
if(!obj.disabled&&!isnumber(obj.value)){msg.innerHTML=mustnum;return false;}
return true;
}


function addtomng(v){var subwin=window.open("rtomng.php?rid="+v,"rmng","height=550,width=720");}
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
var pobjs=new Array('serht','serhb','items','sertag','serstr','fromtime','totime','sectonow','packnum','ext0','ext1','ext3','ftottime','ftottime1','rtequ','rtand','rnot');
function resetpageobj(s){for(var i=0;i<pobjs.length;i++) G(pobjs[i]).disabled=s;}
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
ckstype(G('stri'));
ckstype(G('stu'));
ckstype(G('stui'));
ckstype(G('stup'));
ckstype(G('stii'));
function iscansubmit(){
var ischecked=false;
for(var i=0;i<fms.length;i++)ischecked=G('forum'+fms[i]).checked||ischecked;
if(!ischecked){alert("您没有选择任何目标论坛，无法查询");return false;}
var ckr=true;
ckr=checktag(G('sertag'))&&ckr;
ckr=checkserstr(G('serstr'))&&ckr;
ckr=checkftime(G('fromtime'))&&ckr;
ckr=checkttime(G('totime'))&&ckr;
ckr=checksec(G('sectonow'))&&ckr;
ckr=checkpack(G('packnum'))&&ckr;
if(!ckr) alert("表单填写有错误，无法查询，请检查查询参数");
return ckr;
}
function exprows(){
var l,k,j,i;
l=G('eprs');k="[+]";j="";
if(l.innerHTML==k)k="[-]";else j="1px";
l.innerHTML=k;
for(i=0;i<irows;i++){G('li'+i).innerHTML=k;G('cdiv'+i).style.height=j;}
}
for(i=0;i<irows;i++){
G('li'+i).innerHTML="[+]";
o=G('cdiv'+i);
o.style.height="1px";
o.style.visibility="visible";
}
function exprow(n){
var o=G('li'+n);
var c=G('cdiv'+n);
if(o.innerHTML=="[+]"){
	o.innerHTML="[-]";
	c.style.height="";
}else{
	o.innerHTML="[+]"
	c.style.height="1px";
}
}
function submitform(){
if(iscansubmit()) {
	resetpageobj(false);
	G('mainform').submit();
}
}
