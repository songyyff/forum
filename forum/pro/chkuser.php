<?php include "../func/mustfunc.php"; ?>
<html>
<head>
  <title>检验注册用户名</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="../theme/<?php echo $_SESSION['sestyle']; ?>/def.css">
</head>
<body leftmargin="0"  topmargin="0">
<table border=1 width=100% cellpadding=0 cellspacing=0 class=bgc style="height:100%" >
<tr height=50><TD align="center" class="bar2">用户名: <?php echo f_rpspc($_REQUEST['uname']); ?></TD></tr>
<tr><TD align="center">
<?php
$query="select id from tuser where name=\"".f_rpspc($_REQUEST['uname'])."\"";
$result=mysql_query($query) or die(f_e($query));
if(mysql_num_rows($result)>0) echo "此用户名已经被注册，请改名 ToT";
else echo "此用户名未被注册，请赶快注册:)";
mysql_free_result($result);
?>
</TD></tr>
<tr height=40><TD align="center" class="bar2"><input id=closebutton type="button" onclick="javascript:window.close();" value=" 关闭 "></TD></tr>
</table>
<script language="JavaScript">
var waitingtime=61;
document.getElementById("closebutton").value=" ("+waitingtime+") 关闭 ";
function wittingclose(){
	if(waitingtime-- >0){
		document.getElementById("closebutton").value=" ("+waitingtime+") 关闭 ";
		setTimeout(wittingclose,1000);
	} else window.close();
}
wittingclose();
</script>
</body>
</html>
