/* 
mng/sbgs.php 脚本
2011.3
*/

ubgs=[]
function fbg(s){for(var i=0;i<ubgs.length;i++)if(ubgs[i]==s)return 0;return 1}

function start(){
function ini(H,D,x){

function Gt(i){var o;return (o=D.childNodes[i].firstChild)?o:C("i")}
function Tx(s){A(t,document.createTextNode(s))}

H.innerHTML="<table width=100% style=table-layout:fixed cellspacing=0 cellpadding=5><th width=30><th width=30><th width=120>徽章<th>说明<tbody id=utb"+x+">"
M=G("utb"+x)
for(i=0;o=D.childNodes[i];i+=3+x){
M.appendChild(r=document.createElement("tr"))
r.c=r.insertCell
r.d=d=o.firstChild.data.split(",")

t=r.c(0);

A(t,Gt(i+1))
A(t,C("br"))

if(x){
ubgs[i]=d[2]
Tx("颁奖人：")
A(t,o=C('a'))
o.href="userinfo.php?userid="+d[3]
A(o,Gt(i+4))
A(t,C("br"))
Tx("授奖贺词：")
A(t,Gt(i+2))
A(t,C("br"))
Tx("获奖感言：")
A(t,Gt(i+3))
}else A(t,Gt(i+2))

t=r.c(0);
t.innerHTML="<img onmouseover=im(this) onmouseout=io(this) src=../icons/bg/"+d[2]+".gif>"
t.firstChild.d=d[2]

t=r.c(0);
t.innerHTML=d[1];

t=r.c(0)
t.innerHTML=x||fbg(d[2])?"<input type=checkbox name="+(x?"altbg":"givebg")+"[] onclick="+(x?"altbg":"give")+"(this) value="+d[0]+">":"&nbsp;"
if(x){t.firstChild.r=d[3];t.style.backgroundColor=d[3]&2?"red":d[3]&1?"blue":""}
}
}

ini(G('userbgs'),uData,2)
ini(G('sysbgs'),sData,0)

}

start()

function im(o){s=o.src
o.className='b'
o.src="../icons/bg/b/"+o.d+".gif"}
function io(o){o.src=s}

function altbg(o){
var e=o.parentNode.parentNode.lastChild;
if(o.checked){
if(!o.d){
o.d=d=C("div")
d.innerHTML="颁奖<br><input type=text style=width:"+(screen.width-500)+" name=ucom[] maxlength=500><br><input type=radio name=dis"+o.value+" value=0"+(o.r&2?"":" checked")+">有效 <input type=radio name=dis"+o.value+" value=1"+(o.r&2?" checked":"")+">失效 <input type=checkbox name=del[] value="+o.value+">删除"
}
A(e,o.d)
}else e.removeChild(o.d)
}

function give(o){
var e=o.parentNode.parentNode.lastChild
if(o.checked){
if(!o.d){o.d=d=C("input")
d.type="text"
d.maxLength=500
d.name="scom[]"
d.style.width=screen.width-500}
A(e,o.d)
}else e.removeChild(o.d)
}

function submit(){
document.forms[0].submit()
}