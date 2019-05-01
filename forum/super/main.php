<?php 
include "../func/mustfunc.php";
if(!($uid=$_S['seuserid']))f_toerror("nologin");
$vtype=(int)$_R['type'];
$q="select * from tspu where uid=$uid and gid=0";
$rs=mysql_query($q) or die(f_e($q));
$n=mysql_num_rows($rs);
mysql_free_result($rs);
if(!n)f_toerror("noright");
?>
<html>
<head>
<title>论坛超级管理工具</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../theme/<?php echo $_S['sestyle']; ?>/def.css">
<?php if($vtype==4)echo"<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/edit.css>
";?>
</head>
<body>
<style>
.menupre{
line-height:30px;
}
.subhead{
text-align:right;
line-height:30px;
}
</style>
<table width="100%" cellspacing=0 cellpadding=5>
<tr>
<td width=200 valign=top class=bdr1>
<pre class=menupre>
<b><a href=".." target=blank>论坛</a>超级管理工具集</b>
<hr>
<a href=?type=1>论坛资料设置</a>
<a href=?type=2>发送邮件参数设置</a>
<a href=?type=9>论坛支持视频网站</a>
<a href=?type=3>论坛结构管理</a>
<hr>
<a href=?type=4>论坛表情图标管理</a>
<a href=?type=5>论坛系统保留头像管理</a>
<a href=?type=6>论坛徽章管理</a>
<hr>
<a href=?type=7>SQL工具</a>
<hr>

</pre>
<pre>
	
<a href="http://www.eieusoft.com" target=home>著传软件</a> <font face=Arial>&reg;</font> V2012.1
Copyright<font face=Arial>&copy;</font> 2008-<?php echo date("Y");?>
</pre>
</td>
<td valign=top><?php
switch($vtype){
case 1:include "setforum.php";break;
case 2:include "setmail.php";break;
case 3:include "forums.php";break;
case 4:include "emotion.php";break;
case 5:include "userheads.php";break;
case 6:include "bedge.php";break;
case 7:include "sql.php";break;
case 8:include "emtype.php";break;
case 9:include "mediatype.php";break;
default:include "setforum.php";
}
?></td>
</tr>
<table>
</body>
</html>