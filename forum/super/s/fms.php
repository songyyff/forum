<?php

/*
forums.php
*/

e_e();

$q="update tdict set info2=info2+1 where type=15 and key1=0";
mysql_query($q) or die(f_e($q));

function CtoDS($id){
	$q="select id from tgup where pid=$id and stat='E'";
	$r1=mysql_query($q) or die(f_e($q));
	if(mysql_num_rows($r1)){
		$q="update tgup set stat='D' where pid=$id and stat='E'";
		mysql_query($q) or die(f_e($q));
	}
	while($row=mysql_fetch_object($r1))CtoDS($row->id);
	mysql_free_result($r1);
}

if(isset($_R['act'])){
$gid=(int)$_R['fid'];
switch((int)$_R['act']){
case 0:
	$q="select id,pid,stat,level from tgup where id=$gid";
	$r1=mysql_query($q) or die(f_e($q));
	$grow=mysql_fetch_object($r1);
	mysql_free_result($r1);
	$pstat=f_rpspc($_R['stat']);
	if($grow->stat!='E'&&$pstat=='E'&&$grow->id)$pstat=$grow->stat;
	$plevel=(int)$_R['level'];
	if($grow->level>$plevel)$plevel=$grow->level;
	$q="insert tgup(uid,pid,stat,level,name,comm,ctime,sort) values($uid,$gid,'$pstat',$plevel,\"".f_rpspc($_R['fname'])."\",\"".f_rpspc($_R['fcom'])."\",now(),(select max(c) from(select isnull(max(sort))as c from tgup where pid=$gid union select (max(sort)+1)as c from tgup where pid=$gid) as t1))";
	mysql_query($q) or die(f_e($q));
	$newid=mysql_insert_id();
	if(file_exists($fp=$_rootpath."/icons/f/$newid".".gif"))@unlink($fp);
	copy($_rootpath."/sys/logo.gif",$fp);
	$q="insert tspu(uid,gid,ctime) values($uid,$newid,now())";
	mysql_query($q) or die(f_e($q));
	$_R['fid']=$newid;
break;
case 1:
	$pstat=f_rpspc($_R['stat']);
	$q="select id,pid,stat from tgup where id=$gid";
	$r1=mysql_query($q) or die(f_e($q));
	if($grow=mysql_fetch_object($r1)){
		$isp=0;
		if($grow->pid){
			$q="select id,pid,stat,level from tgup where id=$grow->pid";
			$r2=mysql_query($q) or die(f_e($q));
			if($prow=mysql_fetch_object($r2))$isp=1;else{$isp=2;$msg="论坛错误，此论坛具有一个不存在的父论坛";}
			mysql_free_result($r2);
		}
		//提取子最小等级
		$q="select min(level) as n from tgup where pid=$gid";
		$r2=mysql_query($q) or die(f_e($q));
		$clevel=mysql_fetch_object($r2)->n;
		mysql_free_result($r2);
		$isl=0;
		$plevel=(int)$_R['level'];
		if($isp<2){
			if($isp&&$clevel)
				if($plevel>=$prow->level)
					if($plevel<=$clevel)$isl=1;
					else $msg="论坛等级高于子论坛的最小等级，不能修改。";
				else $msg="论坛等级低于父论坛等级，不能修改。";
			else if($isp){ //有父无子
				if($plevel>=$prow->level)$isl=1;else $msg="论坛等级低于父论坛等级，不能修改。";
			}else if($clevel){ //有子无父
				if($plevel<=$clevel)$isl=1;else $msg="论坛等级高于子论坛的最小等级，不能修改。";
			}else $isl=1;//无子无父
		}
		//echo $isl;
		if($isl){
			//修改状态
			$iscan=1;
			if($pstat!=$grow->stat){
				if($grow->stat=='E')CtoDS($gid);//所有E的 子论坛设为D
				else if($pstat=='E'&&$isp==1&&$prow->stat!='E'){$iscan=0;$msg="父论坛状态无效，无法修改为有效。";}
			}
			if($iscan&&$isp<2){
				//修改信息
				$q="update tgup set stat='$pstat',level=$plevel,name=\"".f_rpspc($_R['fname'])."\",comm=\"".f_rpspc($_R['fcom'])."\" where id=$gid";
				mysql_query($q) or die(f_e($q));
			}
		}
	}else $msg="论坛不存在，无法修改信息。";
	mysql_free_result($r1);
break;
case 2:
	$q="select id,pid,sort from tgup where id=$gid and (select id from tgup where pid=$gid limit 1) is null and (select max(id) from titem where gid=$gid limit 1) is null and (select id from trpl where gid=$gid limit 1) is null";
	$R=mysql_query($q) or die(f_e($q));
	if($row=mysql_fetch_object($R)){
		$q="update tgup set sort=sort-1 where pid=$row->pid and sort>$row->sort";
		mysql_query($q) or die(f_e($q));
		//删除论坛
		$q="delete from tgup where id=$gid ";
		mysql_query($q) or die(f_e($q));
		//删除论坛管理员
		$q="delete from tspu where gid=$gid";
		mysql_query($q) or die(f_e($q));
		//找位置
		$q="select id from tgup where pid=$row->pid and sort<=$row->sort order by sort desc limit 1";
		$r1=mysql_query($q) or die(f_e($q));
		$newid=mysql_fetch_object($r1)->id;
		mysql_free_result($r1);
		$_R['fid']=$newid?$newid:$row->pid;
	}else $msg="论坛内还有子论坛、帖子或回复，不能删除论坛。";
	mysql_free_result($R);
break;
}
}elseif(isset($_R['move'])){
$gid=(int)$_R['idm'];
$q="select id,pid,sort,level,stat from tgup where id=$gid";
$R=mysql_query($q) or die(f_e($q));
if(!($grow=mysql_fetch_object($R)))$msg="论坛不存在，无法移动。";
//$md=0;
mysql_free_result($R);
if(!$msg)switch((int)$_R['move']){
case 0:
	$q="update tgup as t1,(select id from tgup where pid=$grow->pid and sort<=$grow->sort and id!=$gid order by sort desc limit 1) as t2 set t1.sort=$grow->sort where t1.id=t2.id";
	mysql_query($q) or die(f_e($q));
	$q="update tgup set sort=sort-1 where id=$gid and sort>1";
	mysql_query($q) or die(f_e($q));
	//$md=1;
break;
case 1:
	if($grow->pid>0){
		$q="update tgup set sort=sort-1 where pid=$grow->pid and sort>$grow->sort";
		mysql_query($q) or die(f_e($q));
		$q="update tgup set pid=(select pid from (select pid from tgup where id=$grow->pid)as t1),sort=(select n+1 from (select max(sort)as n from tgup where pid=(select pid from tgup where id=$grow->pid)) as t2) where id=$gid";
		mysql_query($q) or die(f_e($q));
		//$md=1;
	}else $msg="没有父论坛，不能移动。";
break;
case 2:
	$q="select id from tgup where pid=$grow->pid and sort>=$grow->sort and id!=$gid order by sort limit 1";
	$R=mysql_query($q) or die(f_e($q));
	if($drow=mysql_fetch_object($R)){
		$q="update tgup set sort=$grow->sort where id=$drow->id";
		mysql_query($q) or die(f_e($q));
		$q="update tgup set sort=sort+1 where id=$gid";
		mysql_query($q) or die(f_e($q));
		//$md=1;
	}else $msg="论坛已经在最底部，不能移动";
	mysql_free_result($R);
break;
case 3:
	$q="select id,level,stat from tgup where pid=$grow->pid and sort<=$grow->sort and id!=$gid order by sort desc limit 1";
	$R=mysql_query($q) or die(f_e($q));
	if($trow=mysql_fetch_object($R)){
		if($trow->level>$grow->level)$msg="论坛等级低于想移入的论坛，无法移动。";
		else{
			$q="update tgup set ".($trow->stat!='E'?"stat='$trow->stat',":"")."pid=$trow->id,sort=1+(select * from (select ifnull(max(sort),0) from tgup where pid=$trow->id) as t2) where id=$gid";
			mysql_query($q) or die(f_e($q));
		}
	}else $msg="论坛在最顶部，没有兄弟在上面，不能移动";
	//$md=1;
	mysql_free_result($R);
break;
}
//if($md)
$_R['fid']=$gid;
}