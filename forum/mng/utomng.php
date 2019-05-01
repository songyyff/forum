<?php include "../func/mustfunc.php";
if($sts=(isset($_SESSION['seuserid'])&&$_SESSION['seismng'])){
	$uid=$_SESSION['seuserid'];
	if(isset($_REQUEST['uid'])){
		$id=(int)$_REQUEST['uid'];
		$q="select box from tmng where uid=$uid and type=2 and num=$id";
		$rc=mysql_query($q) or die(f_e($q));
		if($crow=mysql_fetch_object($rc)){
			$msg="此[ $id ]用户已经被加管，";
			if($crow->box!=2){
				$nd=1;
				$q="update tmng set box=box-1 where uid=$uid and type=7 and num=$crow->box";
				mysql_query($q) or die(f_e($q));
				$msg.="从[ $crow->box ]管理箱转到了[ 新加贴 ]管理箱,";
			}else $nd=0;
			$q="update tmng set box=2,ctime=now() where uid=$uid and type=2 and num=$id";
			mysql_query($q) or die(f_e($q));
		}else{
			$nd=1;
			$q="insert into tmng(uid,type,box,num,ctime) values($uid,2,2,$id,now())";
			mysql_query($q) or die(f_e($q));
		}
		if($nd){
			$q="update tmng set box=box+1 where uid=$uid and type=7 and num=2";
			mysql_query($q) or die(f_e($q));
		}
		mysql_free_result($rc);
		$msg.="任务完成。 ^_^";
	}else $msg="查询参数不完整, 无法完成任务。 T_T";
	$q="select box from tmng where uid=$uid and type=7 and num=2";
	$R=mysql_query($q) or die(f_e($q));
	$rowc=mysql_fetch_object($R)->box;
	mysql_free_result($R);
}
?>
<html>
<head>
  <title>帖子加入管理</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="../theme/<?php echo $_SESSION['sestyle']; ?>/def.css">
</head>
<body leftmargin=0 topmargin=0 class=bgc>
<table border=1 width="100%" cellpadding=0 cellspacing=0 style="height:100%">
<tr class=bar2 height=50><TD align="center">用户加入管理<?php echo $rowc?"($rowc)":""; ?></TD></tr>
<tr><TD align=center>
<?php
if($sts){
	if($msg)echo "<font class=warningc>$msg</font>";
	$q="select t1.ctime,t2.id,t2.name,t2.rigt,t2.inum,t2.dnum,t2.rnum,t2.drnu from tmng as t1 force index(ind) left join tuser as t2 force index(primary) on t1.num=t2.id where t1.uid=$uid and t1.type=2 and t1.box=2 order by t1.ctime desc limit 20";
	$R=mysql_query($q) or die(f_e($q));
	if($len=mysql_num_rows($R)){
		echo "<table width=100% class=bdb1 border=1 cellpadding=0 cellspacing=0><tr height=23><td width=5></td><td width=150 valign=bottom>&nbsp;加管时间</td><td valign=bottom>ID.用户 帖(有/无)效数 回复[有/无]效数</td></tr></table>
<div style=\"padding:5px;overflow:scroll;height:406px;\"><table width=100% border=1 cellpadding=5 cellspacing=0>";
		for($i=0;$i<$len;$i++){
			$r=mysql_fetch_object($R);
			echo "<tr class=",$i&1?"light":"dark","bar height=22>
<td",$i?" class=bdt1":""," width=150>$r->ctime</td>
<td",$i?" class=bdt1":"",">$r->id.$r->name ($r->inum/$r->dnum) [$r->rnum/$r->drnu]</td>
</tr>";
		}
		echo "</table></div>";
	}else echo "--- 没有记录 ---";
	mysql_free_result($R);
}else echo "<font class=warningc>您还未登陆,或者不是管理员<br><br>非常抱歉，不能使用此功能。</font> T_T";

?>
</TD></tr>
<tr class=bar2 height=40><TD align="center"><input type="button" onclick="javascript:window.close();" value=" 关闭 "></TD></tr>
</table>
</body>
</html>