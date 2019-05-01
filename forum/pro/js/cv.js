/*
view.php
*/

function Img(){return new Image()}
function tagAImgLoad(o,w){tagImgLoad(o,w);with(o.parentNode)if(offsetHeight>150)with(style){overflowY="hidden";height=150}}

briefI=toBri=Bc=Ec=Sc=0
function brief(t){
if(!vR){alert("由于帖子权限，无法回复");return}
if(!briefI){briefI=1;var o=C('script');o.type="text/javascript";o.src="e/r.js";A(B,o)
}else if(toBri)toBri();return false}
function pgtoR(t){t.parentNode.removeChild(t);brief()}
//分页函数
function topage(o,e){if(IE){o=this;e=event}if(e.keyCode==13){o.value=trim(o.value);if(/\D/.test(o.value)||o.value==""||o.value==0)alert("页面非法，只能是大于 0 的数字");else document.location.href="?noteid="+pageInfo.I+"&page="+o.value}}

function GPT(o){o.style.padding="1 0 1"
with(pageInfo){var P=Math.ceil(R/r),i,l,D=I,h=Math.floor(w/2)
p=p>P?P:p
if(P>w){
 	if(p>h)
		if((P-p)>h){i=p-h+1;l=p+h}
		 else{i=P-w+1;l=P}
	else{i=1;l=w}
}else{i=1;l=P}

A(o,t=C('table'))
t.cellSpacing=t.cellPadding=c=0
o=t.insertRow(0)

function X(){t=o.insertCell(c++);with(t.style){border="1px solid #cccccc";padding=3}o.insertCell(c++).style.width=1;return t}
function N(s){X().innerHTML=s}
function a(s,p){A(X(),t=C('a'));t.innerHTML=s;t.href="?noteid="+D+"&page="+p}
N(((p-1)*r+1)+"/"+(p==P?R-(P-1)*r:r)+"/"+R)
if(P>w)a("[<&lt;",1)
for(;i<=l;i++)i==p?N(i):a(i,i)
if(P>w)a(">>]",P)
N(p+"/"+P)
v=X()
v.style.padding=0
A(v,t=C('input'))
IE?t.onkeydown=topage:t.setAttribute("onkeydown","topage(this,event)")
}with(t.style){border=0;width=40;height=v.offsetHeight-4;margin=0}}

function H(o){A(o,t=C('div'));t.innerHTML="<a href=javascript:; onclick=pgtoR(this)>快速</a><a href=edit.php?actionid="+pageInfo.I+"&type=2>回复帖子</a>";with(t.style){padding=3;border="1px solid #cccccc";if(IE)styleFloat="right";else cssFloat="right"}}
if(info.length-2){
H(tT=G('pgs1'))
GPT(tT)
H(tT=G('pgs2'))
GPT(tT)}

//页面调转函数
function getsubs(d){window.open("getsubs.php?noteid="+d,"def","height=200,width=300");return 0}

//页面初始化函数
Fs=[function(){window.open("../mng/utomng.php?uid="+info[this.i][1][0],"umng","height=550,width=450")},
function(){var i=this.i;window.open((i?"../mng/rtomng.php?rid=":"../mng/itomng.php?iid=")+info[i][0][0],
i?"rmng":"imng",
"height=550,width=720")},
function(){var i=this.i;location="edit.php?actionid="+info[i][0][0]+"&type="+(i?"3&extra="+info[0][0][0]+"p"+pageInfo.p+"s"+i:"1&page="+pageInfo.p);return false},
brief,
function(){scrollTo(0,0)}
]

unLanI=0
unLans=[]
cvLan={}
Os={}

//名片
A(B=document.body,PL=C('iframe'))
PL.className="hcar"
PL.allowTransparency=true
PL.src="../images/head.htm"
PL.onmouseout=function(){PL.style.top=-300}
PL.N=C
//徽章
A(BS=C("b"),BT=C('tt'));A(BS,C('br'));A(BS,BI=C('img'));BS.className='b'
with(BS.style){padding=5;textAlign='center';position='absolute';top=0;backgroundColor='white';visibility='hidden'}
A(B,BS)
function So(o,t){if(o.getAttribute(t?o.d?'title':'href':'src',2).substr(0,11).toLowerCase()=="../uploads/")o.className=t?"Ia":"Iimg"}
function ini(){var nf=["加人","加贴","编辑","回复","TOP"],
Tc=['white','red','yellow','blue'],
MW,
N,t,d,r,x,o,k,atc,hc,i=0,e,n,l=info.length-1

while(N=info[i++]){
r=i>2?r.nextSibling:G(i&1?"im":"rs").firstChild.firstChild
o=r.lastChild

t=r.firstChild.lastChild.firstChild
t.n=i-1
N[1][1]=r.firstChild.firstChild.childNodes[1].firstChild.data.replace(/</g,"&lt;")
t.onmouseover=function(){
var y=0,t=PL.d=this
for(;t;t=t.offsetParent)y+=t.offsetTop
PL.style.top=y
PL.N(info[this.n][1])
}
//时间条码
A(r.firstChild,d=C("p"))
t=N[1][9]
while(t){A(d,g=C("tt"))
with(g.style){border="1px solid #cccccc";height=19;width=10;marginLeft=1;padding=2;e=t&3;t>>=2;backgroundColor=Tc[e]}}
//徽章
if((n=N[2]).length){A(d,u=C("p"))
u.style.textAlign="center"
for(e=0;e<n.length;){A(u,t=C('img'))
t.style.margin=1
t.style.backgroundColor='white'
t.className='b'
t.a=n[e]
t.onmouseover=function(){o=this;BI.src="../icons/bg/b/"+o.a+".gif";BT.innerHTML=o.b
for(var x=y=0;o!=null;y+=o.offsetTop,o=o.offsetParent)x+=o.offsetLeft
with(BS.style){left=x+25;top=y;visibility='visible'}}
t.onmouseout=function(){BS.style.visibility='hidden'}
t.src="../icons/bg/"+n[e++]+".gif"
t.b=n[e++]
if(e%12==0)A(d,C("br"))}}
//内容修饰
x=o.childNodes[1].firstChild;as=x.getElementsByTagName('a')
for(n=5,z=0;a=as[z++];){if(!a.getAttribute('href',2)){a.title=N[0][n].substr(1)
a.onclick=spec
a.d=N[0][n++].substr(0,1)
a.href="javascript:;"}
So(a,1)
}
for(z=0,cs=x.getElementsByTagName('img');a=cs[z];z++)So(a)
//代码修饰
if(n=N[0][4])for(z=0,cs=x.getElementsByTagName('textarea');a=cs[z];z++){if(!(s=Os[c=n.charAt(z)])){s=Os[c]=[];unLanI++}s.push(a);a.o=c}
//添加附件
if(n=N[3]){o.insertBefore(a=C('div'),o.lastChild);a.id="attachs"
addatt(a,"<p style=border:0><span class=fr>"+n.length+" / "+N[0][1]+"</span>附件")
for(z=0;c=n[z++];){
addatt(a,"<p>"+z+".<i>文件名:</i> <i>上载时间:</i>"+c[3]+" <i>大小:</i>"+c[2]+" Byte<br>")
y=a.childNodes[z]
y.childNodes[2].data=c[4]+" "
switch(c[1]){
case"i/gif":case"i/png":case"i/jpg":
addatt(y,"<img src=\"../uploads/"+c[0]+"."+c[4].replace(/"/g,"%22")+"\" onload=imgSize(this)>");break
case"a/mp3":
addatt(y,"[ <a href=javascript:; onclick=spc(this)>播放音乐</a> <a href=att.php?id="+c[0]+">下载</a> ]");
y=y.childNodes[9];y.d="a";y.title="../uploads/"+c[0];//y.onclick=spec
break
case"v/mp4":case"v/flv":
addatt(y,"[ <a href=javascript:; onclick=spc(this,1)>播放视频</a> <a href=att.php?id="+c[0]+">下载</a> ]")
y=y.childNodes[9];y.d="A";y.title="../uploads/"+c[0];//y.onclick=spec
break
default:addatt(y,"[ <a href=../uploads/"+c[0]+">下载文件</a> ]")}}
}else if(N[0][1])o.firstChild.lastChild.data+=" "+N[0][1]+" 附件"

r.parentNode.insertBefore(t=C("tr"),r.nextSibling)
o.style.borderBottom=0
r.firstChild.rowSpan=2
d=t.insertCell(0)
d.style.verticalAlign="bottom"
d.style.paddingLeft=5
u=o.lastChild
if(u.childNodes.length){
A(d,x=C("pre"))
x.innerHTML="---<font size=1 color=gray> 签名 </font>------------------------------<br>"
A(x,u)
if(x.offsetHeight>150)with(x.style){overflow="hidden";height=150}
else if((Z=u.getElementsByTagName('img')).length)for(z=0;m=Z[z++];)m.onload=function(){var o=this.parentNode;if(o.offsetHeight>150){o=o.style;o.overflow="hidden";o.height=150;this.onload=null}}
}
r=r.nextSibling
//功能
A(d,x=C('p'))
x.align="right"
x.style.padding="5 0"
for(u=pageInfo.M?0:uid?uid==N[1][0]?2:3:4;u<nf.length;u++){A(x,d=C('a'));d.innerHTML=nf[u];d.style.paddingLeft=7;d.href="javascript:;";d.onclick=Fs[u];d.i=i-1}
}

}ini()

function loadC(c,f){var o=C("iframe");o.className='ifcode';A(D.body,o);o.o=c;
o[IE?'onreadystatechange':'onload']=f?f:function(){var c=this.o;if(IE&&this.readyState!='complete')return;unLanI--;if(cvLan[c])exe(c,Os[c]);else{unLans.push(Os[c]);if(!unLanI)loadC('~')}};
o.src="js/lan/"+c.charCodeAt(0)+".htm"}
function exe(c,O){for(var t,o,f=cvLan[c];o=O.pop();){o.parentNode.replaceChild(c=C('pre'),o);c.contentEditable=false;c.innerHTML="<table width=100%><tr><td id=inCode>";t=G('inCode');t.removeAttribute('id');c.C=t;t.className="code";t.d=o;f(t)}}
for(a in Os)loadC(a)

cPlay=0
winControl="<a href=javascript:; onclick=cutme(this)>收起</a><br>"
function getFlvurl(){var c=cPlay;cPlay=0;return c.title}
function spc(o,i){o.onclick=spec;o.d=i?"A":"a";o.click();return false}
function spec(){var f,t,x,i=this,n=i.nextSibling
if(!(cPlay||n&&n.n))if(i.d=='a')tagSoundBox(i)
else{cPlay=i
i.parentNode.insertBefore(t=C("div"),n);t.n=1;t.id="videowin";t.style.width=IE?490:480
f=C('a');A(t,f);A(f,document.createTextNode('收起'));f.href="javascript:;";f.onclick=cutme
f=C('iframe');A(t,f);f.src="e/"+(IE?"ie":"fox")+"play.htm"}
return false}
function reii(i){return i.title.replace(/"/g,"&#34;")}

function cutme(o){o=this.parentNode;o.parentNode.removeChild(o);return false}

function addatt(o,s){o.innerHTML+=s}
function imgSize(o){with(o){onload=null;var W=MIW-10,w=width;title="图片尺寸："+w+","+height+(w>W?"；显示尺寸："+(width=W)+","+height+"；缩放："+Math.floor(W*100/w):"；缩放：100")+"%"}}

//---音乐盒页面代码---
var audioWin=0,curSong

function tagSoundBox(n){
try{if(typeof audioWin != "undefined" && typeof audioWin.pageStyle != "undefined"){audioWin.newS(n)
return}}catch(e){}

try{audioWin=window.open("","WinSoundBox","height=457,width=512,resizable=no,scrollbars=no")
if(typeof audioWin.pageStyle=="undefined"){
curSong=n
audioWin.document.write("<script language=javascript>pageStyle=\""+pageStyle+"\"</script><script language=javascript src=js/msc.js></script>")
}else audioWin.newS(n)
}catch(e){alert("无法正确使用音乐盒窗口!");return}
}