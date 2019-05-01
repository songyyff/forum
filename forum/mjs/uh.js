
/* 
用户头像类 uh.js 
*/


function uh_class(){

var os=G("uh_plain"),
us=uheads,
so, //图像放大框
oi, //放大框图像对象
it, //放大框图像说明td

i,s,ci=0,

lw=us[us.length-2], //每行个数
lr=us[us.length-1], //每页行数
ln=lw*lr, //每页个数
n=us.length-2, //总个数

lp=Math.ceil(n/ln), //总页数

io, //鼠标进入图片消除多余 gif onload 事件

op, //第一个头像对象
co, //当前页对象
cp=0; //当前页号


this.ini=function(){
if(uh_head.substr(0,4)=="sys/"&&(s=uh_head.substr(4)))for(i=0;i<n;i++)if(us[i][0]==s){
cp=Math.floor(i/ln)
ci=i
break
}
var t,z;
for(k=ln*cp,i=0,r=1,s="<table cellpadding=2 cellspacing=0><tr>";i<ln;i++){
s+="<td><img class=uho src=../faces/sys/"+((z=k+i)<n?us[z][0]:"0.gif")+" onmouseout=uh_o() onmouseover=uh_v(this) title=\""+(t=z<n?us[z][1]?us[z][1]:"缺说明":"缺头像")+"\"/><br><input type=radio name=userheadpic value=\""+(z<n?"sys/"+us[z][0]+"\"":"\" disabled")+"><tt>"+t.substr(0,3)+"</tt>";
if(++r>lw){r=1;s+="<tr>";}
}
s+="<td colspan="+lw+" style='padding:5 0;line-height:21px'>";

for(i=0;i<lp;)s+="<a class=facepagelink href=\"javascript:;\" onclick=\"uh_p("+i+",this)\">"+(cp==i?"<b>":"")+(i>9?String.fromCharCode(i+87):i)+(cp==i++?"</b>":"")+"</a>"+(i&15?"":"<br>");

os.innerHTML=s+"</table><table cellpadding=5 width=100 cellspacing=0 id=uh_showid><tr height=100><td align=center valign=middle><img><tr><td align=center class=bdt1></table>"
so=G('uh_showid')
oi=so.firstChild
it=oi.lastChild.firstChild
oi=oi.firstChild.firstChild.firstChild
co=os.firstChild.firstChild.lastChild.firstChild.childNodes[(cp>>4)+cp]
iI()
}

function iI(){var o=os.firstChild.firstChild.firstChild.firstChild.childNodes[2];o.checked=true}

this.fp=function(p,o){
var r,k;
if(cp==p)return;
cp=p;
co.innerHTML=co.innerHTML.charAt(3);
o.innerHTML="<b>"+o.innerHTML+"</b>";
co=o;
// 修改图标
for(r=os.firstChild.firstChild.firstChild,i=ln*p;r.nextSibling;r=r.nextSibling)
for(k=r.firstChild,c=0;k;i++,k=k.nextSibling)with(k.firstChild){src="../faces/sys/"+(i<n?us[i][0]:'0.gif');title=i<n?us[i][1]?us[i][1]:"缺说明":"缺头像";with(nextSibling.nextSibling){disabled=i>=n;value=i<n?"sys/"+us[i][0]:""}
k.lastChild.innerHTML=title.substr(0,3);}
iI()
}

var soX,soY
this.fmi=function(o){
for(var x=y=0,p=o;o!=null;y+=o.offsetTop,o=o.offsetParent)x+=o.offsetLeft
soX=x;soY=y
oi.onload=function(){if(soX)with(so.style){left=soX-parseInt(oi.width)-20;top=soY};oi.onload=null}
oi.src=p.src;it.innerHTML=p.title?p.title:"缺说明"
}

this.fmo=function(){soX=0;so.style.top=-999}

}

_uh=new uh_class()

function uh_p(i,o){_uh.fp(i,o)}
function uh_v(o){_uh.fmi(o)}
function uh_o(){_uh.fmo()}