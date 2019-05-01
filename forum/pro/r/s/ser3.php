<?php
function f_mtime(){list($u,$s)=explode(" ",microtime()); return ((float)$u+(float)$s);}
e_e();
do{
	$umstr="";
	if($len=count($_REQUEST['forums']))for($i=0;$i<$len;$i++)$umstr.=($i?",":"")."\"".$_REQUEST['forums'][$i]."\"";
	else {$resultmsg="没有选择任何目标论坛";break;}
	
	//计算页面数
	if(1>$currentpage=(int)$_REQUEST['page'])$currentpage=1;
	if($currentpage>50)$currentpage=50;
	$pftime="";$pttime="";$ppacks=0;
	$sqlhead="select t1.*,t2.name as gname,t2.rigt as grigt,t2.inum as ginum,t3.name as uname from ".($_REQUEST['norr']?"trpl":"titem")." as t1 force index";
	$sqlmid=",tgup as t2,tuser as t3 where t1.gid in ($umstr) and t1.stat='E'";
	$sqlend=" and ".($_REQUEST['serstr']?"content":"title")." like \"%".f_rpspc(str_replace(" ","%",$_REQUEST['serstr']))."%\" and t2.id=t1.gid and t3.id=t1.uid limit ".($currentpage-1)*$_SESSION['seitsize'].",".$_SESSION['seitsize'];
	
	if($_REQUEST['usertype']){ //用户id
		$puid=(int)$_REQUEST['seruser'];
	}else{//用户名
		$puname=f_rpspc(trim($_REQUEST['seruser']));
		if($puname!=""){
			$query="select id from tuser where name=\"$puname\"";
			$result=mysql_query($query) or die(f_e($query));
			if(mysql_num_rows($result)) $urow=mysql_fetch_object($result);
			else {$resultmsg="查无此[".f_rpspc($_REQUEST['seruser'])."]用户，请确定您填写用户名是否正确";
				mysql_free_result($result);break;}
			mysql_free_result($result);
			$puid=$urow->id;
		}else $puid="";
	}
	if($_REQUEST['torp']){//按附件
		$ppacks=(int)$_REQUEST['packnum'];
		if($puid==""){
		$query="$sqlhead(gp)$sqlmid ".($ppacks?"and t1.adnu>=$ppacks":"")." $sqlend";
		}else{
		$query="$sqlhead(gup)$sqlmid and t1.uid=$puid ".($ppacks?"and t1.adnu>=$ppacks":"")." $sqlend";
		}
	}else{//按时间
		if($_REQUEST['ftottime']){$pftime=date("Y-m-d H:i:s",time()-(int)$_REQUEST['sectonow']);}
		else {
			$pftime=f_rpspc(trim($_REQUEST['fromtime']));
			$pttime=trim($_REQUEST['totime'])=="现在"?"":f_rpspc(trim($_REQUEST['totime']));
		}
		$ptimecon=($pftime!=""?" and t1.ctime>\"$pftime\"":"").($pttime?" and t1.ctime<\"$pttime\"":"");
		if($puid==""){
		$query="$sqlhead(gt)$sqlmid $ptimecon $sqlend";
		}else{
		$query="$sqlhead(gut)$sqlmid and t1.uid=\"$puid\" $ptimecon $sqlend";
		}
	}
}while(0);
//echo $query;
if($resultmsg==""){
	$starttime=f_mtime();
	$result=mysql_query($query) or die(f_e($query));
	$endtime=f_mtime();
	$len=mysql_num_rows($result);
	$pagestr="";
	if($len<$_SESSION['seitsize']){
		if($currentpage>10) $i=$currentpage-9;
		else $i=1;
		$plen=$currentpage;
	}else{
		if($currentpage<6)$i=1;
		else if($currentpage>50-6) $i=50-9;
		else $i=$currentpage-5;
		$plen=$i+9;
	}
	$pagestr="<font class=msgpagenum>".(($currentpage-1)*$_SESSION['seitsize']+1)."/$len</font>";
	if($plen>10) $pagestr.="<a class=msgpage href=\"javascript:gotopage($vartype,1)\">[1]</a>";
	for(;$i<=$plen;$i++){
		if($i==$currentpage) $pagestr.="<font class=visitedmsgpage>$i</font>";
		else $pagestr.="<a class=msgpage href=\"javascript:gotopage($vartype,$i)\">$i</a>";
	}
}
?>