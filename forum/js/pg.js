/*

页面分页函数

*/

function topage(o,e){
if(IE){o=this;e=event}
if(e.keyCode==13){o.value=o.value.replace(/(^\s*)|(\s*$)/g,"");if(/\D/.test(o.value)||o.value==""||o.value==0)alert("页面非法，只能是大于 0 的数字");else document.location.href=Pinfo.u+o.value}
}

//Pinfo={I:1,p:33,R:800,z:20,w:10,u:""}

function Gp(o){
with(Pinfo){
var c=0,l,i,H=Math.floor(w/2),
P=Math.ceil(R/z)

i=P>w?p>H?(P-p)>H?p-H+1:P-w+1:1:1
l=P>w?p>H?(P-p)>H?p+H:P:w:P
s="";

A(o,t=C('table'))
t.cellSpacing=0
t.cellPadding=0
o=t.insertRow(0)

function X(){
t=o.insertCell(c++);
with(t.style){border="1px solid #cccccc";padding=3}
o.insertCell(c++).style.width=1
return t
}

function N(s){X().innerHTML=s}

function a(s,p){
A(X(),t=C('a'))
t.innerHTML=s
t.href=Pinfo.u+p
}

N(((p-1)*z+1)+"/"+(p<P?z:p==P?R-(P-1)*z:0)+"/"+R)

if(P>w)a("[<&lt;",1)

for(;i<=l;i++)i==p?N(i):a(i,i)

if(P>w)a(">>]",P)

N(p+"/"+P)

v=X()
v.style.padding=0
A(v,t=C('input'))
IE?t.onkeydown=topage:t.setAttribute("onkeydown","topage(this,event)")
with(t.style){
border=0
width=40
if(!IE)height=v.offsetHeight-3
margin=0
}
}
}

if(Pinfo.R){
Gp(G('ps1'))
Gp(G('ps2'))
}

//A(G('ps2'),t.firstChild.cloneNode(1))
