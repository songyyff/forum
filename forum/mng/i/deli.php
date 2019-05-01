<?php
//============================
//	作者: 宋云峰
//	更新: 2008-6-27
//============================
e_e();
$q="update tgup set ".($irow->stat=='E'?"inum=inum-1,rnum=rnum-$irow->rnum,drnu=drnu-$irow->drnu":"dnum=dnum-1,drnu=drnu-$irow->rnum-$irow->drnu").($irow->type==2?" tpnu=tpnu-1":"")." where id=$irow->gid";
mysql_query($q) or die(f_e($q));
//tuser
//用户帖数 -1
$q="update tuser set ".($irow->stat=='E'?"inum=inum-1":"dnum=dnum-1")." where id=$irow->uid";
mysql_query($q) or die(f_e($q));
//其他用户有效/无效回复数
$q="update tuser as t1 set ".($irow->stat=='E'?"rnum=rnum-(select count(id) from trpl where iid=$id and uid=t1.id and stat='E'),drnu=drnu-(select count(id) from trpl where iid=$id and uid=t1.id and stat!='E')":"drnu=drnu-(select count(id) from trpl where iid=$id and uid=t1.id)")." where t1.id in (select DISTINCT uid from trpl where iid=$id)";
mysql_query($q) or die(f_e($q));
//tsubs
	//其他用户订阅数量
$q="update tuser set sbnu=sbnu-1 where id in (select uid from tsubs force index(iid) where iid=$id)";
mysql_query($q) or die(f_e($q));
	//其他用户订阅数据
$q="delete from tsubs where iid=$id";
mysql_query($q) or die(f_e($q));
//tmng
	//修改管理条目数
$q="update tmng as t1,(select uid,box from tmng where type=0 and num=$id) as t2 set t1.box=t1.box-1 where (t1.uid,t1.type,t1.num)=(t2.uid,5,t2.box)";
mysql_query($q) or die(f_e($q));
	//删除管理条目
$q="delete from tmng where type=0 and num=$id";
mysql_query($q) or die(f_e($q));
	//修改管理回复条目数
$q="update tmng as t1,(select uid,box,count(uid) as c from tmng force index(tn) where type=1 and num in (select id from trpl where iid=$id) group by uid,box) as t2 set t1.box=t1.box-t2.c where (t1.uid,t1.type,t1.num)=(t2.uid,6,t2.box)";
mysql_query($q) or die(f_e($q));
	//删除管理回复条目
$q="delete from tmng where type=1 and num in (select id from trpl where iid=$id)";
mysql_query($q) or die(f_e($q));
//trsc
$q="select * from trsc where iid=$id or rid in (select id from trpl where iid=$id)";
$r2=mysql_query($q) or die(f_e($q));
$adnum=mysql_num_rows($r2);
while($row=mysql_fetch_object($r2))@unlink($uploaddir.$row->realname);
mysql_free_result($r2);
$q="delete from trsc where iid=$id or rid in (select id from trpl where iid=$id)";
mysql_query($q) or die(f_e($q));
//titem
$q="delete from titem where id=$id";
mysql_query($q) or die(f_e($q));
//trpl
$q="delete from trpl where iid=$id";
mysql_query($q) or die(f_e($q));
sendmsg($userrow,$irow->uid,"帖子被删除","您于 $irow->ctime 在论坛 <a href=list.php?groupid=$irow->gid>$irow->gname</a> 发表的帖子 [ $irow->title ] 由于不符合版规被删除.
访问数 $irow->vnum
回复数 $irow->rnum
附件数 $irow->adnu
所有附件数 $adnum",1);
?>