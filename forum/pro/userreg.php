<?php include "../func/mustfunc.php";

if($_S[seuserid])header("Location: ./index.php");

if(1!=$constep=(int)$_R['regstep'])$constep=0;
$userexist=0;
//添加用户
if(isset($_R["username"])){$_R['isaltermain']=1;$sub="ur";include"r/s/mydtck.php";}
?>
<html>
<head>
  <title>用户注册</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php  echo"<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/def.css>
",$constep==1?"<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/emsg.css>":"";?>
</head>
<body onload="f_onload()" >
<?php include "../hefo/head.php"; ?>
<table border=1 width=100% cellpadding=0 cellspacing=0 height="40"><tr><TD><a href="../index.php"><b>论坛</b></a>>>用户注册</TD></tr></table>
<?php
include"r/ru$constep.php";
include "../hefo/foot.php";
?>
</body>
</html>