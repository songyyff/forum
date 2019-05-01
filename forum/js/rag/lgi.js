/*
登陆脚本 rag/login.php
*/

function cr(o){
var i,r=o.parentNode.insertRow(-1)
for(i=0;i<2;i++)r.insertCell(0)
r.title="错误信息"
r.lastChild.style.color="red"
return r
}

function msg(o,s){
var m,t
o=o.parentNode.parentNode
if(m=o.nextSibling){if(m.title!="错误信息"&&s){o.parentNode.insertBefore(t=cr(o),m);m=t}}else if(s)m=cr(o)
if(s)m.lastChild.innerHTML=s
else
if(m&&m.title=="错误信息")o.parentNode.removeChild(m);
return !s
}

function checkpass(o){return msg(o,(o.value=trim(o.value)).length<6?"密码长度至少6位":isusername(o.value)?"":"密码含有非法字符,只能是ASCII字符数字和汉字")}

function checkname(o){return msg(o,(o.value=trim(o.value)).length<2?"必须填写名字,长度至少2字符":isusername(o.value)?"":"名字含有非法字符,只能是ASCII字符数字和汉字")}

function submitform(){
if(checkname(G("username"))&&checkpass(G("userpass"))) G("mainform").submit();
else alert("表单填写有错误，无法提交，请检查错误");
}
function clearinfo(){G("resultinfo").innerHTML="";}
