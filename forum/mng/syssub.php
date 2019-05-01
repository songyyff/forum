<?php e_e();
if(trim($_R['newbox'])){
	$newtp=(int)$_R['selboxtype']+5;
	$q="select count(*) as c from tmng where uid=$uid and type=$newtp";
	$rs=mysql_query($q) or die(f_e($q));
	if(mysql_fetch_object($rs)->c<100){
	$q="insert tmng(uid,type,comm,ctime,num) values($uid,$newtp,\"".f_rpspc(trim($_R['newbox']))."\",now(),(select * from (select min(id) from tdict where id>2 and id<(select max(num)+2 from tmng where uid=$uid and type=$newtp) and id not in (select num from tmng where uid=$uid and type=$newtp and num>2))as t1))";
	mysql_query($q) or die(f_e($q));
	}else $resmsg="超过100个箱子上限，无法新建管理箱";
	mysql_free_result($rs);
}
if($l=count($_R['rename'])){
	for($i=0;$i<$l;$i++){
		$v=(int)$_R['rename'][$i];
		$q="update tmng set comm=\"".f_rpspc($_R['nm'.$v])."\" where uid=$uid and type=".($v&15)." and num=".($v>>4);
		mysql_query($q) or die(f_e($q));
	}
}
if($l=count($_R['del'])){
	$k=0;
	for($i=0;$i<$l;$i++){
		$v=(int)$_R['del'][$i];
		if($v>>4!=2){
			$ss1.=($k?",":"")."(".(($v&15)-5).",".($v>>4).")";
			$ss2.=($k?",":"")."(".($v&15).",".($v>>4).")";
			$k=1;
		}
	}
	if($ss1){
		$q="delete from tmng where uid=$uid and (type,num) in ($ss2) and (uid,type,num) not in (select t1.uid,t1.type+5,t1.box from (select uid,type,box from tmng where uid=$uid and (type,box) in ($ss1) group by uid,type,box) as t1)";
		mysql_query($q) or die(f_e($q));
//echo $q;
		$q="update tmng as t1,(select uid,type,box,count(*) as c from tmng where uid=$uid and (type,box) in ($ss1) group by uid,type,box) as t2 set t1.box=t2.c where t1.uid=t2.uid and t1.type=t2.type+5 and t1.num=t2.box";
		mysql_query($q) or die(f_e($q));
	}
}
if($l=count($_R['recnt'])){
	$ss1="";$ss2="";$k1=0;$k2=0;$k3=0;
	for($i=0;$i<$l;$i++){
		$v=(int)$_R['recnt'][$i];
		$t=$v&15;
		$n=$v>>4;
		$ss1.=($i?",":"")."(".($t-5).",$n)";
		$ss2.=($i?",":"")."($t,$n)";
		$t-=5;
		switch($t){
		case 0:$ks0.=($k1?",":"").$n;$k1=1;break;
		case 1:$ks1.=($k2?",":"").$n;$k2=1;break;
		case 2:$ks2.=($k3?",":"").$n;$k3=1;break;
		}
	}
	if($ks0){
		$q="delete from tmng where uid=$uid and type=0 and box in ($ks0) and (not exists (select * from titem where titem.id=tmng.num)  or not exists(select * from tgup where tgup.id=(select gid from titem where titem.id=tmng.num)))";
		mysql_query($q) or die(f_e($q));
	}
	if($ks1){
		$q="delete from tmng where uid=$uid and type=1 and box in ($ks1) and (not exists (select * from trpl where trpl.id=tmng.num)  or not exists(select * from titem where titem.id=(select iid from trpl where trpl.id=tmng.num)) or not exists(select * from tgup where tgup.id=(select gid from titem where titem.id=(select iid from trpl where trpl.id=tmng.num))))";
		mysql_query($q) or die(f_e($q));
	}
	if($ks2){
		$q="delete from tmng where uid=$uid and type=2 and box in ($ks2) and not exists (select * from tuser where tuser.id=tmng.num)";
		mysql_query($q) or die(f_e($q));
	}
	$q="update tmng set box=0 where uid=$uid and (type,num) in ($ss2)";
	mysql_query($q) or die(f_e($q));
	$q="update tmng as t1,(select uid,type,box,count(*) as c from tmng where uid=$uid and (type,box) in ($ss1) group by uid,type,box) as t2 set t1.box=t2.c where t1.uid=t2.uid and t1.type=t2.type+5 and t1.num=t2.box";
	mysql_query($q) or die(f_e($q));
}