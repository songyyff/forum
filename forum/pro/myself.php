<?php include "../func/mustfunc.php";

//判权
if(!($uid=$_S['seuserid']))f_toerror("nologin");//未登陆
if(($VT=(int)$_R['type'])<0||$VT>5)$VT=0;
//计算页面数
if(1>$CP=(int)@$_R['page'])$CP=1;
//提取用户信息
if(isset($_R['recount']))include "s/recn.php";
$q="select * from tuser where id=$uid";
$rs=mysql_query($q) or die(f_e($q));
if(!$ur=mysql_fetch_object($rs))f_toerror("nouser");
mysql_free_result($rs);
if($ur->stat!='E')f_toerror("userdisabled");

?>

<html>

<head>
  <title>我的面版</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php  echo"<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/def.css>
",$VT==5?"<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/emsg.css>":"";?>
</head>

<body>
<?php include"../hefo/head.php";?>

<div class=gud><a href="../index.php"><b>论坛</b></a>>>我的面版</div>

<form id=mainform enctype="multipart/form-data" method="POST" action="?type=<?php echo "$VT&page=$CP";?>">
<table width=100% cellpadding=0 cellspacing=0>
<tr>
<TD width=200 valign=top style="padding:2px;padding-left:0px;">

<div class=O>菜单</div>

<pre class=menu>
<?php
echo"<a href='?type=0'>我的订阅</a>($ur->sbnu)
<a href='?type=1'>我的好友</a>($ur->fnum)
<a href='?type=2'>我的帖子</a>($ur->inum/$ur->dnum)
<a href='?type=3'>我的回复</a>($ur->rnum/$ur->drnu)
";
?>
<a href='?type=4'>我的权限</a>
<a href='?type=5'>我的资料</a>
</pre>

<?php
function showi($r){
echo"<div class=O>我自己</div>
<div id=H align=center><img id=head0 onload=RO(this) src=../faces/$r->face></div>
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

showi($ur);
?>
</TD>
<td valign="top" style="padding-top:2px;padding-bottom:2px;">
<?php
switch($VT){
case 0:	//订阅
include"r/mytake.php";break;
case 1:	//好友
include"r/myfrid.php";break;
case 2:	//帖子
include"r/mynote.php";break;
case 3:	//回复
include"r/myrpy.php";break;
case 4:	//权限
include"r/myrigt.php";break;
case 5:	//资料
include"r/mydeta.php";break;
}
?>
</td></tr></table>
</FORM>

<?php include "../hefo/foot.php"; ?>
</body>
</html>