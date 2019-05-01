<?php
//============================
//	作者: 宋云峰 author: song
//	更新: 2008-6-27
//============================
e_e();
//设置用户 set user
$isi=1;$isr=1;
for($wrpt=0;($isi||$isr)&&$wrpt<4;$wrpt++){
if($isi){ //是否有帖子要删除 if has item to delete
$query=" select id from titem where gid in (select gid from tspu where uid=$uid and rigt&".$right_saved['superdel'].") and uid=$id limit 1";
$r1=mysql_query($query) or die(f_e($query));
$isi=mysql_num_rows($r1);
mysql_free_result($r1);
if($isi&&$wrpt<3){
//锁定帖子, to lock item
$lockt=time();
$query="update titem set inmg=$uid,chgt=$lockt where gid in (select gid from tspu where uid=$uid and rigt&".$right_saved['superdel'].") and uid=$id and inmg=0";
mysql_query($query) or die(f_e($query));

//删回复管理记录 delete replay manage record
$query="update tmng as t1,(select  uid,box,count(*) as c from tmng where type=1 and num in (select id from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id)) group by uid,box) as tt set t1.box=t1.box-tt.c where (t1.uid,t1.type,t1.num)=(tt.uid,6,tt.box)";
mysql_query($query) or die(f_e($query));
$query="delete from tmng where type=1 and num in (select id from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id))";
mysql_query($query) or die(f_e($query));
//删除回复, delete replay
//删除附件, delete attachment
$query="select * from trsc where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) or rid in (select id from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id))";
r2=mysql_query($query) or die(f_e($query));
while($row=mysql_fetch_object($r2))@unlink($uploaddir.$row->realname);
mysql_free_result($r2);
$query="delete from trsc where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) or rid in (select id from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id))";
mysql_query($query) or die(f_e($query));
//修改用户回复数据 alter user replay number
$query="update tuser as t1,(select uid,count(*) as c from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) and stat='E' group by uid) as t2 set rnum=rnum-t2.c where t1.id=t2.uid";
mysql_query($query) or die(f_e($query));
$query="update tuser as t1,(select uid,count(*) as c from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) and stat!='E' group by uid) as t2 set drnu=drnu-t2.c where t1.id=t2.uid";
mysql_query($query) or die(f_e($query));
//删除回复, delete replay
$query="delete from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id)";
mysql_query($query) or die(f_e($query));

//删帖子, delete item
//管理, manage
$query="update tmng as t1,(select  uid,box,count(*) as c from tmng where type=0 and num in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) group by uid,box) as tt set t1.box=t1.box-tt.c where (t1.uid,t1.type,t1.num)=(tt.uid,5,tt.box)";
mysql_query($query) or die(f_e($query));
$query="delete from tmng where type=0 and num in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id)";
mysql_query($query) or die(f_e($query));
//论坛数据, forum number
$query="update tgup as t1,(select gid,sum(inum) as ii,sum(dnum) as id,sum(rnum) as rr,sum(drnu) as rd from titem where inmg=$uid and chgt=$lockt and uid=$id group by gid) as t2 set t1.inum=t1.inum-t2.ii,t1.dnum=t1.dnum-t2.id,t1.rnum=t1.rnum-t2.rr,t1.drnu=t1.drnu-t2.rd where t1.id=t2.gid";
mysql_query($query) or die(f_e($query));
//用户数据, user number
$query="update tuser as t1,(select sum(inum) as ii,sum(dnum) as id,sum(rnum) as rr,sum(drnu) as rd from titem where inmg=$uid and chgt=$lockt and uid=$id) as t2 set t1.inum=t1.inum-t2.ii,t1.dnum=t1.dnum-t2.id,t1.rnum=t1.rnum-t2.rr,t1.drnu=t1.drnu-t2.rd where t1.id=$id";
mysql_query($query) or die(f_e($query));
//订阅, subcrible
$query="update tuser as t1,(select uid,count(*) as c where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) group by uid) as t2 set t1.sbnu=t1.sbnu-t2.c where t1.id=t2.uid";
mysql_query($query) or die(f_e($query));
$query="delete from tsubs where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id)";
mysql_query($query) or die(f_e($query));
//删除帖子, delete item
$query="delete from titem where inmg=$uid and chgt=$lockt and uid=$id";
mysql_query($query) or die(f_e($query));
}
}
//是否有回复要删除, if has replay to delete
if($isr){
$query="select id from trpl where gid in (select gid from tspu where uid=$uid and rigt&".$right_saved['superdel'].") and uid=$id limit 1";
$r1=mysql_query($query) or die(f_e($query));
$isr=mysql_num_rows($r1);
mysql_free_result($r1);
if($isr&&$wrpt<3){ 
//锁定帖子, lock item
$lockt=time();
$query="update titem set inmg=$uid,chgt=$lockt where id in (select iid from trpl where gid in (select gid from tspu where uid=$uid and rigt&".$right_saved['superdel'].") and uid=$id) and inmg=0";
mysql_query($query) or die(f_e($query));
//删除回复管理条目, delete replay manage item
$query="update tmng as t1,(select uid,box,count(*) as c from tmng where type=2 and num in (select id from trpl where uid=$id and iid in (select id from titem where inmg=$uid and chgt=$lockt)) group by uid,box) as t2 set t1.box=t1.box-t2.c where (t1.type,t1.uid,t1.num)=(7,t2.uid,t2.box)";
mysql_query($query) or die(f_e($query));
$query="delete from tmng  where type=2 and num in (select id from trpl where uid=$id and iid in (select id from titem where inmg=$uid and chgt=$lockt))";
mysql_query($query) or die(f_e($query));

//设置用户数据, set user data
$query="update tuser set rnum=rnum-(select count(*) from trpl force index(ut) where uid=$id and stat='E' and iid in (select id from titem where inmg=$uid and chgt=$lockt)),drnu=drnu-(select count(*) from trpl force index(ut) where uid=$id and stat!='E' and iid in (select id from titem where inmg=$uid and chgt=$lockt)) where id=$id";
mysql_query($query) or die(f_e($query));

//设置帖子数据, set item data
$query="update titem as t1,(select iid,count(*) from trpl force index(ut) where uid=$id and stat='E' and iid in (select id from titem where inmg=$uid and chgt=$lockt) group by iid) as t2 set t1.rnum=t1.rnum-t2.c where t1.id=t2.iid";
mysql_query($query) or die(f_e($query));
$query="update titem as t1,(select iid,count(*) from trpl force index(ut) where uid=$id and stat!='E' and iid in (select id from titem where inmg=$uid and chgt=$lockt) group by iid) as t2 set t1.drnu=t1.drnu-t2.c where t1.id=t2.iid";
mysql_query($query) or die(f_e($query));

//设置论坛数据, set forum data
$query="update tgup as t1,(select gid,count(*) from trpl force index(ut) where uid=$id and stat='E' and iid in (select id from titem where inmg=$uid and chgt=$lockt) group by gid) as t2 set t1.rnum=t1.rnum-t2.c where t1.id=t2.gid";
mysql_query($query) or die(f_e($query));
$query="update tgup as t1,(select gid,count(*) from trpl force index(ut) where uid=$id and stat='E' and iid in (select id from titem where inmg=$uid and chgt=$lockt) group by gid) as t2 set t1.drnu=t1.drnu-t2.c where t1.id=t2.gid";
mysql_query($query) or die(f_e($query));

//删除附件, delete attachment
$query="select * from trsc where rid in (select id from trpl where uid=$id and iid in (select id from titem where inmg=$uid and chgt=$lockt))";
r2=mysql_query($query) or die(f_e($query));
while($row=mysql_fetch_object($r2))@unlink($uploaddir.$row->realname);
mysql_free_result($r2);
$query="delete from trsc where rid in (select id from trpl where uid=$id and iid in (select id from titem where inmg=$uid and chgt=$lockt))";
mysql_query($query) or die(f_e($query));

//重新排序, resort
$query="update trpl set stat='D' where uid=$id and iid in (select id from titem where inmg=$uid and chgt=$lockt)";
mysql_query($query) or die(f_e($query));
$query="update trpl as t1,(select id,iid,stime from trpl where stat='E' and iid in (select id from titem where inmg=$uid and chgt=$lockt)) as t2 set t1.pos=(select count(*) from t2 where t2.iid=t1.iid and t2.stime<=t1.stime) where t1.id=t2.id";
mysql_query($query) or die(f_e($query));

//删除回复, delete replay
$query="delete from trpl where uid=$id and iid in (select id from titem where inmg=$uid and chgt=$lockt)";
mysql_query($query) or die(f_e($query));

//释放帖子 free item
$query="update titem set inmg=0,chgt=".time()." where inmg=$uid and chgt=$lockt";
mysql_query($query) or die(f_e($query));
}
}
sleep(1);
}//end for
if($isi||$isr){ //用户数据有残留不能删除, user data can't delete
$msgs[]="用户 [$irow->name] ".($isi?"帖子 ":"").($isr?"回复 ":"")."有残留不能被删除";
}else{
//判定用户是否可以删除, if user can delete
$query="select id from titem force index(self) where uid=$id limit 1";
$r1=mysql_query($query) or die(f_e($query));
$query="select id from trpl force index(ut) where uid=$id limit 1";
$r2=mysql_query($query) or die(f_e($query));
if(!mysql_fetch_object($r1)->c&&!mysql_fetch_object($r2)->c){
	//删除订阅，朋友，消息, delete subscribe, friend, message
	$query="delete from tsub where uid=$id";
	mysql_query($query) or die(f_e($query));
	$query="delete from tfrid where uid=$id";
	mysql_query($query) or die(f_e($query));
	$query="delete from tmsg where uid=$id";
	mysql_query($query) or die(f_e($query));
	//删除用户信息, delete user information
	$query="update tuser set stat='R' where id=$id";
	mysql_query($query) or die(f_e($query));
	$msgs[]="用户 [$irow->name] 被删除";
}else $msgs[]="用户 [$irow->name] 在其它您无删除权的版块有帖子和回复，不能被删除";
}
?>