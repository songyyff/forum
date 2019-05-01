<?php include "../func/mustfunc.php"; 
//判权
if(($VT=(int)$_R['type'])<0||$VT>1)$VT=0;
//计算页面数
if(1>$CP=(int)$_R['page'])$CP=1;
$uid=$_SESSION['seuserid'];
if($uid){
$q="select * from tuser where id=$uid";
$R=mysql_query($q) or die(f_e($q));
if(mysql_num_rows($R))$ur=mysql_fetch_object($R);
else f_toerror("nouser");//查无次用户
mysql_free_result($R);
}
?>


<html>
<head>
<title>论坛搜索</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../theme/<?php echo $_SESSION['sestyle']; ?>/def.css">
</head>
<body>
<?php include("../hefo/head.php"); ?>

<div class=gud><a href="../index.php"><b>论坛</b></a>>>搜索</div>

<table width=100% border=1 cellpadding=0 cellspacing=0>
<tr>
<TD width="200" valign="top" style="padding:2px;padding-left:0px;" height="300">

<div class=O>菜单</div>

<pre class=menu>
<a href=?type=0>快速查询</a>
<a href=?type=1>全文查询</a>
</pre>

<?php

//<a href=\"?type=2\">精确文字查询</a>

function showi($r){
echo"<div class=O>我自己</div>
<div id=H align=center><img onload=\"RO(this)\" src=\"../faces/$r->face\"/></div>
<pre id=ui>用户 <a class=goldlink href=\"../pro/userinfo.php?userid=$r->id\">$r->name</a>
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

if($uid)showi($ur);

?>
</td>
<td valign=top style="padding-top:2px;padding-bottom:2px;">

<?php include"r/ser$VT.php";?>

</td></tr></table>

<script language="JavaScript" src="js/sh.js"></script>
<?php include"../hefo/foot.php"; ?>
</body>
</html>