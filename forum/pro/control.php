<?php include "../func/mustfunc.php"; 

//判权, check rights
if(!$_S['seuserid'])f_toerror("nologin");	//未登陆, no login
if(($VT=(int)$_R['type'])>3||$VT<0)$VT=0;
if(1>$CP=(int)$_R['page'])$CP=1;
$q="select * from tuser where id=".$uid=$_S['seuserid'];
$R=mysql_query($q) or die(f_e($q));
if($R)$ur=mysql_fetch_object($R);else f_toerror("nouser");
mysql_free_result($R);
if($ur->stat!='E')f_toerror("userdisabled");

if(isset($_R['theme'])){ //更改主题有提交
$q="update tuser set styl=".($t=(int)$_R['theme'])." where id=$uid";
mysql_query($q) or die(f_e($q));
$q="select * from tdict force index(typekey) where type=4 and key1=$t";
$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
mysql_free_result($R);
$_S['sestyle']=$r->info;
}
/*
if($ur->inmnu&&$ur->rmnu<$ur->maxr){
$space=$ur->maxr-$ur->rmnu;
$q="select id from msg where uid=$ur->id and type=2  order by stime asc limit 0,$space;";
$R=mysql_query($q) or die(f_e($q));
$resultrows=mysql_num_rows($R);
$chgrows=0;
for($i=0; $i<$resultrows; $i++){
$r=mysql_fetch_object($R);
$q="update msg set type=0 where id=$r->id";
mysql_query($q) or die(f_e($q));
$chgrows += mysql_affected_rows();
}
mysql_free_result($R);
$q="update tuser set nmnu=nmnu+$chgrows,rmnu=rmnu+$chgrows, inmnu=inmnu-$chgrows where id=$ur->id";
mysql_query($q) or die(f_e($q));
$ur->nmnu += $chgrows;
$ur->rmnu += $chgrows;
$ur->inmnu -= $chgrows;
} 
*/
$_S["semsgs"]=($ur->nmnu?"(<font class=lightfont>$ur->nmnu</font>)":"").($ur->rmnu>=$ur->maxr||$ur->smnu>=$ur->maxs||$ur->dmnu>=$ur->maxd?"[过载]":"");
?>

<html>

<head>
  <title>控制面版</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="../theme/<?php echo $_S['sestyle']; ?>/def.css">
  <script language="JavaScript" src="../js/js.js"></script>
</head>

<body>

<?php include "../hefo/head.php"; ?>

<div class=gud><a href="../index.php"><b>论坛</b></a>>>控制面版</div>

<?php
//显示信箱状态, show message box state
if($ur->rmnu>=$ur->maxr||$ur->smnu>=$ur->maxs||$ur->dmnu>=$ur->maxd){
echo "<div class=bp5><font class=warningc><b>警告!</b></font><br>",
$ur->rmnu>=$ur->maxr?"您的 [收到消息箱] 已满，最大容量为[<b>$ur->maxr</b>]，请删除不需要的消息<br>":"",
$ur->smnu>=$ur->maxs?"您的 [已发送消息箱] 已满，最大容量为[<b>$ur->maxs</b>]，请删除不需要的消息<br>":"",
$ur->dmnu>=$ur->maxd?"您的 [被删除消息箱] 已满，最大容量为[<b>$ur->maxd</b>]，请删除不需要的消息":"","</div>";
}
?>
<table width=100% cellpadding=0 cellspacing=0>
<TD width=200 valign=top style=padding:2px;padding-left:0px>

<div class=O>菜单</div>

<pre class=menu>
<a href=?>快速浏览</a>
<a href=?type=1>论坛用户</a>
<a href=?type=2>选择主题</a>
<a href=?type=3>论坛徽章</a>
</pre>

<div class=O>好友</div>

<div class=FP>
<?php
$q="select t2.id,t2.name,t2.ltime from tfrid as t1 force index(uid),tuser as t2 force index(PRIMARY) where t1.uid=".$_S['seuserid']." and type=0 and t2.id=t1.fid order by t2.ltime desc,t2.name desc;";
$R=mysql_query($q) or die(f_e($q));
if($l=mysql_num_rows($R))for($i=0;$i<$l;$i++){
$r=mysql_fetch_object($R);
echo"<a id=fr href=msgs.php?type=3&userid=$r->id><i>=[]</i></a>",f_isonline($r->ltime)?"下线":"<tt class=lightfont>在线</tt>"," <a href=\"userinfo.php?userid=$r->id\">[$r->name]</a><br>";
}
else echo "--- 还没朋友 ---";
mysql_free_result($R);
?>
</div>

<td valign=top style=padding-top:2px;padding-bottom:2px>
<?php

include"r/con$VT.php";

function showmsgerror($errormsg){
echo "<table width=100% class=bar2 border=1 cellpadding=0 cellspacing=0><tr height=23><TD>&nbsp;消息： " .(int)$_R['id']."</td></tr></table><table width=100% class=bd1 border=1 cellpadding=0 cellspacing=0><tr><TD style=\"padding:5px\"><font class=warningc><b>警告!</b></font><br>$errormsg</td></tr></table>";
}
function showmsg($selectrow){
echo"<table width=100% class=bd1 border=0 cellpadding=0 cellspacing=0>
<tr height=23 class=bar2><TD width=150 align=center>$selectrow->stime</TD><td width=100>$selectrow->fname</td><td><b>$selectrow->title</b></td><td width=50><a class=whitelink href=\"msgs.php?type=3&".($selectrow->type=="0"?"msgid=$selectrow->id\">[回复]":($selectrow->type=="1"?"userid=$selectrow->fid\">[再发]":">[新消息]"))."</a></td></tr>
<tr><td colspan=3 height=200 valign=top style=\"padding:5px;\">$selectrow->msg</td></tr>
</table>";
}
?>
</td></tr></table>

<?php include "../hefo/foot.php"; ?>
</body>
</html>