
function G(i){return document.getElementById(i)}
function C(t){return document.createElement(t)}
function A(o,c){o.appendChild(c)}
function lt(s){return typeof(s)=="String"?s.replace(/</g,"&lt;"):s}

function openbox(t){
var d=t.d
with(G('debug').style){
visibility=d?"hidden":"visible"
position=d?"absolute":"fixed"
}
D.style.height=d?370:200
t.d=!d
}

var fU=G('func'),fI=fU.firstChild,fS=fU.lastChild,
fileDisabled=fS.disabled=Dend=1,
Dels,upfiles=[],rpfiles=[],rpI,curI=D,timeID,delNum=Num=cP=Wk=0,cellS=[],
upS=G('singleupload'),upF=G('lastupload'),D=G('Ddiv'),P=parent,V=P.Aview,vI=V.firstChild,okV=0,
F=P.atts,W=P.editMenus.A,
cN=D.previousSibling.lastChild
Sc=P.Sc
Ec=P.Ec

P.checkatt=function(){var i,k,n
for(i=1;n=D.childNodes[i++];){k=n.childNodes
if(k[1].nodeName=='#text'||k[2].nodeName=='#text'||n.className=='delrow'){
P.centerWin(W,2)
alert("附件中存在未完成操作，不能完成提交。\n请处理完成后再尝试提交！")
return 1}}}

if(P.vT&1)mID=P.sID
else{if(!P.tID)P.tID=new Date().getTime()&0xFFFFFFF
mID=P.sID.toString()+","+P.tID}

G('doview').onclick=function(){
okV=!okV
this.innerHTML=okV?"取消":"预览"
}

fS.onclick=function(){
var t,i=curI,d=i.d
if(d[0]<0){
D.removeChild(i)
upF.del(d[3][2])
delete d
fU.style.top=-100
}else if(Dend){
fS.value=d[2]?"删除":"取消"
t=d[2]=!d[2]
i.className=t?"delrow":""
delNum+=t?1:-1
fileDisabled=t
}else alert("正在删除操作，不可标记文件。")
}

with(V.style)width=height=W.offsetHeight
V.onmouseover=hold
V.onmouseout=pout
vM=V.clientWidth-12

fE={flv:'A',f4v:'A',mp4:'A',ogg:'B',webm:'B',mp3:'a'}
function fixN(s){return s.length&1?"0"+s:s}
function r(){var i=curI.d[0]*6,c=fE[e=F[i+1].substr(F[i+1].lastIndexOf(".")+1).toLowerCase()],h=(c?':'+c:"")+"../uploads/"+F[i]
P.EW.focus()
if(F[i+3].substr(0,2)=="i/")P.insImg(h+"."+F[i+1].replace(/[\x00-\x1f\x7f]/g,function(c){return"%"+fixN(c.charCodeAt(0).toString(16))}))
else P.document.execCommand("CreateLink",false,h)}

function vIload(){
vI.onload=null
var w=vI.clientWidth,h=vI.clientHeight
with(vI.style)if(w>h){if(h>vM){height="100%";width=vM/h*w}}else if(w>vM){width="100%";height=vM/w*h}
DB(w+","+h)
}

function hold(){if(timeID){clearTimeout(timeID);timeID=0}}
function pin(){
with(fU.style){top=this.offsetTop;width=78;height=22}
hold()
var t=this,d=t.d,a,b

//if(curI!=t){
if(curI)curI.style.borderColor=""
if(okV)if(!d[1]&&F[d[0]*6+3].substr(0,2)=="i/"){
a=W.style
b=V.style
b.top=a.top
b.left=parseInt(a.left)-V.offsetWidth
V.removeChild(vI)
delete vI
P.A(V,vI=P.newImg())
vI.onload=vIload
vI.src="../uploads/"+F[d[0]*6]
}else V.style.top=-1000
//}

if(t.lastChild.d&&!d[4]){
if(d[0]>=0&&d[3])t.className=""
t.removeChild(t.lastChild)
t=t.firstChild
t.removeChild(t.firstChild)
}
t.style.borderColor=Sc
fileDisabled=d[2]
fI.setTxt(d[1]||d[4]?"取消":"替换")
fS.disabled=d[1]
fS.value=d[2]?"取消":"删除"
curI=this
}
function pout(){timeID=setTimeout(outi,200)}

for(i=0,n=F.length/6;i<n;i++)if(F[p=i*6]){
Num++
A(D,t=C('p'))
t.innerHTML="<b>"+formatNum(F[p+4])+" B</b><a href=javascript:; onmouseover=hold() onclick=r()>"+lt(F[p+1])+"</a><span>"+lt(F[p]+" "+F[p+5])
t.d=[i,0]

t.onmouseover=pin
t.onmouseout=pout

}

cN.innerHTML=Num
upF.ini(Num,s="a"+document.cookie.replace(/;\s*/g,"&a"))
upS.ini(s)

fU.onmouseover=hold

//document.body.style.visibility="visible"

function outi(){
with(fU.style)height=width=0
curI.style.borderColor=""
fileDisabled=fS.disabled=1
V.style.top=-1000
}

function formatNum(i){
var r,s=i.toString()
i=s.length-3
r=s.substr(i,3)
for(;i-3>0;i-=3)r=s.substr(i-3,3)+","+r
return (i>0?s.substr(0,i)+",":"")+r
}

function checkI(){
rpI=curI
var p,d=rpI.d
if(d[5])return 1
if(d[4]){
((p=d[0]<0)?upF:fI).cancelUp(p?d[3][2]:d[3][0])
d[4]=0
return 1
}
if(d[1]){
rpI.innerHTML="<b>"+formatNum(F[(p=d[0]*6)+4])+" B</b><a href='javascript:;' onmouseover=hold() onclick=r()>"+lt(F[p+1])+"</a><span>"+lt(F[p]+" "+F[p+5])
rpI.className=""
d[1]=0
fI.setTxt("替换")
fileDisabled=fS.disabled=0
fI.del(d[3][0])
rpfiles[d[3][0]]=0
delete d[3]
return 1
}
if(fileDisabled||d[0]<0||d[2])return 1
}

function upfileNew(i,m,n,s,p,d){
var t
V.style.top=-1000
if(m){
rpfiles[i]=t=rpI
t.d[3]=[i,m,n,s,p,d]
if(curI==rpI){fI.setTxt("取消");fileDisabled=0;fS.disabled=1}
t.d[1]=1
//rpI=0
fI.setID(i,F[t.d[0]*6])
}else{
A(D,t=C('p'))
upfiles[i]=t
t.onmouseout=pout
t.onmouseover=pin
t.d=[-1,0,0,[n,s,i]]
}
t.innerHTML="<b>"+formatNum(s)+" B</b>"+lt(n)+"<span>"+(m?parseInt(F[t.d[0]*6]):"-1")+" "+d
t.className="uprow"
t.lastChild.d=0
return 1
}

function upfileOpen(i,m){
var p,t,r=m?rpfiles[i]:upfiles[i]
if(!r.lastChild.d){
A(r,t=C('span'))
t=new Image()
p=r.firstChild
p.insertBefore(t,p.firstChild)
r.d[4]=1
DB("开始上传文件 "+lt(r.d[0]<0?r.d[3][0]:r.d[3][2]))
}
r.lastChild.innerHTML="0%"
r.lastChild.d=1
}

function upfileProgress(i,m,d,a){
var p,n=m?rpfiles[i]:upfiles[i]
n.firstChild.firstChild.style.width=Math.ceil((p=d/a)*(n.offsetWidth-2))
n.lastChild.innerHTML=Math.ceil(p*100)+"%"
}

Es=["HTTP","IO","Security"]
function upfileError(i,m,t,s){
var p,n=m?rpfiles[i]:upfiles[i]
n.lastChild.innerHTML+=" upfile "+Es[t]+" Error:"+lt(s)
n.style.backgroundColor=Ec
n.d[4]=0
DB("上传文件 "+lt(n.childNodes[1].data)+" <u>失败</u>。传送进度 "+lt(n.lastChild.innerHTML))
//n.lastChild.d=1
}

function upfileComplete(i,m){
var n=m?rpfiles[i]:upfiles[i]
n.firstChild.firstChild.style.width=n.offsetWidth-2
n.lastChild.innerHTML="100%"
n.d[5]=1
}

function upfileCompleteData(i,m,d){
var p,a=m?rpfiles[i]:upfiles[i],c=d.charAt()
if(c>'0'&&c<':'){
d=d.split(".")
a.lastChild.d=1
a.d[1]=a.d[5]=a.d[4]=0
DB("上传文件 "+lt(a.childNodes[1].data)+" 成功")
if(m){
a.d[1]=0
c=a.d[3]
p=a.d[0]*6
F[p+2]=0
F[p+3]=d[1]
F[p+5]=d[0]
F[p+1]=c[2]
F[p+4]=c[3]
a.d[3]=1
}else{
cN.innerHTML=++Num
p=F.length
c=a.d[3]
F[p]=d[2]
F[p+1]=c[0]
F[p+2]=0
F[p+3]=d[1]
F[p+4]=c[1]
F[p+5]=d[0]
a.d=[p/6,0,0,1]
}
delete c
a.replaceChild(t=C('a'),a.childNodes[1])
t.href="javascript:;"
t.innerHTML=lt(F[p+1])
t.onmouseover=hold
t.onclick=r
a.childNodes[2].innerHTML=lt(F[p]+" "+d[0])
}else{
DB("上传文件: "+lt(a.childNodes[2])+" <U>失败</U>. "+lt(d))
if(m)a.d[4]=a.d[5]=0
}
}

function DB(s){var d;debug.innerHTML+="<b>"+(d=new Date()).getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.toLocaleTimeString()+":</b> "+s+"。<br>"
debug.scrollTop=1000000}

function Cancel(){W.style.top=-1000}
function OK(){
var t,i,c=s="",d
delete Dels
Dels=[]
if(Dend&&delNum){
Dend=0
for(i=1,d=D.childNodes;i<d.length;i++)if((t=d[i].d)[2]){
Dels.push(d[i])
s+=","+F[t=t[0]*6]
c+=", "+F[t+1]
}
DB("删除文件"+lt(c.substr(1)))
}
fI.upload(P.vT,mID)
upF.upload(P.vT,mID,s,delNum)
}

function delUps(s){
if(s)DB("文件删除<u>失败</u>："+lt(s))
else{
for(i=0;i<Dels.length;i++){
var d=Dels[i].d
D.removeChild(Dels[i])
F[d[0]*6]=0
cellS[cP++]=d[0]
}
fU.style.top=-100
DB("文件删除成功")
cN.innerHTML=Num-=delNum
delNum=0
}
Dend=1
}