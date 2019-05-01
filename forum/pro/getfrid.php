<?php include "../func/mustfunc.php"; ?>
<html>
<head>
  <title>添加朋友</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="../theme/<?php echo $_SESSION['sestyle']; ?>/def.css">
</head>
<body leftmargin="0"  topmargin="0" class=bgc>
<table border=1 width=100% cellpadding=0 cellspacing=0 style="height:100%">
<tr class=bar2 height=50><TD align="center">添加朋友</TD></tr>
<tr><TD align="center">
<?php 
if(isset($_SESSION['seuserid'])){
	if(isset($_REQUEST['userid'])){
		$q="select id,name from tuser where id=".(int)$_REQUEST['userid'];
		$R=mysql_query($q) or die(f_e($q));
		if(mysql_num_rows($R)){
			$fridrow=mysql_fetch_object($R);
			$q="select uid from tfrid where uid=".$_SESSION['seuserid']." and fid=$fridrow->id";
			$R1=mysql_query($q) or die(f_e($q));
			if(mysql_num_rows($R1)) echo "<font class=lightfont>$fridrow->name</font><br><br>已经是您的朋友，不需要再次添加。 ^_^";
			else{
				$q="insert tfrid(uid,fid,ctime) values(".$_SESSION['seuserid'].",$fridrow->id,now());";
				mysql_query($q) or die(f_e($q));
				$q="update tuser set fnum=fnum+1 where id=".$_SESSION['seuserid'];
				mysql_query($q) or die(f_e($q));
				echo "<font class=lightfont>$fridrow->name</font> 已经成功加为您的朋友。 ^_^";
			}
			mysql_free_result($R1);
		}else echo "您想添加为朋友人的资料未找到<br><br>任务无法完成。 ToT";
		mysql_free_result($R);
	}else echo "查询参数不完整<br><br>无法完成任务。 ToT";
}else echo "您还未登陆<br><br>非常抱歉，不能使用此功能。 ToT";
?>
</TD></tr>
<tr class=bar2 height=40><TD align="center"><input id=closebutton type="button" onclick="javascript:window.close();" value="关闭"></TD></tr>
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
