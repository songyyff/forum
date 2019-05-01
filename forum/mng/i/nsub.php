<?php
//	文件: nsub.php 
//	作者: 宋云峰
//  更新: 2008-6-27
 e_e();
 
if(($len1=count($_R['comms']))||($len2=count($_R['mscomms']))){

$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}

//comm
if($len1){
$stmt=$mysqli->stmt_init();
$stmt->prepare("update tmng set comm=? where uid=$uid and type=0 and num=?");
$stmt->bind_param('si',$S,$tid);
for($i=0;$i<$len1;$i++){
	$tid=(int)$_R['comms'][$i];
	$S=str_replace("<","&lt;",$_R["comm$tid"]);
	$stmt->execute();
}
$stmt->close();
}
//mngcomms
if($len2){
$stmt=$mysqli->stmt_init();
$stmt->prepare("update tmng use index(tn) set comm=? where type=9 and num=? and uid=$uid");
$stmt->bind_param('si',$S,$tid);
for($i=0;$i<$len2;$i++){
	$tid=(int)$_R['mscomms'][$i];
	$q="select uid from tspu where uid=$uid and gid=(select gid from titem where id=$tid) and rigt&$right_saved[supermodify]";
	$R=mysql_query($q) or die(f_e($q));
	if(mysql_num_rows($R)){
		$S=str_replace("<","&lt;",$_R["mscomm$tid"]);
		if(strlen($S)){
			$q="insert into tmng(type,num,uid,ctime)values(9,$tid,$uid,now())";
			mysql_query($q)or$N=mysql_errno();
			if($N&&$N!=1062)die(f_e($q));else$stmt->execute();
		}else{
			$q="delete from tmng where uid=$uid and type=9 and num=$tid";
			mysql_query($q) or die(f_e($q));
		}
	}
}
$stmt->close();
}
}
//mngs
include "../mng/lock.php";
if($len=count($_R['mngs'])){
	include "../mng/smsg.php";
	for($i=0;$i<$len;$i++){
		$id=(int)$_R['mngs'][$i];
		//echo $id;
		//询问帖子是否在修改状态
		if(!$LC=getlock("titem",$id,3)){
			$query="select t1.box,
t2.id,t2.title,t2.gid,t2.uid,t2.vnum,t2.rnum,t2.drnu,t2.rigt,t2.type,t2.deco,t2.stat,t2.adnu,t2.ctime,
t3.rigt as srigt,
t4.name as uname,t4.level as ulevel,
t5.name as gname 
from tmng as t1 force index(se)
left join titem as t2 force index(primary) on t2.id=$id
left join tspu as t3 force index(unind) on (t3.uid=$uid and t3.gid=t2.gid)
left join tuser as t4 on t4.id=t2.uid 
left join tgup as t5 on t5.id=t2.gid
where t1.uid=$uid and t1.type=0 and t1.num=$id";
			$r1=mysql_query($query) or die(f_e($query));
			if($irow=mysql_fetch_object($r1)){
				$q="update titem set lmng=$_S[seuserid],lmtm=now() where id=$id";
				mysql_query($q) or die(f_e($q));
				$srigt=$irow->srigt;
				//delete
				if($_R['del1'.$id]&&$_R['del2'.$id])
					if($srigt&$right_saved['superdel']){
						include "i/deli.php";
						$msgs.="<br>[ $id ] 帖子被删除";
						continue;
					}else $msgs.="<br>[ $id ] 没有在 [$irow->gname] 版块删除帖子的管理权。";
				//del rpl
				if($_R['drpy1'.$id]&&$_R['drpy2'.$id])
					if($srigt&$right_saved['superdel']){
						include "i/delir.php";
						$msgs.="<br>[ $id ] 帖子的所有回复被删除";
					}else $msgs.="<br>[ $id ] 没有删除此帖子所有回复的权限";
				//重置回复
				if($_R['setrpy'.$id])include "rr.php";
				//修改参数
				if($srigt&$right_saved['supermodify']){
					//迁移管理箱
					if($_R['bmove'.$id]&&$irow->box!=($bid=(int)$_R['box'.$id]))include "mb.php";
					//修改类型
					if($_R['ty'.$id]&&$irow->type!=($ity=(int)$_R['ty'.$id]))include "mt.php";
					//迁移论坛
					if($_R['gmove'.$id]&&$irow->gid!=$gpid=(int)$_R['mvgp'.$id])include "mv.php";
					//修改描述
					if($irow->deco!=($idc=(int)$_R['deco'.$id])){
						$query="update titem set deco=$idc where id=$id";
						mysql_query($query) or die(f_e($query));
						$msgs.="<br>[ $id ] 修饰改变";
					}
					//设置权限
					if($_R['isright'.$id])include "mr.php";
					//设置状态
					if(($istat=f_rpspc($_R['istat'.$id]))!=""&&$istat!=$irow->stat)include "ics.php";
				}else $msgs.="<br>[ $id ] 没有管理员修改权";
				//管理后放弃 具有250标记 
				if($_R['lsm'.$id])include "ml.php";
			} else $msgs.="<br>[ $id ] 数据不完整，需要校验帖子相关数据库";
			mysql_free_result($r1);
			setunlock("titem",$id);
		}elseif($LC==2&&$_R['lsm'.$id])include"ml.php";else$msgs.="<br>[ $id ] 帖子".($LC==1?"正在被其他管理员修改。":"不存在，已经被删除。");
	}
}
?>