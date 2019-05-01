<?php e_e();
//  作者: 宋云峰 author: song
//  更新: 2008-8-5

if(($len1=count($_R['comms']))||($len2=count($_R['mscomms']))){

$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}

//comm
if($len1){
$stmt=$mysqli->stmt_init();
$stmt->prepare("update tmng use index(se) set comm=? where uid=$uid and type=2 and num=?");
$stmt->bind_param('si',$S,$tid);
for($i=0;$i<$len1;$i++){
	$tid=(int)$_R['comms'][$i];
	$S=str_replace("<","&lt;",$_R["comm$tid"]);
	$stmt->execute();
}
$stmt->close();
}

//mngcomms
if($len2&&$userrow->srgt&$right_saved['supermodify']){
$stmt=$mysqli->stmt_init();
$stmt->prepare("update tmng use index(tn) set comm=? where type=11 and num=? and uid=$uid");
$stmt->bind_param('si',$S,$tid);
for($i=0;$i<$len2;$i++){
	$tid=(int)$_R['mscomms'][$i];
	$S=str_replace("<","&lt;",$_R["mscomm$tid"]);
	if(strlen($S)){
		$q="insert into tmng(type,num,uid,ctime)values(11,$tid,$uid,now())";
		mysql_query($q)or$N=mysql_errno();
		if($N&&$N!=1062)die(f_e($q));else$stmt->execute();
	}else{
		$q="delete from tmng where uid=$uid and type=11 and num=$tid";
		mysql_query($q) or die(f_e($q));
	}
}
$stmt->close();
}
}

//mngs
$srigt=(int)$userrow->srgt;
if($len=count($_R['mngs'])){
	include "../mng/lock.php";
	for($i=0;$i<$len;$i++){
		$id=(int)$_R['mngs'][$i];
		//echo $id;
		//询问用户是否在修改状态, check user if in alter state
		if(!$LC=getlock("tuser",$id,3)){
			$query="select t1.box,
t2.id,t2.name,t2.rdnum,t2.inte,t2.money,t2.inum,t2.rnum,t2.dnum,t2.drnu,t2.srgt,t2.rigt,t2.stat,t2.maxr,t2.rmnu
from tmng as t1 force index(se)
left join tuser as t2 force index(primary) on t2.id=t1.num
where t1.uid=$uid and t1.type=2 and t1.num=$id";
			$r1=mysql_query($query) or die(f_e($query));
			$irow=mysql_fetch_object($r1);
			mysql_free_result($r1);
			if($irow){
				$q="update tuser set lmng=$_S[seuserid],lmtm=now() where id=$id";
				mysql_query($q) or die(f_e($q));
				
				$msgs[]="[ $id ]";
				unset($tmsg);
				//delete
				if($_R['isrmv'.$id]){
					//del
					if($irow->srgt&$right_saved['userismng'])$msgs[]="用户是管理员，您无权删除用户或用户全部帖子和全部回复。";
					else{ //不具有某版块的管理权，可以管理, don't have someforum's manage right,  can do manage
						if($_R['del'.$id])if($srigt&$right_saved['superdel']){// 删除用户权, check delete user right
							include "u/delu.php";
							continue;
						}else $msgs[]="您没有删除用户的权力。";
						if($_R['di'.$id])include "u/delui.php";//删除帖子, delete item
						if($_R['dr'.$id])include "u/delur.php";//删除回复, delete replay
					}
					//重置, reset
					if($right_saved['supermodify']&$srigt){
						if($_R['sp'.$id]){//密码, password
							 $s1=",pass='353535353535',pkey='000000000000'";
							 $msgs[]="用户密码被重置为 555555。";
							 //需要给用户发送邮件, need send email to user
						}
						if($_R['spc'.$id]){$s2=",face=''";$msgs[]="用户头像被重置。";$tmsg[]="用户头像被重置。";}
						if($_R['ss'.$id]){$s3=",sign=''";$msgs[]="用户签名被重置。";$tmsg[]="用户签名被重置。";}
						if($_R['si'.$id]){$s4=",info=''";$msgs[]="用户简介被重置。";$tmsg[]="用户简介被重置。";}
					}else $msgs[]="无用户修改权无法重置用户数据。";
				}
				//修改参数, alter options
				if($right_saved['supermodify']&$srigt){
					//修改状态, alter state
					if($_R['isbs'.$id]){
						//设置状态, set state
						if($_R['ustat'.$id]!=$irow->stat){
							$query="update tuser set stat=\"".f_rpspc($_R['istat'.$id])."\" where id=$id";
							mysql_query($query) or die(f_e($query));
							$msgs[]="状态由 [$irow->stat] 改变至 [".$_R['istat'.$id]."]";
						}
						//设置, set
						$s5=",level=".(int)$_R['level'.$id].",maxr=".(int)$_R['mmr'.$id].",maxs=".(int)$_R['mms'.$id].",maxd=".(int)$_R['mmd'.$id].",maxsb=".(int)$_R['msb'.$id].",maxf=".(int)$_R['mf'.$id];
						$msgs[]="最大值重设";
					}
					if($_R['isinc'.$id]){//增加值, add number
						if(($prdn=(int)$_R['rdn'.$id])&&($prdn=$prdn<0&&-1*$prdn>=$irow->rdnum?-1*$irow->rdnum:$prdn)){
							$s6=",rdnum=rdnum+$prdn"; 
							$msgs[]="阅读权+$prdn=".($irow->rdnum+$prdn);
							$tmsg[]="您的阅读权".($prdn>0?"增加了$prdn":"减去了".(-1*$prdn))."分；理由：".f_rpspc($_R['rdnc'.$id]);
						}
						if(($pmny=(int)$_R['mny'.$id])&&($pmny=$pmny<0&&-1*$pmny>=$irow->money?-1*$irow->money:$pmny)){
							$s7=",money=money+$pmny"; 
							$msgs[]="金钱+$pmny=".($irow->money+$pmny);
							$tmsg[]="您的金钱".($pmny>0?"增加了$pmny":"减去了".(-1*$pmny))."元；理由：".f_rpspc($_R['mnyc'.$id]);
						}
						if(($ppit=(int)$_R['pit'.$id])&&($ppit=$ppit<0&&-1*$ppit>=$irow->inte?-1*$irow->inte:$ppit)){
							$s8=",inte=inte+$ppit"; 
							$msgs[]="积分+$ppit=".($irow->inte+$ppit);
							$tmsg[]="您的积分".($ppit>0?"增加了$ppit":"减去了".(-1*$ppit))."分；理由：".f_rpspc($_R['pitc'.$id]);
						}
					}
					//设置权限, set right
					if($_R['isright'.$id]){
						$rs=0;
						$rrs=(int)$_R["right".$id];
						if($rrs&1)$rs|=$right_saved['userview'];
						if($rrs&2)$rs|=$right_saved['usernew'];
						if($rrs&4)$rs|=$right_saved['userrpy'];
						if($rrs&8)$rs|=$right_saved['usermodify'];
						if($rrs&16)$rs|=$right_saved['uservote'];
						if($rrs&32)$rs|=$right_saved['usermsg'];
						if($rrs&64)$rs|=$right_saved['userstop'];
						if($irow->rigt!=$rs){
							$s9=",rigt=$rs";
							$msgs[]="权限被重设";
						}
					}
					//数据重计算 贴数，回复有效无效数, recount enabled and desabled item/replay number
					if($_R['src'.$id]){
						$s0=",inum=(select count(id) from titem where uid=$irow->id and stat='E'),dnum=(select count(id) from titem where uid=$irow->id and stat!='E'),rnum=(select count(id) from trpl where uid=$irow->id and stat='E'),drnu=(select count(id) from trpl where uid=$irow->id and stat!='E')";
					}
					//迁移管理箱, move to other manage box
					if($_R['ismb'.$id]&&$irow->box!=($bid=(int)$_R['box'.$id])){
						$query="update tmng set box=box+1 where uid=$uid and type=7 and num=$bid";
						mysql_query($query) or die(f_e($query));
						if(mysql_affected_rows()){
							$query="update tmng set box=box-1 where uid=$uid and type=7 and num=$irow->box";
							mysql_query($query) or die(f_e($query));
							$query="update tmng set box=$bid where uid=$uid and type=2 and num=$id";
							mysql_query($query) or die(f_e($query));
							$msgs[]="从管理箱 [$irow->box] 成功移动到 [$bid] 管理箱";
						}else $msgs[]="从管理箱 [$irow->box] 移动到 [$bid] 管理箱失败";
					}
					//管理后放弃, release after manange
					if($_R['lsm'.$id])include"ml.php";
					//提交用户信息, set user manager information
					$query="update tuser set $s1$s2$s3$s4$s5$s6$s7$s8$s9$s0 where id=$id";
					//echo $query;
					if($query[17]==","){$query[17]=" ";mysql_query($query) or die(f_e($query));}
				}else $msgs[]="没有用户管理员修改权";
				if(count($tmsg)){ //向用户发送消息, send message to user
					include "../mng/smsg.php";
					sendmsg($userrow,$irow,"管理员管理用户消息","\n".join($tmsg,"\n")."\n",1);
				}
			} else $msgs[]="数据不完整，需要校验帖子相关数据库";
			setunlock("tuser",$id);
		}elseif($LC==2&&$_R['lsm'.$id])include"ml.php";else{$msgs[]="[ $id ]"; $msgs[]=$LC==1?"用户正在被其他管理员修改。":"用户已经被删除。";
	}
	}
}