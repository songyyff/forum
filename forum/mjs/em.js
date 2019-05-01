
/* 表情类 em.js */

function emclass(){

var F=emfacs,
ol=G("facepagelink"),
op=G("showpagefaces"),
cn=G('replaycontent'),
so=G('em_showid'),
oi=so.firstChild,
it=oi.lastChild.firstChild,
i,s,n,o,co,
io, //鼠标进入图片消除多余 gif onload 事件
ccp=0, //页间隔
cp=0, //当前页号
pl=8, //页长度
en=F.length-2, // 表情总个数
ep=F[en+1]*F[en], //每页表情个数
pn=Math.ceil(en/ep) //表情总页数

oi=oi.firstChild.firstChild.firstChild;

//pn=22;
n=pn>pl?pl+1:pn;

this.set=function(){cn=G('replaycontent')}

ini=function(p){
var k,r=0;
s="";
if(pn>pl){for(i=0;i<pn;i+=pl+1,r++)s+="<a class=facepagelink href=\"javascript:;\" onclick=\"em_p("+i+",this)\">"+(i>9?String.fromCharCode(i+87):i)+"</a>";s+="<br><br>";}
for(i=pn>pl?1:0;i<n;i++)s+="<a class=facepagelink href=\"javascript:;\" onclick=\"em_p("+i+",this)\">"+i+"</a>";
ol.innerHTML=s;
co=ol.firstChild;
co.innerHTML="<b>"+co.innerHTML+"</b>";
ol=r?ol.childNodes[r+2]:ol.firstChild;
for(k=ep*p,i=0,r=1,s="";i<ep;i++){
s+="<img class=emo src=\"../icons/em/"+(i<en?F[k+i][0]:'0')+".gif\" onmouseout=\"em_o()\" onmouseover=\"em_v(this)\" onclick=\"em_i("+i+")\" title=\""+(i<en?F[k+i][1]:"缺少表情")+"\"/>";
if(++r>F[en]){r=1;s+="<br>";}
}
op.innerHTML=s;
op=op.firstChild; //第一个表情图标
}

ini(0);

this.fp=function(p,m){
var b,c;
if(cp==p)return;
cp=p;
co.innerHTML=co.innerHTML.substr(3,1);
if(pn>n&&!(p>0&&p<n)){ //页翻页
for(o=ol,i=1;i<n;i++,o=o.nextSibling){
if(b=(c=i+p)<pn)o.innerHTML=(c>9?String.fromCharCode(c+87):c);
with(o.style){visibility=b?"visible":"hidden";position=b?"":"absolute";	}
ccp=p;
}
}
m.innerHTML="<b>"+m.innerHTML+"</b>";
co=m;
// 修改改变图标
i=(ccp+p)*ep;k=i+ep;r=0;s="";o=op;
while(i<k){
o.src="../icons/em/"+(i<en?F[i][0]:'0')+".gif";
o.title=i<en?F[i++][1]:"缺表情";
o=o.nextSibling;
if(F[en]==++r){r=0;o=o.nextSibling;}
}
}

this.fi=function(i){
var t,x,y,z;
if(en>(z=cp*ep+i)){
s=F[z][0];
with(cn){
focus();
if(IE){
t=document.selection.createRange();
t.text="[em]"+s+".gif[/em]";
t.select();
}else{
x=selectionStart;
y=selectionEnd;
t=scrollTop;
value=value.substring(0,x)+"[em]"+s+".gif[/em]"+value.substring(y,value.length);
scrollTop=t;
setSelectionRange(t=x+9+s.length+4,t);}
}
}
}

this.fmi=function(o){
io=1;
oi.src=o.src;it.innerHTML=o.title?o.title:"缺说明";
for(var x=y=0,o=op;o!=null;y+=o.offsetTop,o=o.offsetParent)x+=o.offsetLeft;
with(so.style){left=x-6;top=y;}
}

this.fmo=function(){io=0;so.style.visibility="hidden"}

this.il=function(o){if(io)with(so.style){io=0;left=parseInt(left)-so.clientWidth;visibility="visible"}}

} // emotion class end

_em=new emclass();

function em_i(i){_em.fi(i)}
function em_p(i,o){_em.fp(i,o)}
function em_v(o){_em.fmi(o)}
function em_o(){_em.fmo()}
function em_l(o){_em.il(o)}