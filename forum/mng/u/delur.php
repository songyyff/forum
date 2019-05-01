<?php
//============================
//作者: 宋云峰 author: song
//更新: 2008-6-27
//============================
e_e();
//设置用户, set user
$isr=1;
for($wrpt=0;$isr&&$wrpt<4;$wrpt++){
//是否有回复要删除, if has replay to delete
if($isr){
$query="select id from trpl where gid in (select gid from tspu where uid=$uid and rigt&".$right_saved['superdel'].") and uid=$id limit 1";
$r1=mysql_query($query) or die(f_e($query));
$isr=mysql_num_rows($r1);
mysql_free_result($r1);
if($isr)if($wrpt<3){ 
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

//释放帖子, release item
$query="update titem set inmg=0,chgt=".time()." where inmg=$uid and chgt=$lockt";
mysql_query($query) or die(f_e($query));
}else $msgs[]="用户 [$irow->name] 回复 有残留，<font class=warningc>没能完全删除</font>";
else{$msgs[]="用户 [$irow->name] 在您有删除权版块的 回复 全部被删除";break;}
}
sleep(1);
}//end for
?>