<?php include_once("../func/mustfunc.php");
//判权
if(!$mid=$_S['seuserid'])f_toerror("nologin");	//未登陆
if(!$_S['seismng'])f_toerror("notmng");	//不是管理员
if(!$uid=(int)$_R['userid'])f_toerror("urlneedvar");

//提取用户信息
$q="select * from tuser where id=$mid";
$rs=mysql_query($q) or die(f_e($q));
if($ur=mysql_fetch_object($rs));else f_toerror("nouser");
mysql_free_result($rs);
?>
<html>

<head>
<title>管理员面版</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../theme/<?php echo $_S['sestyle']; ?>/def.css">

<style>
P{margin:0}
fieldset{margin-top:10px;margin-bottom:10px}
</style>

</head>

<body leftmargin="0"  topmargin="0" onresize="return tmsize();" onload="f_onload();" >
<?php include("../hefo/head.php"); ?>
<div class=gud><a href="../index.php"><b>论坛</b></a>>>管理员面版</div>

<table width=100% cellpadding=0 cellspacing=0>
<TD width=200 valign=top style=padding:2px;padding-left:0px>

<P class=O>菜单</P>

<pre class=leftmenu>
<a class="whitelink" href="mng.php?type=0">论坛管理</a>
<a class="whitelink" href="mng.php?type=1">帖子管理</a>   <a class="whitelink" href="mng.php?type=2">搜索</a>
<a class="whitelink" href="mng.php?type=3">回复管理</a>   <a class="whitelink" href="mng.php?type=4">搜索</a>
<a class="whitelink" href="mng.php?type=5">用户管理</a>   <a class="whitelink" href="mng.php?type=6">搜索</a>
<a class="whitelink" href="mng.php?type=7">管理维护</a>
</pre>

<P class=O>我自己</P>

<?php
function showuserinfo($r,$i){
echo "<p class=blrp5 align=center><img id=face$i src=\"../faces/$r->face\"/></p><pre id=b class=userinfo>用户 <a class=goldlink href=\"../pro/userinfo.php?userid=$r->id\"><span id=username$i>$r->name</span></a>
性别 $r->sex
状态 ".(f_isonline($r->ltime)?"不在线":"<font color=#ff800>在线</font>")."
积分 $r->inte
金钱 $r->money
等级 $r->level
贴数 $r->inum
回复数 $r->rnum
阅读权力 $r->rdnum
注册时间 ".f_date($r->ctime)."
累积在线 $r->ontime 分钟";
}
showuserinfo($ur,0);
?>

<td valign=top style=padding-top:2px;padding-bottom:2px>

<script language="JavaScript">
<?php echo "var mei=[$ur->id,\"$ur->name\"];\n"; ?>
v_loaded=1;
function resizepic(obj){if(obj)if(obj.width>obj.height){if(obj.width>188)obj.width=188;}else if(obj.height>188)obj.height=188;}
function f_onload(){
if(v_loaded){v_loaded=0;resizepic(G('face0'));}
}
</script>

<P class=O><a id=fr class=whitelink href=javascript:submit()>[ 提交 ]</a>颁发徽章</P>

<fieldset>
<?php
//提取用户信息
$q="select i.*,
(select GROUP_CONCAT(m.ltime,\" <a href=../pro/userinfo.php?userid=\",uid,\">\",u.name,\"</a>:\\\n\",m.comm SEPARATOR \"\\\n\")
from tmng as m use index(tn) left join tuser as u on m.uid=u.id where m.type=11 and m.num=$uid group by m.type) as mc
from tuser as i where i.id=$uid";
$rs=mysql_query($q) or die(f_e($q));
$u=mysql_fetch_object($rs);
mysql_free_result($rs);

if($u){
echo"<legend>用户资料：用户名 <a href=\"../pro/userinfo.php?userid=$u->id\" target=blank>$u->name</a> | 性别 $u->sex | 生日 $u->bhday</legend>
<pre class=dbline>阅读权限 $u->rdnum | 金钱数 $u->money | 积分 $u->inte | 等级 $u->level | 好友数量 $u->fnum | 订阅帖子数量 $u->sbnu | 获得徽章数量 $u->bgs | 界面风格 $u->styl
有效帖子数量 $u->inum | 有效回复数量 $u->rnum | 无效帖数 $u->dnum | 无效回复数 $u->drnu | 被删除贴数 $u->deli | 被删除回复数 $u->delr
注册时间 $u->ctime | 在线分钟数 $u->ontime | 最后访问时间 $u->ltime | 用户最后登陆ip $u->ip
用户状态 $u->stat | 用户权限 ",base_convert($u->rigt,10,2)," | 管理论坛数量 $u->gmnu | 最后被管理时间 $u->lmtm
其他管理员评说:
$u->mc";
if(isset($_R[altbg])||isset($_R[givebg]))include "s/bg.php";
}else echo "用户ID: $uid 不存在！";
?>
</pre>
</fieldset>

<form method=post>
<fieldset>
<legend>用户已获得徽章</legend>
<div id=userbgs></div>
</fieldset>
<fieldset>
<legend>系统可颁发徽章</legend>
<div id=sysbgs></div>
</fieldset>
</form>

<P class=O><a id=fr class=whitelink href=javascript:submit()>[ 提交 ]</a>颁发徽章</P>

</table>

<style>
#userbgs td{border-top:1px solid #c0c0c0}
#sysbgs td{border-top:1px solid #c0c0c0}
</style>

<div id=uData style=visibility:hidden;width:100;height:100;overflow:scroll;position:absolute;top:0;><?php
$q="select b.*,u.name from bgs as b left join tuser as u on(b.mid=u.id) where b.uid=$uid order by b.s";
$rs=mysql_query($q) or die(f_e($q));
$n=mysql_num_rows($rs);
while($r=mysql_fetch_object($rs))echo"<p>$r->id,$r->s,$r->bg,$r->r,$r->mid<p>$r->n<p>$r->q<p>$r->a<p>$r->name";
mysql_free_result($rs);
?></div>

<div id=sData style=visibility:hidden;width:100;height:100;overflow:scroll;position:absolute;top:0;><?php
$q="select * from bgs where uid=0 order by s";
$rs=mysql_query($q) or die(f_e($q));
$n=mysql_num_rows($rs);
while($r=mysql_fetch_object($rs))echo"<p>$r->id,$r->s,$r->bg<p>$r->n<p>$r->q";
mysql_free_result($rs);
?></div>

<script src="js/bg.js" language=javascript></script>
<?php include "../hefo/foot.php"; ?>
</body>
</html>