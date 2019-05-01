<?php
//	更新: 2008-6-26
e_e();
$query="update tgup set ".($irow->stat=='E'?"rnum=rnum-$irow->rnum,drnu=drnu-$irow->drnu":"drnu=drnu-$irow->rnum-$irow->drnu")." where id=$irow->gid";
mysql_query($query) or die(f_e($query));
//tuser
//其他用户有效/无效回复数
$query="update tuser as t1 set ".($irow->stat=='E'?"rnum=rnum-(select count(id) from trpl where iid=$id and uid=t1.id and stat='E'),drnu=drnu-(select count(id) from trpl where iid=$id and uid=t1.id and stat!='E')":"drnu=drnu-(select count(id) from trpl where iid=$id and uid=t1.id)")." where t1.id in (select DISTINCT uid from trpl where iid=$id)";
mysql_query($query) or die(f_e($query));
//tmng
	//修改管理回复条目数
$query="select uid,box,count(uid) as rows from tmng force index(tn) type=1 and num in (select id from trpl where iid=$id) group by uid,box";
$r2=mysql_query($query) or die(f_e($query));
if($l1=mysql_num_rows($r2))for($i=0;$i<$l1;$i++){
	$row=mysql_fetch_object($r2);
	$query="update tmng set box=box-$row->rows where uid=$row->uid and type=6 and num=$row->box";
	mysql_query($query) or die(f_e($query));
}
mysql_free_result($r2);
	//删除管理回复条目
$query="delete from tmng where type=1 and num in (select id from trpl where iid=$id)";
mysql_query($query) or die(f_e($query));
//trsc
$query="select realname from trsc where rid in (select id from trpl where iid=$id)";
$r2=mysql_query($query) or die(f_e($query));
$adnum=mysql_num_rows($r2);
while($row=mysql_fetch_object($r2))@unlink($uploaddir.$row->realname);
mysql_free_result($r2);
$query="delete from trsc rid in (select id from trpl where iid=$id)";
mysql_query($query) or die(f_e($query));
//trpl
$query="delete from trpl where iid=$id";
mysql_query($query) or die(f_e($query));

include_once("smsg.php");
sendmsg($userrow,$irow->uid,"帖子回复被删除","您于 $irow->ctime 在论坛 <a href=list.php?groupid=$irow->gid>$irow->gname</a> 发表的帖子 <a href=view.php?noteid=$irow->id>$irow->title</a> 由于不符合版规，所有回复被删除。
回复数 $irow->rnum
附件数 $adnum",1);
?>