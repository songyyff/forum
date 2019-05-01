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
$stmt->prepare("update tmng use index(se) set comm=? where uid=$uid and type=1 and num=?");
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
$stmt->prepare("update tmng use index(tn) set comm=? where type=10 and num=? and uid=$uid");
$stmt->bind_param('si',$S,$tid);
for($i=0;$i<$len2;$i++){
	$tid=(int)$_R['mscomms'][$i];
	$q="select uid from tspu where uid=$uid and gid=(select gid from trpl where id=$tid) and rigt&$right_saved[supermodify]";
	$R=mysql_query($q) or die(f_e($q));
	if(mysql_num_rows($R)){
		$S=str_replace("<","&lt;",$_R["mscomm$tid"]);
		if(strlen($S)){
			$q="insert into tmng(type,num,uid,ctime)values(10,$tid,$uid,now())";
			mysql_query($q)or$N=mysql_errno();
			if($N&&$N!=1062)die(f_e($q));else$stmt->execute();
		}else{
			$q="delete from tmng where uid=$uid and type=10 and num=$tid";
			mysql_query($q) or die(f_e($q));
		}
	}
}
$stmt->close();
}
}

//mngs
if($len=count($_R['mngs'])){
	include "../mng/lock.php";
	for($i=0;$i<$len;$i++){
		$id=(int)$_R['mngs'][$i];
		$query="select t1.box,
t2.id,t2.title,t2.iid,t2.gid,t2.uid,t2.rigt,t2.stat,t2.stime,t2.adnu,t2.ctime,
t3.title as ititle,t3.rigt as irigt,
t4.name as uname,t4.level as ulevel,
t5.name as gname,
t6.rigt as srigt
from tmng as t1 force index(se)
left join trpl as t2 force index(primary) on t2.id=$id
left join titem as t3 force index(primary) on t3.id=t2.iid
left join tuser as t4 on t4.id=t2.uid
left join tgup as t5 on t5.id=t3.gid
left join tspu as t6 force index(unind) on (t6.uid=$uid and t6.gid=t3.gid)
where t1.uid=$uid and t1.type=1 and t1.num=$id";
		$r1=mysql_query($query) or die(f_e($query));
		if(($irow=mysql_fetch_object($r1))&&$irow->id){
			$iid=$irow->iid;
			//询问回复是否在修改状态,check item if in lock and if not then hold the lock
			if(!$LC=getlock("titem",$iid,3)){
				$q="update trpl set lmng=$_S[seuserid],lmtm=now() where id=$id";
				mysql_query($q) or die(f_e($q));
				$srigt=$irow->srigt;
				//delete
				if($_R['del1'.$id]&&$_R['del2'.$id])
					if($srigt&$right_saved['superdel']){
						include "r/delr.php";
						$msgs.="<br>[ $id ] 回复被删除";
						setunlock("titem",$iid);
						continue;
					}else $msgs.="<br>[ $id ] 没有删除此回复的权限";
				//修改参数 change options
				if($srigt&$right_saved['supermodify']){
					//move box
					if($_R['bmove'.$id]&&$irow->box!=($bid=(int)$_R['box'.$id])){
						$query="update tmng set box=box+1 where uid=$uid and type=6 and num=$bid";
						mysql_query($query) or die(f_e($query));
						if(mysql_affected_rows()){
							$query="update tmng set box=box-1 where uid=$uid and type=6 and num=$irow->box";
							mysql_query($query) or die(f_e($query));
							$query="update tmng set box=$bid where uid=$uid and type=1 and num=$id";
							mysql_query($query) or die(f_e($query));
							$msgs.="<br>[ $id ] 从管理箱 [$irow->box] 成功移动到 [$bid] 管理箱";
						}else $msgs.="<br>[ $id ] 从管理箱 [$irow->box] 移动到 [$bid] 管理箱失败";
					}
					//设置权限 set right
					if($_R['isright'.$id]){
						$rs=0;
						$rrs=(int)$_R['right'.$id];
						if($rrs&1)$rs|=$right_saved['guestview'];
						if($rrs&2)$rs|=$right_saved['userview'];
						if($rrs&4)$rs|=$right_saved['usershow'];
						if($rrs&8)$rs|=$right_saved['usermodify'];
						if($rrs&16)$rs|=$right_saved['supershow'];
						$rs|=$right_saved['userrpy'];
						$rs|=$right_saved['superrpy'];
						if($irow->rigt!=$rs){
							$query="update trpl set rigt=$rs where id=$id";
							mysql_query($query) or die(f_e($query));
							$msgs.="<br>[ $id ] 权限被重设";
						}
					}
					//设置状态 set state
					if($_R['istat'.$id]!=$irow->stat){include "r/rcs.php";$msgs.="<br>[ $id ] 状态由 [$irow->stat] 改变至 [".f_rpspc($_R['istat'.$id])."]";}
				}else $msgs.="<br>[ $id ] 没有管理员修改权";
				setunlock("titem",$iid);
				//管理后放弃 after managed lost it
				if($_R['lsm'.$id])include"ml.php";
			}else $msgs.="<br>[ $id ] 所属帖子 [ $iid ] ".($LC==1?"正在处于繁忙状态":"不存在")."，不能被管理。";
		}elseif($_R['lsm'.$id]&&$irow)include"ml.php";else$msgs.="<br>[ $id ] ".($irow?"回复已经被删除":"管理已经丢失");
		mysql_free_result($r1);
	}
}
?>