<?php
//	作者: 宋云峰
//	更新: 2008-6-27
//	说明: 论坛管理模块帖子管理的帖子状态变更片段
e_e();
if($irow->type==2)$msgs.="<br>[ $id ] 置顶帖子不允许改变状态";
else{
do{
	if($istat=='E'){$mplus="+";$msub="-";}
	else if($irow->stat=='E'){$mplus="-";$msub="+";}
	else break;
	//group
	$query="update tgup as t1 set inum=inum$mplus 1,dnum=dnum$msub 1,rnum=rnum$mplus$irow->rnum,drnu=drnu$msub$irow->rnum where t1.id=$irow->gid";
	mysql_query($query) or die(f_e($query));
	//tuser
	//用户帖数
	$query="update tuser set inum=inum$mplus 1,dnum=dnum$msub 1 where id=$irow->uid";
	mysql_query($query) or die(f_e($query));
	//其他用户有效回复数和无效回复数
	$query="update tuser as t1 set rnum=rnum$mplus(select count(id) from trpl where iid=$id and uid=t1.id and stat='E'),drnu=drnu$msub(select count(id) from trpl where iid=$id and uid=t1.id and stat='E') where t1.id in (select DISTINCT uid from trpl where iid=$id and stat='E')";
	mysql_query($query) or die(f_e($query));
}while(0);
//设置帖子新状态
$query="update titem set stat=\"$istat\" where id=$id";
mysql_query($query) or die(f_e($query));
$msgs.="<br>[ $id ] 状态由 [$irow->stat] 改变至 [$istat]";
}
?>