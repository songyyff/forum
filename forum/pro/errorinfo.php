<?php
include "../func/mustfunc.php";
?>
<html>
<head>
<title>论坛错误</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../theme/<?php echo$_S[sestyle];?>/def.css">
</head>
<body>
<?php include "../hefo/head.php"; ?>

<div class=gud><a href=index.php><b>论坛</b></a>>>错误</div>

<table width=100% cellpadding=5 cellspacing=0>
<TR class=tr><TD id=b align=center>论坛错误 T_T
<TR><td class=bb height=270 align="center">
<?php

$q="select * from tdict use index(ki) where type=14 and ikey='$_S[seerrorid]'";
$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
mysql_free_result($R);

echo "<br><br><br>$r->info2<br><br>",date("Y-m-d H:i:s");

?>
<TR class=tr><td class=blr align=center><a href="javascript:userreturn()">[ 返回 ]</a>
</table>
<?php include "../hefo/foot.php"; ?>
<script src="../js/must.js"  language="JavaScript"></script>
</body>
</html>