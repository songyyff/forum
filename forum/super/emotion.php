<?php

e_e();

$mt=(int)$_REQUEST['EMT'];
echo"<script language=javascript>
var emts=[
";
//论坛表情图标类别
$q="select * from tdict where type=3 order by key2";
$rs=mysql_query($q) or die(f_e($q));
$i=1;
while($r=mysql_fetch_object($rs)){
if($mt==$r->key1)$i=0;
echo"[$r->key1,\"$r->info\"],";
$k=$r;
}
mysql_free_result($rs);
if($i)$mt=$k->key1;
echo "0],
EMT=$mt,
ems=[";

if($T=(int)$_REQUEST[action])include "s/ordem.php";else $T=1;

//论坛表情图标
$q="select * from tdict where type=16 and key1=$mt order by key2";
$rs=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($rs))echo "[$r->key2,\"$r->info\",\"$r->info2\"],";
mysql_free_result($rs);
echo "1],
actmode='$T'
</script>
";

echo "<div class=subhead><b>论坛表情图标设置</b> ",date("Y-m-d H:i:s",time()),"<hr><b id=demo style=color:blue;cursor:pointer>查看模拟效果</b> 选择<a href=?type=8>类别</a> <select id=semt name=semt></select><hr></div>",$msg||$inf?"<div class=bd1pd1>提交信息：<font color=red>$msg$inf</font></div>":"";
?>
<div id=con class=pd1></div>
<form method=post onsubmit="return checkdata()" enctype="multipart/form-data" action="?type=<?php echo"$vtype&EMT=$mt";?>">
<table cellspacing=0 cellpadding=5><tr><td width=60></td>
<td><input type=radio name=action onclick="doact(this)" value=1<?php echo $T==1?" checked":"","></td><td width=30>排序</td>
<td><input type=radio name=action onclick=\"doact(this)\" value=2",$T==2?" checked":"","></td><td width=30>修改</td>
<td><input type=radio name=action onclick=\"doact(this)\" value=3",$T==3?" checked":"","></td><td width=30>删除</td>
<td><input type=radio name=action onclick=\"doact(this)\" value=4",$T==4?" checked":"";?>></td><td >添加</td><td></td></tr>
</table>
<div id=formdiv></div>
<table cellspacing=0 cellpadding=5 width=100%>
<tr height=43><td width=60></td><td><input type=submit value="  提交(S)  "></td></tr></table>
</form>
<script src=../js/js.js language=javascript></script>
<script src=js/em.js language=javascript></script>

<style>
.EM{
background-color:white;
border:1px solid #BBB;
padding:1px;
cursor:pointer;
position:absolute;
top:0;left:0;
width:200;
}
.EM iframe{
border:0;
background-color:white;
overflow:hidden;
}
.moveBar{
background-color:#BBBEFE;
margin:0;
padding:3;
margin-top:1px;
}
</style>
<script language=javascript>
tTheme=<?php echo"\"",$_SESSION['sestyle'],"\"";?>;
editMenus={
A:0,
E:0  //表情
}
function C(t){return document.createElement(t)}
function A(o,t){o.appendChild(t)}
E=0
p=editMenus

demo.onmouseover=function(){
this.p=p.E=E=C('div')
E.className="EM"
E.style.width="auto"
E.onmouseout=pOut
E.onmouseover=hold
A(document.body,E)
A(E,t=C('iframe'))
t.src="../pro/e/em.htm"
A(E,t=C("div"))
t.className="moveBar"
t.d=1
t.onmousedown=drag
this.onmouseover=overMenu
overMenu(E.p=this)
}

menuTimeID=0

function pOut(){curM=this.p;menuTimeID=setTimeout(closeMenu,200)}
function hold(){if(menuTimeID){clearTimeout(menuTimeID);menuTimeID=0}}

function closeMenu(){if(curM){
if(curM.p)curM.p.style.top=-1000
menuTimeID=curM=0}}
function St(o){for(var t=o,x=0,y=0;o!=null;x+=o.offsetLeft,y+=o.offsetTop,o=o.offsetParent);return{x:x,y:y+t.offsetHeight}}
who=IE?function(o,t){return o||t}:function(o,t){return t!=window?t:o}

function overMenu(o){
if(menuTimeID){clearTimeout(menuTimeID);closeMenu()}
o=who(o,this)
var s=St(o)
if(o.p)with(o.p.style){top=s.y;left=s.x-o.p.offsetWidth+o.offsetWidth}
}

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
</script>
