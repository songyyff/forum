<?php

include"../func/mustfunc.php";

if(($VT=(int)$_REQUEST['type'])<0||$VT>2)$VT=0;

$q="select *,(select info from tdict where type=5 and key1=tuser.level)as ulvl from tuser where id=".(int)$_REQUEST['userid'];
$R=mysql_query($q) or die(f_e($q));
if(!$U=mysql_fetch_object($R))f_toerror(nouser);//查无用户
if($U->stat!='E'&&!$_SESSION['seismng'])f_toerror(userdisabled);//用户无效
mysql_free_result($R);

?>

<html>

<head>
<title>用户信息</title>
<meta http-equiv="Content-Type" content="text/html" charset=utf-8>
<link rel="stylesheet" type="text/css" href="../theme/<?php echo $_SESSION['sestyle']; ?>/def.css">
</head>

<body>

<?php include "../hefo/head.php"; ?>

<div class=gud><a href="../index.php"><b>论坛</b></a>>>用户信息</div>

<table width=100% cellpadding=0 cellspacing=0>
<tr>
<TD width=200 valign=top style=padding:2px;padding-left:0px;>
<div class=O>菜单</div>
<pre class=menu>
<?php
echo "<a href='?type=0&userid=$U->id'>用户资料</a>
<a href='?type=1&userid=$U->id'>所有帖子</a> ($U->inum)
<a href='?type=2&userid=$U->id'>所有回复</a> ($U->rnum)";
?>
</pre>
<div class=O>用户</div>
<style>
.bp5 img{vertical-align:text-bottom;margin-right:3px;}
</style>
<?php

function showi($r){
echo"<div id=H align=center><img onload=RO(this) src=../faces/$r->face></div>",
$_SESSION['seuserid']?"
<div class=bp5 style=border-bottom:0><img src=../images/f.png><a href=\"javascript:getfriend($r->id)\">加为朋友</a> <img src=../images/m.png><a href=\"msgs.php?type=3&userid=$r->id\">发送消息</a></div>
":"",
"<pre id=ui>用户 <a class=goldlink href=\"../pro/userinfo.php?userid=$r->id\">$r->name</a>
性别 ",$r->sex?"男":"女","
状态 ".(f_isonline($r->ltime)?"不在线":"<font color=#ff800>在线</font>")."
积分 $r->inte
金钱 $r->money
等级 $r->level
贴数 $r->inum
回复数 $r->rnum
阅读权力 $r->rdnum
注册时间 ".f_date($r->ctime)."
累积在线 $r->ontime 分钟</pre>";
}

showi($U);
?>
<td valign="top" style="padding-top:2px;padding-bottom:2px;">
<?php
switch($VT){
case 0:
include "r/uuser.php";break;
case 1:
include "r/unote.php";break;
case 2:
include "r/urpl.php";
}
?>
</td></tr></table>
<script language="JavaScript" src="../js/pro/ui.js"></script>
<?php include("../hefo/foot.php"); ?>
</body>
</html>