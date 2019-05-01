/*
消息编辑器壳 version 2.0
2013.05
*/

EW.style.height=270
mt.style.width=w=screen.width-230
EW.style.width=w-(IE?80:102)

function orderform(){var E=Is=Y=O=0
function I(n,v){var O=C('input');O.type='hidden';A(msgform,O);O.name=n;O.value=v;Y+=v.length;return O}
W={};m=0;V=G('con');s=V.value="";
function H(v,i){if(v)V.value+=v=='\n'?v:"<"+(i?"/":"")+v+">"}
W.br=W.p=W.div=function(){return"\n"}
W.a=W.img=function(o){var w,n,z,s,b='';Is++
I((o.src?'I':'A')+"s[]",o.getAttribute(m=='a'?'href':'src',2))
if(m!='a'){if(w=(w=o.style.width)?parseInt(w):o.getAttribute("width",2))b=" width="+w
if(w=(w=o.style.height)?parseInt(w):o.getAttribute("height",2))b+=" height="+w}
H(m+b);return m=="a"?"a":""}
function T(o){var i,t,e=""
for(i=0;t=o.childNodes[i++];)if(t.nodeType==3){V.value+=t.data.replace(/</g,"&lt;")}else{if(!(f=W[m=n=t.nodeName.toLowerCase()]))E="编辑内容含有错误标记: "+m;e=f(t);T(t);H(e,1)}}
T(EW)
Y+=V.value.length
if(Y<9||Y>2000)E=Y<9?"内容至少得有9个字.":"内容至多可有2000个字."
if(Is>50)E="图片和连接只能有50个,当前有 "+Is+" 个."
if(E){alert(E);EW.focus();return}
msgform.submit()}

var editMenus={
B:0, //about
L:0, //连接
E:0  //表情
},D=document,B=D.body,Sc='red',Ec='1px solid red',Bc="#EEEEFE"

function getOs(t){return EW.getElementsByTagName(t)}
function insImg(h){var i="<img id=ImgO>";if(IE){if(Y=D.selection)if(Y=Y.createRange())Y.pasteHTML(i)}else D.execCommand("insertHTML",false,i);Y=G('ImgO');Y.removeAttribute('id');Y.src=h}
function St(o){for(var t=o,x=0,y=0;o!=null;x+=o.offsetLeft,y+=o.offsetTop,o=o.offsetParent);return{x:x,y:y+t.offsetHeight}}
function newImg(){return new Image()}
function linkc(a,b,c){EW.focus();D.execCommand(a,b,c)}
function centerWin(o,i){var x,t,s=St(EW);t=o.style;t.top=s.y-EW.offsetHeight;t.left=s.x+(EW.offsetWidth-o.offsetWidth)/2}
Infoo=Info.childNodes[0]
EW.onmouseover=function(e){var s,a=IE?event.srcElement:e.target,b=a.nodeName
if(b=="IMG")Infoo.data=a.src
else if(b=="A")Infoo.data=(s=a.getAttribute('href',2)).charAt()==':'?s.substr(2):s
};
(function(){
function drag(e){
var o=this,t=o.parentNode.style,dX=x(e)-parseInt(t.left),dY=y(e)-parseInt(t.top)
function x(e){return (IE?event:e).clientX}function y(e){return (IE?event:e).clientY}
o.setCapture()
o.onmousemove=function(e){t.left=x(e)-dX;t.top=y(e)-dY;c();return false}
o.onmouseup=function(){o.onmousemove=o.onmouseup=null;o.releaseCapture();c()}
function c(){if(IE)event.cancelBubble=true}
c()
return false}
var i=menuTimeID=curM=0
function menuOut(){curM=this;menuTimeID=setTimeout(closeMenu,200)}
function pOut(){curM=this.p;menuTimeID=setTimeout(closeMenu,200)}
function closeMenu(){if(curM){with(curM.style)borderColor=backgroundColor="";if(curM.p)curM.p.style.top=-1000;menuTimeID=curM=0}}
who=IE?function(o,t){return o||t}:function(o,t){return t!=window?t:o}
function overMenu(o){if(menuTimeID){clearTimeout(menuTimeID);closeMenu()};o=who(o,this);with(o.style){borderColor=Sc;backgroundColor=Bc};var s=St(o);if(o.p)with(o.p.style){top=s.y;left=s.x}}
function hold(){if(menuTimeID){clearTimeout(menuTimeID);menuTimeID=0}}
//菜单
var M=editMenus,
Cm, //当前显示菜单
Ct=0
function movebar(o){A(o,t=C("div"));t.className="moveBar";t.onmousedown=drag}
function shortm(z,t){movebar(z);A(B,z);t.onmouseover=overMenu;overMenu(z.p=t)}
function getEmotion(){var p=this.p=M.E=C('div');p.className="EM";p.style.width="auto";p.onmouseout=pOut;p.onmouseover=hold;A(p,t=C('iframe'));t.src="e/em.htm";shortm(M.E,this)}
function fillwin(a,w,h,u,o){var z=M[a]=C('div');z.className="AT";A(o?o:B,z);A(z,t=C('iframe'));if(w)t.style.width=w;if(h)t.style.height=h;t.src=u;movebar(z)}
function getLink(){if(!M.L)fillwin('L',400,155,"e/mlink.htm");centerWin(M.L)}
function about(){if(!M.B)fillwin('B',400,198,"e/about.htm");centerWin(M.B)}
function dota(){EW.focus();D.execCommand(this.d,0,null)}
mns=[[13,"关于编辑器",about],[46,"插入表情",0,getEmotion],[10,"插入连接",getLink],[11,"断开连接","Unlink"]]
EW.onpaste=function(e){var c,s;if(IE){s=clipboardData.getData("Text");event.returnValue=false}else{e.preventDefault();e.stopPropagation();c=e.clipboardData;s=c.getData("text/html")||c.getData("text/plain")}
if(s){insImg();Y.parentNode.replaceChild(D.createTextNode(s),Y)}}
for(i=0;i<mns.length;i++){n=mns[i];t=new Image()
if(n[0]){t.title=n[1];t.onmouseover=n[3]?n[3]:overMenu;t.onmouseout=n[4]?n[4]:menuOut;if(n[2])if(typeof n[2]=="string"){t.onclick=dota;t.d=n[2]}else t.onclick=n[2]}
t.src="e/img/"+n[0]+".gif"
A(mIcons,t)}
mIcons.firstChild.id="fr"
})()