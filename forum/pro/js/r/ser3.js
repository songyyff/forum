function ckusertype(obj){
}
function cktorp(obj){
var s=true;
if(obj.value==1){
	G("fromtime").disabled=s;
	G("totime").disabled=s;
	G("sectonow").disabled=s;
	G("packnum").disabled=!s;
	G("ftottime").disabled=s;
	G("ftottime1").disabled=s;
}else{
	G("packnum").disabled=s;
	G("ftottime").disabled=!s;
	G("ftottime1").disabled=!s;
	if(G("ftottime").checked) ckftottime(G("ftottime"));
	if(G("ftottime1").checked) ckftottime(G("ftottime1"));
}
}
function ckftottime(obj){
var s=true;
if(obj.value==1){
	G("fromtime").disabled=s;
	G("totime").disabled=s;
	G("sectonow").disabled=!s;
}else{
	G("fromtime").disabled=!s;
	G("totime").disabled=!s;
	G("sectonow").disabled=s;
}
}
if(G("torp").checked) cktorp(G("torp"));
if(G("torp1").checked) cktorp(G("torp1"));

function checkuser(obj){
obj.value=trim(obj.value);
var msg=G("usermsg");
msg.innerHTML="";
if(obj.value.length)
	if(G("usertype").checked) msg.innerHTML=isusername(obj.value)?(obj.value.length>1?"":"用户名长度不够"):"用户名含有非法字符";
	else msg.innerHTML=isnumber(obj.value)?"":"用户id是个数字";
return msg.innerHTML==""?true:false;
}
function checkserstr(obj){
obj.value=trim(obj.value);
var msg=G("serstrmsg");
if(obj.value.length<2){ msg.innerHTML="搜索字符长度必大于2"; return false}
msg.innerHTML="";
return true;
}
function checkftime(obj){
obj.value=trim(obj.value);
var msg=G("fromtimemsg");
msg.innerHTML=""; 
if(G("torp").checked&&G("ftottime").checked)
if(obj.value.length&&!isdate(obj.value)&&!isdatetime(obj.value)){ msg.innerHTML="时间格式不对"; return false; }
return true;
}
function checkttime(obj){
obj.value=trim(obj.value);
var msg=G("totimemsg");
msg.innerHTML=""; 
if(G("torp").checked&&G("ftottime").checked){
	if(obj.value=="现在") return true;
	if(obj.value.length&&!isdate(obj.value)&&!isdatetime(obj.value)){ msg.innerHTML="时间格式不对"; return false; }
}
return true;
}
function checksec(obj){
obj.value=trim(obj.value);
var msg=G("secmsg");
msg.innerHTML=""; 
if(G("torp").checked&&!G("ftottime").checked)
if(!isnumber(obj.value)){ msg.innerHTML="必须是大于零的数字"; return false; }
return true;
}
function checkadd(obj){
obj.value=trim(obj.value);
var msg=G("addmsg");
msg.innerHTML=""; 
if(!G("torp").checked)
if(!isnumber(obj.value)){ msg.innerHTML="必须是大于零的数字"; return false; }
return true;
}

//提交过程
function expandsearch(){
var obj=G("searchdiv"),isobj=G("issearch");
if(obj.style.height==""){
	isobj.innerHTML="+";
	obj.style.height="1px";
}else{
	isobj.innerHTML="-";
	obj.style.height="";
}
}
function setsubforum(){for(var i=0;i<subforums.length;i++)G('forum'+subforums[i]).checked=true;}
function resetpageobj(){
var s=false;
G("usertype").disabled=s;
G("usertype1").disabled=s;
G("seruser").disabled=s;
G("serstr").disabled=s;
G("fromtime").disabled=s;
G("totime").disabled=s;
G("sectonow").disabled=s;
G("packnum").disabled=s;
G("torp").disabled=s;
G("torp1").disabled=s;
G("ftottime").disabled=s;
G("ftottime1").disabled=s;
}
function iscansubmit(){
var ischecked=false;
for(var i=0;i<fms.length;i++) ischecked=G("forum"+fms[i]).checked||ischecked;
if(!ischecked) { alert("您没有选择任何目标论坛，无法查询"); return false;}
var cekrlt=true;
cekrlt=checkserstr(G("serstr"))&&cekrlt;
cekrlt=checkuser(G("seruser"))&&cekrlt;
var obj=G("ftottime");
if(obj.checked&&!obj.disabled){
	cekrlt=checkftime(G("fromtime"))&&cekrlt;
	cekrlt=checkttime(G("totime"))&&cekrlt; 
}
obj=G("ftottime1");
if(obj.checked&&!obj.disabled)	cekrlt=checksec(G("sectonow"))&&cekrlt;
obj=G("torp1");
if(obj.checked&&!obj.disabled)	cekrlt=checkadd(G("packnum"))&&cekrlt;
if(!cekrlt) alert("表单填写有错误，无法查询，请检查查询参数");
return cekrlt;
}
function gotopage(t,p){
var obj=G("mainform");
if(iscansubmit()) {
	resetpageobj();
	obj.action="search.php?type="+t+"&page="+p;
	obj.submit(); 
}
}
function submitform(){
if(iscansubmit()) {
	resetpageobj();
	G("mainform").submit(); 
}
}
