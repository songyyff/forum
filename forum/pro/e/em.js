
IE=navigator.appName.indexOf("Mi")!=-1
function St(o){for(var t=o,x=0,y=0;o!=null;x+=o.offsetLeft,y+=o.offsetTop,o=o.offsetParent);return{x:x,y:y+t.offsetHeight}}
function C(t){return document.createElement(t)}
function A(o,c){o.appendChild(c)}
F=emfacs
CC=F[0]
CD=F[1]
MC=parent.editMenus.E
W=8
H=1
P=W<<H
Q=parent
var MM,PS,PP,MHR,cT,cP,i,t,c,k

MC.className="floatObj"
MC.style.width=34*W+(IE?8:4)
//A(obj,MC)

A(MC,MHR=IE?parent.img():C("div"))
MHR.className="emHr"
A(MC,MM=C("div"))
MM.className="emTS"
A(MC,CS=C("div"))
CS.className="emCS"
A(MC,PS=C("div"))
PS.className="emPS"
A(MC,c=C("div"))
c.className="emMM"
c.onmousedown=parent.drago

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

function cclass(n){
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
}cclass(0)

function moveHr(){
cT.style.backgroundColor="#EEEEFE"
with(MHR.style){
width=cT.offsetWidth
top=cT.offsetHeight+cT.offsetTop-2
left=cT.offsetLeft+1
}
}setTimeout(moveHr,500)

function cicons(p){
CS.innerHTML=""
for(i=P*p,l=CD.length-1,l=(i+P<l)?i+P:l;i<l;i++){
A(CS,t=new Image())
t.src="../icons/em/"+CC[0]+"/"+CD[i][0]+".gif"
t.title=CD[i][1]
t.d=i
t.onclick=function(){
alert(1)
Q.EW.focus()
Q.document.execCommand("InsertImage",false,"../icons/em/"+CC[0]+"/"+CD[this.d][0]+".gif")
}
t.onmouseover=function(){this.style.borderColor="blue"}
t.onmouseout=function(){this.style.borderColor=""}
}
}cicons(0)

function cpages(n){
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
}cpages(0)
