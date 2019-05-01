<?php
//============================
//	作者: 宋云峰 author: song
//	更新: 2008-6-27
//============================
e_e();
//设置用户 set user
$isi=1;
for($wrpt=0;$isi&&$wrpt<4;$wrpt++){
if($isi){ //是否有帖子要删除, if has item to delete
$query="select id from titem where gid in (select gid from tspu where uid=$uid and rigt&".$right_saved['superdel'].") and uid=$id limit 1";
$r1=mysql_query($query) or die(f_e($query));
$isi=mysql_num_rows($r1);
mysql_free_result($r1);
if($isi)if($wrpt<3){
//锁定帖子, lock item
$lockt=time();
$query="update titem set inmg=$uid,chgt=$lockt where gid in (select gid from tspu where uid=$uid and rigt&".$right_saved['superdel'].") and uid=$id and inmg=0";
mysql_query($query) or die(f_e($query));

//删回复管理记录, delete replay manange record
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
//修改用户回复数据, alter user replay number
$query="update tuser as t1,(select uid,count(*) as c from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) and stat='E' group by uid) as t2 set rnum=rnum-t2.c where t1.id=t2.uid";
mysql_query($query) or die(f_e($query));
$query="update tuser as t1,(select uid,count(*) as c from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) and stat!='E' group by uid) as t2 set drnu=drnu-t2.c where t1.id=t2.uid";
mysql_query($query) or die(f_e($query));
//删除回复, delete record
$query="delete from trpl where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id)";
mysql_query($query) or die(f_e($query));

//删帖子, delete item
//管理, manager
$query="update tmng as t1,(select  uid,box,count(*) as c from tmng where type=0 and num in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) group by uid,box) as tt set t1.box=t1.box-tt.c where (t1.uid,t1.type,t1.num)=(tt.uid,5,tt.box)";
mysql_query($query) or die(f_e($query));
$query="delete from tmng where type=0 and num in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id)";
mysql_query($query) or die(f_e($query));
//论坛数据, forum data
$query="update tgup as t1,(select gid,sum(inum) as ii,sum(dnum) as id,sum(rnum) as rr,sum(drnu) as rd from titem where inmg=$uid and chgt=$lockt and uid=$id group by gid) as t2 set t1.inum=t1.inum-t2.ii,t1.dnum=t1.dnum-t2.id,t1.rnum=t1.rnum-t2.rr,t1.drnu=t1.drnu-t2.rd where t1.id=t2.gid";
mysql_query($query) or die(f_e($query));
//用户数据, user data
$query="update tuser as t1,(select sum(inum) as ii,sum(dnum) as id,sum(rnum) as rr,sum(drnu) as rd from titem where inmg=$uid and chgt=$lockt and uid=$id) as t2 set t1.inum=t1.inum-t2.ii,t1.dnum=t1.dnum-t2.id,t1.rnum=t1.rnum-t2.rr,t1.drnu=t1.drnu-t2.rd where t1.id=$id";
mysql_query($query) or die(f_e($query));
//订阅, subscribe
$query="update tuser as t1,(select uid,count(*) as c where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id) group by uid) as t2 set t1.sbnu=t1.sbnu-t2.c where t1.id=t2.uid";
mysql_query($query) or die(f_e($query));
$query="delete from tsubs where iid in (select id from titem where inmg=$uid and chgt=$lockt and uid=$id)";
mysql_query($query) or die(f_e($query));
//删除帖子, delete item
$query="delete from titem where inmg=$uid and chgt=$lockt and uid=$id";
mysql_query($query) or die(f_e($query));
}else $msgs[]="用户 [$irow->name] 帖子 有残留，<font class=warningc>没能完全删除</font>";
else {$msgs[]="用户 [$irow->name] 在您有删除权版块的 帖子 全部被删除";break;}
}
sleep(1);
}//end for
?>