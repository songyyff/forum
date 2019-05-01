<?php
$delstr="";
e_e();
if($len=count($_REQUEST['delmsg'])){
	for($i=0;$i<$len;$i++) $delstr.=($i?",":"")."\"".(int)$_REQUEST['delmsg'][$i]."\"";
	if(!$vartype){	//计算删除的新贴数
		$query="select count(id) as cou from tmsg where id in ($delstr) and uid=".$_SESSION['seuserid']." and isrd!=\"r\" and type=\"0\" and del=0;";
		$result=mysql_query($query) or die(f_e($query));
		$row=mysql_fetch_object($result);
		$delnewnum=$row->cou;
		mysql_free_result($result);
		$su->nmnu -= $delnewnum;
	}
	if($vartype==2) $query="delete from tmsg where id in ($delstr) and del>0 and uid=".$_SESSION['seuserid'].";";
	else if($su->maxd>$su->dmnu) $query="update tmsg set del=1 where id in ($delstr) and type=\"$vartype\" and uid=".$_SESSION['seuserid'].";";
	else $query="delete from tmsg where id in ($delstr) and del=0 and uid=".$_SESSION['seuserid'].";";
	$result=mysql_query($query) or die(f_e($query));		//如果删除箱满，就直接删除
	$deleterownum=mysql_affected_rows();
	switch($vartype){
	case 0:
		$query="update tuser set nmnu=nmnu-$delnewnum,rmnu=rmnu-$deleterownum".($su->maxd>$su->dmnu?",dmnu=dmnu+$deleterownum":"")." where id=".$_SESSION['seuserid'].";";
		$su->rmnu -= $deleterownum;
		$su->dmnu += $deleterownum;
	break;
	case 1:
		$query="update tuser set smnu=smnu-$deleterownum".($su->maxd>$su->dmnu?",dmnu=dmnu+$deleterownum":"")." where id=".$_SESSION['seuserid'].";";
		$su->smnu -= $deleterownum;
		$su->dmnu += $deleterownum;
	break;
	case 2:
		$query="update tuser set dmnu=dmnu-$deleterownum where id=".$_SESSION['seuserid'].";";
		$su->dmnu -= $deleterownum;
	break;
	}
	$result=mysql_query($query) or die(f_e($query));
}
?>