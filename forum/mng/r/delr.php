<?php
//============================
//	作者: 宋云峰
//	更新: 2008-6-27
//============================
e_e();
//tgup
$query="update tgup set ".($irow->stat=='E'?"rnum=rnum-1":"drnu=drnu-1")." where id=$irow->gid";
mysql_query($query) or die(f_e($query));
//titem
$query="update titem set ".($irow->stat=='E'?"rnum=rnum-1":"drnu=drnu-1")." where id=$iid";
mysql_query($query) or die(f_e($query));
//tuser
//用户帖数 -1
$query="update tuser set ".($irow->stat=='E'?"rnum=rnum-1":"drnu=drnu-1")." where id=$irow->uid";
mysql_query($query) or die(f_e($query));
//tmng
//修改管理条目数
$query="select uid,box from tmng where type=1 and num=$id";
$r2=mysql_query($query) or die(f_e($query));
$s="";
if($l1=mysql_num_rows($r2))for($k=0;$k<$l1;$k++){
	$row=mysql_fetch_object($r2);
	$s.=($k?",":"")."($row->uid,6,$row->box)";
}
mysql_free_result($r2);
if($s){
	$query="update tmng set box=box-1 where row(uid,type,num) in ($s)";
	mysql_query($query) or die(f_e($query));
}
	//删除管理条目
$query="delete from tmng where type=1 and num=$id";
mysql_query($query) or die(f_e($query));
//trsc
$query="select realname from trsc where rid=$id";
$r2=mysql_query($query) or die(f_e($query));
$adnum=mysql_num_rows($r2);
while($row=mysql_fetch_object($r2))@unlink($uploaddir.$row->realname);
mysql_free_result($r2);
$query="delete from trsc where rid=$id";
mysql_query($query) or die(f_e($query));
//trpl
$query="delete from trpl where id=$id";
mysql_query($query) or die(f_e($query));
//从新计算贴内回复位置
$query="update trpl set pos=pos-1 where iid=$iid and stat='E' and stime>$irow->stime";
mysql_query($query) or die(f_e($query));
include_once("smsg.php");
sendmsg($userrow,$irow->uid,"回复被删除","您于 $irow->ctime 在论坛 <a href=list.php?groupid=$irow->gid>$irow->gname</a> 的帖子 [ $irow->ititle ] 里发表的回复 [ $irow->id ] 由于不符合版规被删除。
附件数 $irow->adnu",1);