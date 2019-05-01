<?php include "../func/mustfunc.php";
//判权
if(!$_S['seuserid'])f_toerror("nologin");	//未登陆

if(($VT=(int)$_R['type'])<0||$VT>5)$VT=0;

$q="select * from tuser where id=".$_S['seuserid'].";";
$R=mysql_query($q) or die(f_e($q));
if($R)$su=mysql_fetch_object($R);else f_toerror("nouser");
if($su->stat!='E')f_toerror("userdisabled");

switch($VT){
case 0:	//收件箱
case 1:	//已发邮件箱
case 2:	//删除邮件箱
	if(1>$CP=(int)$_R['page'])$CP=1;
	if($_R['delmsg'])include "s/msg012.php";
break;
case 3:	//发送消息
	if($_R[til])include"s/msgck.php";elseif($_R['userid']||$_R['msgid'])include"r/msg33.php";
break;
case 5:
	if(!ctype_digit($_R['msgid']))f_toerror("urlerror");
}

if($su->inmnu&&$su->rmnu<$su->maxr)include "r/msgov.php";

$_S["semsgs"]=($su->nmnu?"(<font class=lightfont>$su->nmnu</font>)":"").($su->rmnu>=$su->maxr||$su->smnu>=$su->maxs||$su->dmnu>=$su->maxd?"[过载]":"");
?>

<html>

<head>
<title>消息箱</title>
<meta http-equiv="Content-Type" content="text/html charset=utf-8">
<?php echo"
<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/def.css>",
$VT==3?"<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/edit.css>":"","
";?>
<script language=javascript src=../js/js.js></script>
</head>

<body>
<?php include"../hefo/head.php"; ?>

<div class=gud><a href="../index.php"><b>论坛</b></a>>>消息箱</div>

<?php
//计算页面数
switch($VT){
case 0: $msgcount=$su->rmnu;$tstr="已收到消息";$limt=$su->maxr;break;
case 1: $msgcount=$su->smnu;$tstr="已发送消息";$limt=$su->maxs;break;
case 2: $msgcount=$su->dmnu;$tstr="被删除消息";$limt=$su->maxd;
}

//显示信箱状态
if($su->inmnu||$su->rmnu>=$su->maxr||$su->smnu>=$su->maxs||$su->dmnu>=$su->maxd){
echo "<div class=bp5>
<font class=warningc><b>警告!</b></font><br>",
$su->inmnu?"您有 <b>$su->inmnu</b> 条新消息未入站，请删除 [收到消息箱] 内不需要的消息，才能接收新消息<br>":"",
$su->rmnu>=$su->maxr?"您的 [收到消息箱] 已满，最大容量为[<b>$su->maxr</b>]，请删除不需要的消息<br>":"",
$su->smnu>=$su->maxs?"您的 [已发送消息箱] 已满，最大容量为[<b>$su->maxs</b>]，请删除不需要的消息<br>":"",
$su->dmnu>=$su->maxd?"您的 [被删除消息箱] 已满，最大容量为[<b>$su->maxd</b>]，请删除不需要的消息":"",
"
</div>";
}
?>

<form id=msgform method="POST" action="?type=<?php echo$VT;
if($VT<3) echo "&page=$CP";
?>">
<table width=100% cellpadding=0 cellspacing=0><tr>
<TD width=200 valign=top style="padding:2px;padding-left:0px;">

<div class=O>菜单</div>

<pre class=menu>
<?php echo"<a href=?type=0>已收消息箱</a>($su->nmnu/$su->rmnu)
<a href=?type=1>已发送消息箱</a>($su->smnu)
<a href=?type=2>被删除消息箱</a>($su->dmnu)
<a href=?type=3>发送消息</a>
<a href=?type=4>接受/拒绝 消息人</a>
";?>
</pre>

<div class=O>好友</div>

<pre class=FP>
<?php
$q="select t2.id,t2.name,t2.ltime from tfrid as t1 use index(uid) left join tuser as t2 use index(PRIMARY) on(t2.id=t1.fid) where t1.uid=$_S[seuserid] and type=0 order by t2.ltime desc,t2.name desc;";
$R=mysql_query($q) or die(f_e($q));

if($FF=mysql_num_rows($R))for($i=0; $i<$FF; $i++){
$r=mysql_fetch_object($R);
echo$i?"
":"", $VT==3?"<input type=checkbox class=fr id=fird$i onclick=clickfriend($i) name=friends[] value=$r->id>":"<a id=fr href='?type=3&userid=$r->id'><i>三[]</i></a>",f_isonline($r->ltime)?"下线":"<tt class=lightfont>在线</tt>"," <a href='userinfo.php?userid=$r->id'>[$r->name]</a>";
}
else echo"--- 还没朋友 ---";
mysql_free_result($R);
?></pre><td valign="top" id="msgmaintd" style="padding-top:2px;padding-bottom:2px;">
<?php include"r/msg".($VT<3?0:$VT).".php";?>
</table>
</FORM>

<?php include_once("../hefo/foot.php"); ?>

</body>
</html>
