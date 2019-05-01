<?php include "../func/mustfunc.php"; ?>

<html>
<head>
  <title>著传软件论坛开发组</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="KEYWORDS" content="forum">
  <link rel="stylesheet" type="text/css" href="../theme/<?php echo $_SESSION['sestyle']; ?>/def.css">
  <style>
a.mlink { text-decoration:none; }
a.mlink:link { color:white; }
a.mlink:visited, a.itemlink:active {font:none;color:white;text-decoration : underline;}
a.mlink:hover {color : blue;text-decoration : underline;}
 </style>
</head>
<body leftmargin="0"  topmargin="0" onresize="return tmsize();" onload="f_onload();" >
<?php include "../hefo/head.php"; ?>
<table border=1 width="100%" cellpadding=0 cellspacing=0 height="40"><tr><TD><a href="../index.php"><b>论坛</b></a>>>论坛开发组</TD></tr></table>
<table border=1 width="100%" cellpadding=0 cellspacing=0>
<TR class=bar1 height=32><TD align="center"><b>--- 著 . 传 . 软 . 件 . 论 . 坛 . 开 . 发 . 组 ---</b></TD></TR>
<TR><td height="300" align="center" bgcolor="#ff9000">
<br>
<font color=white><b>欢 &nbsp; 迎 &nbsp; 您  !<br></b>
<br>
<br>
<br>
<table width=60% cellpadding=0 cellspacing=3 style="color:white;">
<Tr><TD width="35%" align="right">团队</TD><td rowspan=9 width=11></td><TD>著传软件论坛开发组</td></tr>
<Tr><TD>&nbsp;</TD><TD></TD></tr>
<Tr><TD align="right">界面设计</TD><TD>宋XX，高X，刘X</TD></tr>
<Tr><TD align="right">编码</TD><TD>宋XX，老宋，高X，李XX，楚楚，张XX</TD></tr>
<Tr><TD align="right">Email</TD><TD><a class=mlink href="mailto:info@eieusoft.com">info@eieusoft.com</a></TD></tr>
<Tr><TD align="right">电话</TD><TD>13013083276</TD></tr>
<Tr><TD align="right">QQ</TD><TD>723785006</TD></tr>
</table>
<br>
<br>
<br>
<a class=mlink href="javascript:userreturn()">[&nbsp;&nbsp;&nbsp;返回&nbsp;&nbsp;&nbsp;]</a>
</font></Tr></TR>
<TR class=bar1 height="23"><TD align="center"><b>--- 论 . 坛 . 开 . 发 . 组 ---</b></TD></TR>
</table>
<br>
<script language="JavaScript">
function userreturn(){
	history.go(-1);
}
function f_onload(){
	//userwitting();
}
</script>
<?php include "../hefo/foot.php"; ?>
</body>
</html>