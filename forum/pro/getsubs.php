<?php include "../func/mustfunc.php"; ?>
<html>
<head>
  <title>订阅帖子</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="../theme/<?php echo $_SESSION['sestyle']; ?>/def.css">
</head>
<body class=bgc>
<table width=100% cellpadding=0 cellspacing=0 style="height:100%">
<tr class=bar2 height=50><TD align="center">订阅帖子</TD></tr>
<tr><TD align=center class="pd1">
<?php
function havegroupmngright($gid,$actmask){
$right=false;
if(!isset($_SESSION["seuserid"])) return $right;
$q="select * from tspu where uid=\"".$_SESSION["seuserid"]."\" and gid=\"".$gid."\"";
$R=mysql_query($q) or die(f_e());
if(mysql_num_rows($R)){
	$row=mysql_fetch_object($R);
	$right=((int)$row->rigt & $actmask);
}
mysql_free_result($R);
return $right;
}

if(isset($_SESSION['seuserid'])){
	if(isset($_REQUEST['noteid'])){
//do{
		$q="select t1.id,t1.uid,t1.title,t1.rigt,t1.rdnum,t2.rigt as grigt,t2.level from titem as t1 force index(PRIMARY),tgup as t2 force index(PRIMARY) where t1.id=".(int)$_REQUEST['noteid']." and t1.stat='E' and t1.gid=t2.id and t2.stat='E'";
		$R=mysql_query($q) or die(f_e($q));
		if(mysql_num_rows($R)){
			$row=mysql_fetch_object($R);
			echo "<font class=lightfont>".substr($row->title,0,79)." </font><br><br>";

			if((($_SESSION['seright']&(int)$row->rigt&(int)$row->grigt&$right_saved['userview'])&&$row->level<=$_SESSION['selevel']&& $row->rdnum<=$_SESSION['serdright'])||(($_SESSION['seright']&(int)$row->rigt&(int)$row->grigt&$right_saved['userview'])&&$row->level<=$_SESSION['selevel']&&$row->uid==$_SESSION['seuserid'])||($_SESSION['seismng']&&havegroupmngright($grouprow->id,$right_saved['superview']))){ //有权访问

				$q="select * from tsubs force index(id) where uid=".$_SESSION['seuserid']." and iid=".(int)$_REQUEST['noteid'];
				$R1=mysql_query($q) or die(f_e($q));
				if(mysql_num_rows($R1)){
					$q="update tsubs set ctime=now() where uid=".$_SESSION['seuserid']." and iid=".(int)$_REQUEST['noteid'];
					mysql_query($q) or die(f_e($q));
					echo "此帖子已经被您订阅；<br><br>现已提升到了订阅第一位。 ^_^";
				}else{
					$q="insert tsubs(uid,iid,ctime) values(".$_SESSION['seuserid'].",".(int)$_REQUEST['noteid'].",now());";
					mysql_query($q) or die(f_e($q));
					$q="update tuser set sbnu=sbnu+1 where id=".$_SESSION['seuserid'];
					mysql_query($q) or die(f_e($q));
					echo "您已经成功订阅此帖。 ^_^";
				}
				mysql_free_result($R1);
			}else echo "您的权限不够<br><br>任务无法完成。 ToT";
		}else echo "您想订阅的帖子资料未找到或帖子处于无效状态<br><br>任务无法完成。 ToT";
		mysql_free_result($R);
//}while(0);
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
	if(waitingtime--){
		document.getElementById("closebutton").value=" ("+waitingtime+") 关闭 ";
		setTimeout(wittingclose,1000);
	} else window.close();
}
wittingclose();
</script>
</body>
</html>