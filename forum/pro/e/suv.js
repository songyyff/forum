P=parent
D=P.document
B=D.body
M=P.editMenus.V
C=P.C
A=P.A
G=P.G

function clo(){with(M.style){top=-999;left=0}}
function N(o,n){var i=0;while(o&&i++<n){o=o.nextSibling;}return o;}
function msnum(v){if(x=!isnumber(v.value)){scTo(v);alert("只能是数字!");v.focus();}return x;}
function scTo(o){for(var y=0;o;y+=o.offsetTop,o=o.offsetParent);scrollTo(0,y-100)}
var n=num=curi=0
surveyfirst="<p><a href=javascript:; onclick=delsurvey()>删除调查</a>调查说明</p>有效投票时间 <input type=text value=0 id=suvdate name=suvdate class=input30> (按天计算，0 表示无限制)\
<br><textarea rows=4 id=surveydesc name=suvdesc style=\"margin-top : 5px;margin-bottom : 5px;\"></textarea>\
<br><input type=checkbox name=suvaftshow value=1>投票后显示投票结果\
<br><input type=checkbox name=suvismut id=suvismut>多选投票\
 至少选择数量 <input class=input30 type=text name=minsuv  disabled value=1> 最多选择数量 <input class=input30 type=text name=maxsuv  disabled value=0><br>\
<p><a href=javascript:; onclick=delsuvi()>项目</a><a href=javascript:; onclick=delsuvall()>删除全部</a>调查项目 </p>"

M.insertBefore(X=C("div"),M.firstChild)
X.id="suv"
function star(){
X.innerHTML=surveyfirst
G('suvismut').onclick=function(){
var o=this;f=o.nextSibling.nextSibling
f.nextSibling.nextSibling.disabled= f.disabled=!o.checked
if(o.checked)f.focus()
}

A(X,ul=C('ol'))
P.eval("function getsuvitem(o){A(o,l=C('li'));return l}")
a5()
}

function a5(){
for(k=0;k<5;k++){
l=P.getsuvitem(ul)
A(l,t=C('input'))
t.name="suviname[]"
t.onfocus=suvigetfocus
t.style.width="100%"
if(!k)t.focus()
}
n+=5
num+=5
}

function isurvey(){if(num<100){if(n)a5();else star()}return false}

function suvigetfocus(){curi=this.parentNode}

P.delsurvey=function(){
if(confirm("您确定删除调查表吗？")){
n=num=ul=newsurvey=0
X.innerHTML=""
}return false}

P.delsuvall=function(){
if(num<3){alert("项目数量只有2个了，不能再删除！");return}
if(confirm("您确定删除全部调查项目吗？")){
num=2
var i=ul.childNodes[1]
while(i.nextSibling)ul.removeChild(i.nextSibling)
i.childNodes[0].focus()
}return false}

P.delsuvi=function(){
if(num<3){alert("项目数量只有2个了，不能再删除！");return}
if(!curi){alert("请选择需要删除的项目！");return}
var i=curi
curi=i.nextSibling?i.nextSibling:i.previousSibling
ul.removeChild(i)
curi.childNodes[0].focus()
num--
return false
}

P.checksuv=function(){//校验调查表
if(msnum(G('suvdate')))return 1
var i=ul.childNodes[ul.childNodes.length-1]
//过滤末尾空条目
while(num>2&&!i.childNodes[0].value.replace(/^\s*|\s*$/g,"").length){
i=i.previousSibling
ul.removeChild(i.nextSibling)
num--
}
if(ul.childNodes.length>100){alert("调查表调查条目不能多于100条!");return 1}
i=ul.childNodes[0]
do{
with(i.childNodes[0]){
value.replace(/^\s*|\s*$/g,"")
if(!value.length){scTo(i);alert("调查项目不能为空!");focus();return 1}
}
}while(i=i.nextSibling)

//检测最大最小选择数量
i=G('suvismut')
if(i.checked){
i=N(i,2)
if(msnum(i))return 1
t=parseInt(i.value)
if(!t||t>num-1){scTo(i);alert("至少选择数量范围在 1 至 "+(num-1)+" 之间!");i.focus();return 1}
u=parseInt((i=N(i,2)).value)
if(msnum(i))return 1
if(u&&(t>u||u>num)){scTo(i);alert("最多选择数量范围在 "+t+" 至 "+num+" 之间，或者为 0 !");i.focus();return 1}
}
return 0
}