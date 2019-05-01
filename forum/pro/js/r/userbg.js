
bgD=G('ubgs')
bgP=bgD.parentNode.nextSibling
bgD=bgD.childNodes

A(document.getElementsByTagName("head")[0],s=C('link'))
s.type="text/css"
s.rel="stylesheet"
s.href="../theme/"+bgD[0].data+"/userbg.css"
s.onload=function(){

for(i=1;o=bgD[i];i+=5){
o.d=o.lastChild.data.split(",")
A(bgP,r=C("img"))
r.src="../icons/bg/"+o.d[1]+".gif"
r.d=i
r.onmouseover=function(){
var o=this,i=this.d,d=bgD[i].d
if(o!=bSel){
bI.src="../icons/bg/B/"+d[1]+".gif"
bU.href="?userid="+d[0]
bU.lastChild.data=bC(i+1)
bN.data=bC(i+2)
bQ.data=bC(i+3)
bA.data=bC(i+4)
bT.data=d[2]
o.className="bsel"
bSel.className=""
bSel=o
}}
}
function bC(i){return (o=bgD[i].firstChild)?o.data:""}

A(bgP,bS=C("div"))
bS.innerHTML="<table class=bS><tr><td width=80><img id=bImg><td><pre id=bPre><u>颁奖人：<a>I</a></u><b>名称</b>\n<i>授奖贺词: </i>I<br><i>获奖感言: </i>I<br><br><i>I"
bI=G('bImg')
bP=G('bPre').childNodes
bU=bP[0].lastChild
bN=bP[1].lastChild
bQ=bP[4]
bA=bP[7]
bT=bP[10].lastChild
bSel=0
r.onmouseover()

}