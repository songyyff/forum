<?php include "../func/mustfunc.php";
if($sts=(isset($_SESSION['seuserid'])&&$_SESSION['seismng'])){
	$uid=$_SESSION['seuserid'];
	if(isset($_REQUEST['iid'])){
		$id=(int)$_REQUEST['iid'];
		//$q="select ((select gid from titem where id=$id) in (select gid from tspu where uid=$uid)) as i1";
		$q="select t1.gid,t2.uid from titem as t1 left join tspu as t2 on t2.uid=$uid and t1.gid=t2.gid where t1.id=$id"; 
		$R=mysql_query($q) or die(f_e($q));
		$r=mysql_fetch_object($R);
		mysql_free_result($R);
		if($r){
		if($r->uid){
			include "../mng/lock.php";
			if(!getlock("titem",$id,3)){
				$q="select box from tmng where uid=$uid and type=0 and num=$id";
				$rc=mysql_query($q) or die(f_e($q));
				if($crow=mysql_fetch_object($rc)){
					$msg="此[ $id ]帖子已经被加管，";
					if($crow->box!=2){
						$nd=1;
						$q="update tmng set box=box-1 where uid=$uid and type=5 and num=$crow->box";
						mysql_query($q) or die(f_e($q));
						$msg.="从[ $crow->box ]管理箱转到了[ 新加贴 ]管理箱,";
					}else $nd=0;
					$q="update tmng set box=2,ctime=now() where uid=$uid and type=0 and num=$id";
					mysql_query($q) or die(f_e($q));
				}else{
					$nd=1;
					$q="insert into tmng(uid,type,box,num,ctime) values($uid,0,2,$id,now())";
					mysql_query($q) or die(f_e($q));
				}
				if($nd){
					$q="update tmng set box=box+1 where uid=$uid and type=5 and num=2";
					mysql_query($q) or die(f_e($q));
				}
				mysql_free_result($rc);
				$msg.="任务完成。 ^_^";
				setunlock("titem",$id);
			}else $msgs.="帖子 [ $id ] 正在处于繁忙状态，不能被加入管理，请稍后再试。^O^";
		}else $msg="您没有帖子[ $id ]所在论坛的管理权, 无法完成任务。 T_T";
		}else $msg="帖子[ $id ]不存在，可能已经被删除。无法完成任务。 T_T";
	}else $msg="查询参数不完整, 无法完成任务。 T_T";
	$q="select box from tmng where uid=$uid and type=5 and num=2";
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
<tr class=bar2 height=50><TD align="center">帖子加入管理<?php echo $rowc?"($rowc)":""; ?></TD></tr>
<tr><TD align=center>
<?php
if($sts){
	if($msg)echo "<div class=pd1><font class=warningc>$msg</font></div>";
	$q="select t1.ctime,t1.num,t2.id,t2.title,t2.rnum,t2.vnum,t2.adnu,t2.rdnum,t2.uid,t2.gid,t3.name,t4.name as gname,t4.inum as ginum,t4.rnum as grnum from tmng as t1 force index(ind) left join titem as t2 force index(primary) on t1.num=t2.id left join tuser as t3 force index(primary) on t3.id=t2.uid left join tgup as t4 force index(primary) on t4.id=t2.gid where t1.uid=$uid and t1.type=0 and t1.box=2 order by t1.ctime desc limit 20";
	$R=mysql_query($q) or die(f_e($q));
	if($len=mysql_num_rows($R)){
		echo "<div style=\"padding-left:5px\" class=bdtb1><table width=100% cellpadding=5 cellspacing=0><tr><td width=150>加管时间</td><td width=350>ID.标题 [阅读权] (回复/访问数) {附件数} [发帖人]</td><td >论坛 (帖/回复数)</td></tr></table></div>".
			"<div style=\"padding:5px;overflow:scroll;height:399px;\"><table width=100% cellpadding=5 cellspacing=0>";
		for($i=0;$i<$len;$i++){
			$r=mysql_fetch_object($R);
			echo "<tr class=",$i&1?"light":"dark","bar height=22>
<td",$i?" class=bdt1":""," width=150>$r->ctime</td>
<td",$i?" class=bdt1":""," width=350>$r->id.$r->title",$r->rdnum?" [$r->rdnum]":""," ($r->rnum/$r->vnum)",$r->adnu?" &#123;$r->adnu&#125;":""," [$r->name]</td>
<td",$i?" class=bdt1":"",">$r->gname ($r->ginum/$r->grnum)</td>
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