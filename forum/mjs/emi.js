
/* 表情类 emi.js */

function emclass(obj){

function C(t){return document.createElement(t)}
function A(o,t){o.appendChild(t)}
function St(o){for(var t=o,x=0,y=0;o!=null;x+=o.offsetLeft,y+=o.offsetTop,o=o.offsetParent);return{x:x,y:y+t.offsetHeight}}

var F=emfacs,
CC=F[0],
CD=F[1],
cT,cP,
MC=C('div'),
MM,PS,PP,MHR,
i,t,c,k,
W=8,
H=1,
P=W<<H

MC.className="floatObj"
MC.style.width=34*W+(IE?8:4)
A(obj.parentNode.parentNode,MC)
A(MC,MHR=IE?new Image():C("div"))
MHR.className="emHr"
A(MC,MM=C("div"))
A(MC,CS=C("div"))
A(MC,PS=C("div"))
A(MC,c=C("div"))
c.className="emMM"
MM.className="emTS"
CS.className="emCS"
PS.className="emPS"
MM.innerHTML=(F.length>7?"<a href=javascript:; id=tta>><a href=javascript:; id=tta>&lt;</a>":"")+"<span>"

var TS=MM.lastChild

if(F.length>7){
i=MM.firstChild
i.onclick=function(){
var t
if(F.length-3>(t=TS.lastChild.p)){
cclass(t=t+2)
CC=F[t]
CD=F[++t]
cicons(0)
cpages(0)
}
return false
}
i.nextSibling.onclick=function(){
var t
if(t=TS.firstChild.p){
cclass(t=t-6)
CC=F[t]
CD=F[++t]
cicons(0)
cpages(0)
}
return false
}
}

(function cclass(n){
var t,i,l,n
TS.innerHTML=""
for(i=n,l=F.length-1,l=(n+6<l)?n+6:l;i<l;i+=2){
A(TS,t=C("a"))
t.href="javascript:;"
t.innerHTML=F[i][1]
t.p=i
t.onclick=function(){
if(cT!=this){
cT.style.backgroundColor="white"
cT=this
CC=F[this.p]
CD=F[this.p+1]
cicons(0)
cpages(0)
moveHr()
}
return false
}
}
cT=TS.firstChild
moveHr()
})(0)

function moveHr(){
cT.style.backgroundColor="#EEEEFE"
with(MHR.style){
width=cT.offsetWidth
top=cT.offsetHeight+cT.offsetTop-2
left=cT.offsetLeft+1
}
}
setTimeout(moveHr,500)

(function cicons(p){
CS.innerHTML=""
for(i=P*p,l=CD.length-1,l=(i+P<l)?i+P:l;i<l;i++){
A(CS,t=new Image())
t.src="../icons/em/"+CC[0]+"/"+CD[i][0]+".gif"
t.title=CD[i][1]
t.onclick=function(){}
t.onmouseover=function(){this.style.borderColor="red"}
t.onmouseout=function(){this.style.borderColor=""}
}
})(0)

(function cpages(n){
PS.innerHTML=""
var i,k,l,t
for(i=0,l=Math.ceil((CD.length-1)/P);i<l;i++){
A(PS,t=C("a"))
if(n==i){t.style.backgroundColor="#EEEEFE";cP=t}
t.href="javascript:;"
t.innerHTML=i+1
t.onclick=function(){
if(cP!=this){
cP.style.backgroundColor="white"
cP=this
cP.style.backgroundColor="#EEEEFE"
cicons(this.innerHTML-1)
}
return false
}
}
})(0)

obj.onmouseover=function(){
var t=St(obj)
with(MC.style){
top=t.y
left=t.x-MC.offsetWidth+obj.offsetWidth
visibility="visible"
}
}

/*
obj.onmouseout=function(){
with(MC.style){
visibility="hidden"
top=0
left=0
}
}
*/

}

emclass(G('demo'))