<?php include_once("../func/mustfunc.php");
//判权
if(!$uid=$_S['seuserid'])f_toerror("nologin");
if(!$_S['seismng'])f_toerror("notmng");
$vartype=isset($_R['type'])?(int)$_R['type']:9;
//计算页面数
if(1>$cpage=(int)$_R['page'])$cpage=1;
switch($vartype){
case 0:	//论坛管理
	$q="select t1.gid,t1.rigt as srigt,t1.level as slevel,t1.ctime as sctime,t2.* from tspu as t1 force index(unind) left join tgup as t2 on t1.gid=t2.id where t1.uid=$uid".(isset($_R['gid'])?" and t1.gid=".(int)$_R['gid']:"")." limit 1";
	$R=mysql_query($q) or die(f_e($q));
	if($len=mysql_num_rows($R))$grow=mysql_fetch_object($R);
	mysql_free_result($R);
	if(!$len){$_S["seerrorid"]="notgmng";f_toerror();}	//不是此论坛管理员
	if(!$grow->gid) $grow->name="根论坛";
break;
case 2:	//帖子管理
break;
case 4:	//回复管理
break;
case 6:	//用户管理
break;
}

//提取用户信息
$q="select * from tuser where id=$uid";
$R=mysql_query($q) or die(f_e($q));
if($userrow=mysql_fetch_object($R));else{$_S["seerrorid"]="nouser"; f_toerror();}
mysql_free_result($R);
?>


<html>

<head>
<title>管理员面版</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../theme/<?php echo $_S['sestyle']; ?>/def.css">
</head>

<body leftmargin="0"  topmargin="0" onresize="return tmsize();" onload="f_onload();" >
<?php include("../hefo/head.php"); ?>

<div class=gud><a href="../index.php"><b>论坛</b></a>>>管理员面版</div>

<table width="100%" cellpadding=0 cellspacing=0>
<tr>
<TD width="200" valign="top" style="padding:2px;padding-left:0px;">
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23><TD>&nbsp;菜单</td></tr>
</table>
<pre class=leftmenu>
<a class="whitelink" href=?type=0>论坛管理</a>
<a class="whitelink" href=?type=1>帖子管理</a>   <a class="whitelink" href=?type=2>搜索</a>
<a class="whitelink" href=?type=3>回复管理</a>   <a class="whitelink" href=?type=4>搜索</a>
<a class="whitelink" href=?type=5>用户管理</a>   <a class="whitelink" href=?type=6>搜索</a>
<a class="whitelink" href=?type=7>管理维护</a>
</pre>
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23><TD>&nbsp;我自己</TD></tr>
</table>
<?php

function showi($r){
echo"<div id=H align=center><img onload=\"RO(this)\" src=\"../faces/$r->face\"/></div>
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
showi($userrow);
?>
</TD>
<td valign="top" style="padding-top:2px;padding-bottom:2px;">
<script language="JavaScript">
<?php echo "var mei=new Array($userrow->id,\"$userrow->name\");\n"; ?>
function resizepic(obj){if(obj)if(obj.width>obj.height){if(obj.width>188)obj.width=188;}else if(obj.height>188)obj.height=188;}
v_loaded=1;
function f_onload(){
if(v_loaded){v_loaded=0;resizepic(G('face0'));}
}
</script>
<?php
$c=" checked";$s=" disabled";$d=" selected";
$ps=$_S['seitsize'];
switch($vartype){
case 0:include "g.php";break;//论坛
case 1:include "i.php";break;//帖子
case 2:include "is.php";break;//帖子搜索
case 3:include "r.php";break;//回复
case 4:include "rs.php";break;//回复搜索
case 5:include "u.php";break;//用户
case 6:include "us.php";break;//用户搜索
case 7:include "sys.php";break;//管理
default:include "pl.php";break;//管理面版
}
?>
</td></tr></table>
<?php include "../hefo/foot.php"; ?>
</body>
</html>