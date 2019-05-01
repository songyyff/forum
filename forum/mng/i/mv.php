<?php
e_e();
if($irow->type==2)$msgs.="<br>[ $id ] 置顶帖子不允许迁移论坛";
else{
$query="select t1.id,t1.name,t2.rigt as srigt from tgup as t1,tspu as t2 where t1.id=$gpid and t2.gid=$gpid and t2.uid=$uid";
$r2=mysql_query($query) or die(f_e($query));
$mgrow=mysql_fetch_object($r2);
mysql_free_result($r2);
if($mgrow->srigt&$right_saved['supernew']&&$srigt&$right_saved['superdel']){
	$query="update tgup set ".($irow->stat=='E'?"inum=inum-1,rnum=rnum-$irow->rnum,drnu=drnu-$irow->drnu":"dnum=dnum-1,drnu=drnu-$irow->drnu-$irow->rnum")." where id=$irow->gid";
	mysql_query($query) or die(f_e($query));
	$query="update tgup set ".($irow->stat=='E'?"inum=inum+1,rnum=rnum+$irow->rnum,drnu=drnu+$irow->drnu":"dnum=dnum+1,drnu=drnu+$irow->drnu+$irow->rnum")." where id=$gpid";
	mysql_query($query) or die(f_e($query));
	$query="update titem set gid=$gpid where id=$id";
	mysql_query($query) or die(f_e($query));
	$query="update trpl set gid=$gpid where iid=$id";
	mysql_query($query) or die(f_e($query));
	sendmsg($userrow,$irow->uid,"帖子回复被迁移","您处于论坛 <a href=list.php?groupid=$irow->gid>$irow->gname</a> 的帖子 <a href=view.php?noteid=$irow->id>$irow->title</a> 由于不符合版规被管理员 <a href=userinfo.php?userid=$userrow->id>$userrow->name</a> 迁移到了 <a href=list.php?groupid=$mgrow->gid>$mgrow->name</a> 论坛。
帖子状态 $irow->stat
访问数 $irow->vnum
回复数 $irow->rnum
附件数 $irow->adnu",1);
	$msgs.="<br>[ $id ] 帖子由 [$irow->gid] 板块迁移到了 [$gpid] 板块";
}else $msgs.="<br>[ $id ] 您在 [$irow->gid] 和 [$gpid] 板块没有足够的权力，不能移动帖子";
}?>