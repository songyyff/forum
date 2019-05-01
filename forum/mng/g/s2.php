<?php
function getgr($n){
global $right_saved,$_R;
return ($_R["suv".$n]?$right_saved['superview']:0)|($_R["sun".$n]?$right_saved['supernew']:0)|($_R["sum".$n]?$right_saved['supermodify']:0)|($_R["suh".$n]?$right_saved['superhidden']:0)|($_R["sud".$n]?$right_saved['superdel']:0)|($_R["suo".$n]?$right_saved['superother']:0);
}
function getur($n){global $right_saved,$_R;return ($_R['sumu'.$n]?$right_saved['supermodify']:0)|($_R["sudu".$n]?$right_saved['superdel']:0);}
e_e();
if(!$grow->id)$grow->id=0;
if($len=count($_R['delsu'])){
	for($i=0;$i<$len;$i++)if($_R['delsu'][$i]!=$uid)$gs.=($i?",":"").(int)$_R['delsu'][$i];
	$q="delete from tspu where gid=$grow->id and uid in($gs)";
	mysql_query($q) or die(f_e($q));
	$q="update tuser set srgt=0 where id in($gs) and (select count(gid) from tspu force index(unind) where tspu.uid=tuser.id)=0";
	mysql_query($q) or die(f_e($q));
	//删除管理条目
	$q="delete from tmng where uid in($gs) and ((type=0 and $grow->id=(select gid from titem where id=tmng.num)) or (type=1 and $grow->id=(select gid from trpl where id=tmng.num)))";
	mysql_query($q) or die(f_e($q));
	$q="delete from tmng where uid in($gs) and (select count(*) from tspu force index(unind) where tspu.uid=tmng.uid)=0";
	mysql_query($q) or die(f_e($q));
	//重算管理数据
	$q="update tmng set box=0 where uid in ($gs) and type in(5,6,7)";
	mysql_query($q) or die(f_e($q));
	$q="update tmng as t1,(select uid,type,box,count(*) as c from tmng where uid in($gs) and type in(0,1,2) group by uid,type,box) as t2 set t1.box=t2.c where (t1.uid,t1.type,t1.num)=(t2.uid,t2.type+5,t2.box)";
	mysql_query($q) or die(f_e($q));
	//计算管理论坛数量
	$q="update tuser set gmnu=(select count(*) from tspu where uid=tuser.id) where id in ($u)";
	mysql_query($q) or die(f_e($q));
}
$umk=0x7fffffff^$right_saved['supermodify']^$right_saved['superdel'];
if($len=count($_R['suum'])){
	$rmk=$umk^$right_saved['superview']^$right_saved['supernew']^$right_saved['superhidden']^$right_saved['superother'];
	for($i=0;$i<$len;$i++) if($_R['suum'][$i]!=$_SESSION['seuserid']){
		$n=(int)$_R['suum'][$i];
		$q="update tspu set rigt=(rigt&$rmk)|".getgr($n)." where uid=$n and gid=$grow->id";
		mysql_query($q) or die(f_e($q));
		$q="update tuser set srgt=(srgt&$umk)|".getur($n)." where id=$n";
		mysql_query($q) or die(f_e($q));
	}
}
if($un=(int)$_R['newsu']){
	$qg="select id from tuser where id=$un and stat='E'";
	$r1=mysql_query($qg) or die(f_e($qg));
	if($r=mysql_fetch_object($r1)){
		$q="insert tspu(gid,uid,ctime,rigt) values($grow->id,$un,now(),".getgr(0).") on duplicate key update rigt=rigt";
		mysql_query($q) or die(f_e($q));
		$q="update tuser set srgt=(srgt&$umk)|".(getur(0)|$right_saved['userismng']).",gmnu=(select count(*) from tspu where uid=$un) where id=$un";
		mysql_query($q) or die(f_e($q));
		//创建管理员初始数据
		$q="insert tmng(uid,type,num,ctime,comm) values($un,5,2,now(),\"新加贴子\"),($un,6,2,now(),\"新加回复\"),($un,7,2,now(),\"新加用户\") on duplicate key update uid=uid";
		mysql_query($q) or die(f_e($q));
	} else $nsmsg="没有[ $un ]此用户或用户状态无效，无法设为管理员";
	mysql_free_result($r1);
}
?>