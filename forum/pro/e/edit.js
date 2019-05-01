/*
文本编辑器外壳 version 2.0
2011.10
*/
tID=0
function v(){return false}
checksuv=checkesuv=checkatt=0
function orderform(){
if(checksuv&&checksuv()||checkesuv&&checkesuv()||checkatt&&checkatt())return
if(vT<2&&G('til').value.length<1){alert("发帖需要标题！");G('til').focus();return}
var E=Zz=Is=Y=O=0
function rgb(c){var w,i,t;if(c.charAt()!='#'){w=c.substr(4).split(','),c='#';for(i=0;t=w[i++];c+=(t=parseInt(t).toString(16)).length&1?"0"+t:t);}return c}
function I(n,v){var O=C('input');O.type='hidden';A(MF,O);O.name=n;O.value=v;Y+=v.length;return O}
//x-small,small,medium,large,x-large,xx-large,(7 | -webkit-xxx-large)
Z={ma:1,ll:2,iu:3,ge:4,ar:5,la:6,bk:7}
w={em:'i',strong:'b',strike:'s'}
W={};V=G('con');V.value="";
function H(v,i){if(v)V.value+=v=='\n'?v:"<"+(i?"/":"")+v+">"}
W.i=W.b=W.u=W.s=function(){H(m);return m};W.br=function(){H("\n")};W.hr=function(){H("hr")}
W.h1=W.h2=W.h3=W.h4=W.h5=W.h6=W.p=W.div=function(o){var a=o.align,b=o.style.textAlign,c=a||b,d=0;H(c?m+(c?" align="+(a?a:b):""):(d=m=='p'||m=='div')?'\n':m);return d?"":m}
W.em=W.strong=W.strike=function(){H(w[m]);return w[m]}
F={};F['宋体']='I';F['黑体']='H';F['楷体']='K';F['Times New Roman']='D'
W.font=function(o){var a;H('font'+((a=o.face)?" face="+(F[a]?F[a]:a):"")+((a=o.size)?" size="+a:"")+((a=o.color)?" color="+rgb(a):"")+((a=o.style.backgroundColor)?" style=E"+rgb(a):""))
return"font"}
W.span=function(o){var t,e=h=i="",a=o.style
if(t=a.fontSize)i+=" size="+(t<8?t:Z[t.substr(3,2)])
if(t=a.fontFamily)i+=" face="+(F[t]?F[t]:t)
if(t=a.color)i+=" color="+rgb(t)
if(t=a.backgroundColor)i+=" style=E"+rgb(t)
if(i){h="<font"+i+">";e="</font>"}
if(t=a.textDecoration.toLowerCase()){if(t.indexOf("d")>0){h+="<u>";e="</u>"+e}if(t.indexOf("-")>0){h+="<s>";e="</s>"+e}}
if(t=a.fontStyle){h+="<i>";e="</i>"+e}
if(t=a.fontWeight){h+="<b>";e="</b>"+e}
H(h.substr(1,h.length-2))
return e.substr(2,e.length-3)}
W.pre=function(o){Zz++;I('code[]',o.C.d.value);G('Icode').value+=o.C.d.o;H("code")}
W.a=W.img=function(o){var w,n,z,s,b='',x;Is++
v=o.getAttribute(m=='a'?'href':'src',2)
I((o.src?'I':'A')+"s[]",v)
if(m!='a'){if(w=(w=o.style.width)?parseInt(w):o.getAttribute("width",2))b=" width="+w
if(w=(w=o.style.height)?parseInt(w):o.getAttribute("height",2))b+=" height="+w}
H(m+b);return m=="a"?"a":"";}
function T(o){var i,t,e=""
for(i=0;t=o.childNodes[i++];)if(t.nodeType==3){V.value+=t.data.replace(/</g,"&lt;");}else{if(f=W[m=t.nodeName.toLowerCase()]){e=f(t);if(!t.C)T(t);H(e,1)}else E="编辑内容含有错误标记: "+m;}}
T(EW)
Y+=V.value.length
if(!Y||Y>99999)E=Y?"内容至多可有99999个字.":"发帖需要内容."
if(Zz>100)E="代码块不能多于100个!\n目前有 "+Zz+" 个."
if(Is>100)E="图片和连接只能有100个,当前有 "+Is+" 个."
if(E){alert(E);EW.focus();return}
MF.method="POST"
MF.action="?type="+vT+"&actionid="+sID+(vT&1&&tID?"":("&tid="+tID))
MF.submit()
}

atts.pop()
var editMenus={
V:0, //调查表
M:0, //HTML
D:0, //Code
B:0, //about
A:0, //附件
L:0, //连接
F:0, //字体
S:0, //字体大小
H:0, //H1-H6 文本类型
C:0, //选取颜色面板
E:0  //表情
},
HTML,
D=document,
B=D.body,
Aview=G('Aview')

Sc='red'
Ec='1px solid red'
Bc="#DDE"

EW0=G('EW')
EW0.contentEditable=true
codeE=0;

if(IE)EW0.style.width=Info.offsetWidth
EW0.focus()
function insImg(h){var i="<img id=ImgO>";if(IE){if(Y=D.selection)if(Y=Y.createRange())Y.pasteHTML(i)}else D.execCommand("insertHTML",false,i);Y=G('ImgO');Y.removeAttribute('id');Y.src=h}
function getOs(t){return EW0.getElementsByTagName(t)}
function St(o){for(var t=o,x=0,y=0;o!=null;x+=o.offsetLeft,y+=o.offsetTop,o=o.offsetParent);return{x:x,y:y+t.offsetHeight}}
function newImg(){return new Image()}
function linkc(a,b,c){EW.focus();D.execCommand(a,b,c)}
function centerWin(o,i){var x,t,s=St(EW);t=o.style;t.top=s.y-EW.offsetHeight;x=EW.offsetWidth-o.offsetWidth;t.left=i?i&1?10:x:x/2}

Infoo=Info.childNodes[0]
EW0.onmouseover=function(e){e=IE?event:e;var a=IE?e.srcElement:e.target,b=a.nodeName
if(b=="IMG")Infoo.data=a.getAttribute("src",2)
else if(b=="A")Infoo.data=(s=a.getAttribute('href',2)).charAt()==':'?s.substr(2):s}

function Debug(s){G('DBG').innerHTML+=s+" "}

(function(){

var i=0

function drag(e){
var o=this,t=o.parentNode.style,dX=x(e)-parseInt(t.left),dY=y(e)-parseInt(t.top)
function x(e){return (IE?event:e).clientX}function y(e){return (IE?event:e).clientY}
o.setCapture()
o.onmousemove=function(e){t.left=x(e)-dX;t.top=y(e)-dY;c();return false}
o.onmouseup=function(){o.onmousemove=o.onmouseup=null;o.releaseCapture();c()}
function c(){if(IE)event.cancelBubble=true}
c()
return false
}

var menuTimeID=curM=0
function menuOut(){
curM=this
menuTimeID=setTimeout(closeMenu,200)
}
function pOut(){curM=this.p;menuTimeID=setTimeout(closeMenu,200)}

function closeMenu(){if(curM){
with(curM.style)borderColor=backgroundColor=""
if(curM.p)curM.p.style.top=-1000
menuTimeID=curM=0}}

who=IE?function(o,t){return o||t}:function(o,t){return t!=window?t:o}
function overMenu(o){
if(menuTimeID){clearTimeout(menuTimeID);closeMenu()}
o=who(o,this)
with(o.style){borderColor=Sc;backgroundColor=Bc}
var s=St(o)
if(o.p)with(o.p.style){top=s.y;left=s.x}
}
function hold(){if(menuTimeID){clearTimeout(menuTimeID);menuTimeID=0}}

function doexe(a,b,c,d){
if(d&&IE)d.releaseCapture()
EW.focus()
D.execCommand(a,b,c)
closeMenu()
return false
}

//菜单
var M=editMenus,
Cm, //当前显示菜单
Ct=0

function BM(o,//填充对象
c,//内容
f//函数
){
var m,i
o.className="EM"
o.onmouseout=pOut
o.onmouseover=hold
A(o,m=new Image())
m.src="e/img/35.png"
for(i=0;i<c.length;i++){
A(o,t=C("p"))
if(IE){
t.onmousedown=function(){this.setCapture()}
t.onmouseup=f
}else t.onmousedown=f
t.onmouseover=function(){this.style.border=Ec}
t.onmouseout=function(){this.style.borderColor=""}
if(c[i].charAt()=='H'){A(t,t=C(c[i]));t.style.margin=0;A(t,D.createTextNode(c[i]))}
else t.innerHTML=c[i]
}
}

function movebar(o){A(o,t=C("div"));t.className="moveBar";t.onmousedown=drag}
function shortm(z,t){movebar(z);A(B,z);t.onmouseover=overMenu;overMenu(z.p=t)}

function getHs(){
BM(this.p=M.H=C('div'),
["文本","H1","H2","H3","H4","H5","H6"],
function(){return doexe("FormatBlock",false,(IE?"<":"")+(this==this.parentNode.childNodes[1]?"p":this.lastChild.innerHTML)+(IE?">":""),this)}
)
shortm(M.H,this)
}

function getFontsize(){
BM(this.p=M.S=C('div'),
c=["文本默认大小","1","2","3","4","5","6","7"],
function(){return doexe("FontSize",false,this==this.parentNode.childNodes[1]?3.5:this.lastChild.innerHTML,this)}
)
for(var k=1,t=M.S.childNodes[1];t=t.nextSibling;t.innerHTML="<font size="+c[k]+">"+c[k++]);
shortm(M.S,this)
}

function getFonts(){
this.p=M.F=C('div')
BM(M.F,
c=["使用系统字体","宋体","黑体","楷体","Arial","Tahoma","Times New Roman","Serif","Sans-serif","Monospace","Cursive","Fantasy"],
function(){return doexe("FontName",false,this==this.parentNode.childNodes[1]?0:this.innerHTML,this)}
)
for(k=1,i=M.F.childNodes[2];i!=M.F.lastChild;i=i.nextSibling)i.style.fontFamily=c[k++]
shortm(M.F,this)
}

function setColor(t){return doexe(M.C.p.src.charAt(M.C.p.src.length-5)=='5'?"ForeColor":"BackColor",false,t?t.d:0)}

function getColors(){
var fo,fv
if(!M.C){
M.C=C('div')
M.C.className="CO"
M.C.onmouseout=pOut
M.C.onmouseover=hold
A(B,M.C)
fv=function(){this.style.borderColor=Sc}
fo=function(){this.style.borderColor=""}
sc=function(){return setColor(this)}

//A(M.C,t=C("p"))
//t.onmouseover=fv
//t.onmouseout=fo
//t.onclick=function(){return setColor(0)}
//t.innerHTML="无色"

CC=['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F']
function crgb(c){return CC[c>>4]+CC[c&15]}
var c=[[2,2,2],[0,0,0],[2,0,0],[2,1,0],[2,2,0],[1,2,0],[0,2,0],[0,2,1],[0,2,2],[0,1,2],[0,0,2],[1,0,2],[2,0,2],[2,0,1]]
for(i=0;i<c.length;i++){
n=c[i]
for(k=0;k<5;k++){
A(M.C,t=IE?C('a'):new Image())
with(t.style){t.d="#"+crgb((n[0]?(n[0]==1?5:10-k):k)*25.5)+crgb((n[1]?(n[1]==1?5:10-k):k)*25.5)+crgb((n[2]?n[2]==1?5:10-k:k)*25.5);backgroundColor=t.d}
if(IE)t.href="javascript:;"
t.onmouseover=fv
t.onmouseout=fo
t.onclick=sc
}
}
if(IE){
A(M.C,t=C("a"))
t.style.width="100%"
t.innerHTML="自选(ctrl)"
t.href="javascript:;"
t.onmouseover=fv
t.onmouseout=fo
t.onmouseup=function(){if(event.button==1)if(event.ctrlKey)
{t=this.style.backgroundColor=G('dlgHelper').ChooseColorDlg();this.d=(t&0xff)<<16|t&0xff00|t>>16}
else setColor(this)
return false}
}
movebar(M.C)
M.C.lastChild.style.margin=1
}

(this.onmouseover=function(o){
o=who(o,this)
M.C.p=o
o.p=M.C
overMenu(o)
})(this)
}

function getEmotion(){
var p=this.p=M.E=C('div')
p.className="EM"
p.style.width="auto"
p.onmouseout=pOut
p.onmouseover=hold
A(p,t=C('iframe'))
t.src="e/em.htm"
shortm(M.E,this)
}

function fillwin(a,w,h,u,o){var z=M[a]=C('div')
z.className="AT"
A(o?o:B,z)
A(z,t=C('iframe'))
if(w)t.style.width=w
if(h)t.style.height=h
t.src=u
movebar(z)}

function getAtts(){if(!M.A)fillwin('A',0,IE?426:436,"e/"+(IE?"ie":"fx")+"att.htm");centerWin(M.A,2)}

function getLink(){if(!M.L)fillwin('L',400,300,"e/link.htm");centerWin(M.L,0)}

function getCode(){if(!M.D)fillwin('D',500,400,"e/code.htm");centerWin(M.D,0)}

function html(){if(!M.M)fillwin('M',0,IE?426:436,"e/html.htm");else HTML();centerWin(M.M,2)}

EW.style.height=360
function zoomP(){with(EW.style)height=parseInt(height)+50}
function zoomS(){with(EW.style)if(parseInt(height)>300)height=parseInt(height)-50}

function dosuv(){if(!M.V)fillwin('V',IE?500:510,30,"e/suv.htm",MF);centerWin(M.V,0)}

function about(){if(!M.B)fillwin('B',400,198,"e/about.htm");centerWin(M.B,0)}

var mns=[[13,"关于编辑器",about],[47,"左对齐","JustifyLeft"],[21,"居中","justifyCenter"],[22,"右对齐","JustifyRight"],[0],[37,"粗体","Bold"],[38,"斜体","Italic"],[39,"下划线","Underline"],[40,"删除线","StrikeThrough"],[48,"字体",0,getFonts],[34,"字体大小",0,getFontsize],[35,"文本颜色",0,getColors],[36,"文本背景色",0,getColors],[41,"删除文本格式","RemoveFormat"],[0],[6,"剪切(Ctrl+X)","Cut"],[7,"复制(Ctrl+C)","Copy"],[8,"粘贴(Ctrl+V)","Paste"],[0],[32,"标题",0,getHs],[45,"插入横线","insertHorizontalRule"],[0],[46,"插入表情",0,getEmotion],[10,"插入连接",getLink],[11,"断开连接","Unlink"],[20,"插入附件",getAtts],[1,"添加调查",dosuv],[18,"插入代码",getCode],[0],[3,"放大",zoomP],[4,"缩小",zoomS],[2,"显示代码",html]]

I=IE?[]:[1,2,3,4,14,15,16,17,18,19,20]
if(vT>1)I.push(26)
for(i=I.length;i--;)mns[I[i]]=0

function dota(){EW.focus();D.execCommand(this.d,0,"")}

EW.onpaste=function(e){var c,s;if(IE){s=clipboardData.getData("Text");event.returnValue=false}else{e.preventDefault();e.stopPropagation();c=e.clipboardData;s=c.getData("text/html")||c.getData("text/plain")}
if(s){insImg();Y.parentNode.replaceChild(D.createTextNode(s),Y)}}
	
for(i=0;i<mns.length;i++)if(n=mns[i]){
t=new Image()
if(n[0]){t.title=n[1];t.onmouseover=n[3]?n[3]:overMenu;t.onmouseout=n[4]?n[4]:menuOut;if(n[2])if(typeof n[2]=="string"){t.onclick=dota;t.d=n[2]}else t.onclick=n[2]
}else with(t.style){border=0;margin=1}
t.src="e/img/"+n[0]+".gif"
A(mIcons,t)
}
mIcons.firstChild.id="fr"
if(vT>1)attri.className="attri"
if(!IE){
D.execCommand("useCSS",false,true)
D.execCommand("styleWithCSS",false,true)
}
})()

unLanI=0
unLans=[]
cvLan={}
Os={}
function loadC(c,f){var o;A(D.body,o=C("iframe"));o.className='ifcode';o.o=c;o[IE?'onreadystatechange':'onload']=f?f:function(){var c=this.o;if(IE&&this.readyState!='complete')return;unLanI--;if(cvLan[c])exe(c,Os[c]);else{unLans.push(Os[c]);if(!unLanI)loadC('~')}};o.src="js/lan/"+c.charCodeAt(0)+".htm"}
function exe(c,O){for(var t,o,f=cvLan[c];o=O.pop();){o.parentNode.replaceChild(c=C('pre'),o);c.contentEditable=false;c.innerHTML="<table width=100%><tr><td id=inCode>";t=G('inCode');t.removeAttribute('id');c.C=t;t.className="code";t.d=o;f(t)}}
(function(){var w,h,i,a,I,A
if(hrefS.length)for(I=1,i=0,A=getOs('a');a=A[i++];)if(!a.getAttribute('href',2))a.href=":"+hrefS[I++]
for(i=0,I=getOs('textarea');a=I[i];i++){if(!(h=Os[w=codeT.charAt(i)])){unLanI++;h=Os[w]=[]}h.push(a);a.o=w}
for(a in Os)loadC(a)})()