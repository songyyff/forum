<?php

e_e();

if($_REQUEST['imi']){

if($_FILES['gicon']['size']){
if(!$grow->id)$grow->id=0;
if(!$_FILES['gicon']['error'])
if(1024*100>$_FILES['gicon']['size'])
if(".gif"==$fext=strtolower(substr($_FILES['gicon']['name'],-4))){
if(!move_uploaded_file($_FILES['gicon']['tmp_name'],$_rootpath."/icons/f/$grow->id.gif"))$iconmsg="拷贝文件错误";
}else $iconmsg="上传文件 ".f_rpspc($_FILES['gicon']['name'])." 类型错误，必须是 .gif 文件。";
else $iconmsg="上传文件错误，".f_rpspc($_FILES['gicon']['name'])." 文件大小为".number_format($_FILES['gicon']['size'])."字节,上传最大尺寸为".number_format(1024*100)."字节。";
else $iconmsg="上传头像文件错误，错误码: ".$_FILES['gicon']['error'];
}

$mt=(int)$_REQUEST['gmxtp'];
$q="update tgup set mxtp=".($mt<0?0:($mt>50?50:$mt)).",name=\"".f_rpspc($_REQUEST['gname'])."\",comm=\"".f_rpspc($_REQUEST['gcomm'])."\" where id=$grow->gid";
mysql_query($q) or die(f_e($q));

}

if($_REQUEST['imr']&&$grow->gid){
	$gl=(int)$_REQUEST['glevel'];
	$st=$_REQUEST['gstat']?"E":"D";
	$rm=($_REQUEST['gview']?$right_saved['guestview']:0)|($_REQUEST['uview']?$right_saved['userview']:0)|($_REQUEST['unew']?$right_saved['usernew']:0)|($_REQUEST['urpy']?$right_saved['userrpy']:0)|($_REQUEST['umodify']?$right_saved['usermodify']:0);
	$e=1;

/*
	if($gl!=$grow->level||$st!=$grow->stat){
		$hp=0;
		if($grow->pid){
			$qg="select level,stat,id from tgup where id=$grow->pid";
			$result=mysql_query($qg) or die(f_e($qg));
			if(!($prow=mysql_fetch_object($result))){$hp=2;$e=0;$msgr[]="严重：论坛具有一个不存在的父论坛";}
			mysql_free_result($result);
		}else $hp=1;
		if($gl!=$grow->level){
			$qg="select id,level from tgup where pid=$grow->id order by level desc limit 1";
			$result=mysql_query($qg) or die(f_e($qg));
			$crow=mysql_fetch_object($result);
			mysql_free_result($result);
			if($crow&&$gl>$crow->level){$e=0;$msgr[]="论坛等级高于最小等级子论坛 $crow->level id:$crow->id";}
			if(!$hp&&$gl<$prow->level){$e=0;$msgr[]="论坛等级低于父论坛等级 $prow->level id:$prow->id";}
			if($e)$sqll=",level=$gl";
		}
		if($st!=$grow->stat){
			if($st=='E'&&!$hp&&$prow->stat!='E'){$e=0;$msgr[]="父论坛状态无效 id:$prow->id";}
			elseif($grow->stat=='E'){//是否有有效子论坛
				$qg="select id from tgup where pid=$grow->id and stat='E' limit 1";
				$result=mysql_query($qg) or die(f_e($qg));
				if($row=mysql_fetch_object($result)){$e=0;$msgr[]="含有有效子论坛 id:$row->id";}
				mysql_free_result($result);
			}
			if($e)$sqls=",stat='$st'";
		}
	}
*/
	if($rm!=$grow->rigt)$sqlr=",rigt=$rm";
	if($sqlr||$sqll||$sqls){
		$qg="update tgup set$sqll$sqlr$sqls where id=$grow->id";
		$qg[15]=" ";
		mysql_query($qg) or die(f_e($qg));
	}
}
//重新获取论坛
$q="select t1.gid,t1.rigt as srigt,t1.level as slevel,t1.ctime as sctime,t2.* from tspu as t1 force index(unind) left join tgup as t2 on t1.gid=t2.id where t1.uid=$uid and t1.gid=".$grow->gid;
$result=mysql_query($q) or die(f_e($q));
$grow=mysql_fetch_object($result);
mysql_free_result($result);
if(!$grow->gid) $grow->name="根论坛";
?>