<?php e_e();

mb_ereg_search_init("","([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");
function ckstr(&$s,$L){$E=0;mb_ereg_search_init($s),@mb_ereg_search_setpos(0);while($r=@mb_ereg_search_pos())if($r[1]==1&&ord($s[$r[0]])&0x80)$E=1;if($E||strlen($s)>$L)f_toerror(submitcontentillegal);}

ckstr($_R['istat'],1);
ckstr($_R['serstr'],1200);
ckstr($_R['sertag'],(($x=(int)$_R['stype'])&&$x!=3)?120:1000);
ckstr($_R['fromtime'],19);
ckstr($_R['totime'],19);

if($len=count($_R['sboxs']))for($i=0;$i<$len;$i++)$umstr.=($i?",":"").(int)$_R['sboxs'][$i];
$sqlhead="select t1.num,t1.box,t1.ctime as mctime,t1.ltime as mltime,t1.comm,
t2.*,
t3.name as uname,
t4.name as gname,t4.inum as ginum,
t5.title as ititle,
t6.name as mname,
(select GROUP_CONCAT(m.ltime,\" <a href=../pro/userinfo.php?userid=\",uid,\">\",u.name,\"</a>:\\\n\",m.comm SEPARATOR \"\\\n\")
from tmng as m use index(tn) left join tuser as u on m.uid=u.id where m.type=10 and m.num=t1.num group by m.type) as mc
from tmng as t1 use index(ind)
left join trpl as t2 use index(primary) on t2.id=t1.num
left join tuser as t3 use index(primary) on t3.id=t2.uid
left join tgup as t4 use index(primary) on t4.id=t2.gid
left join titem as t5 use index(primary) on t5.id=t2.iid
left join tuser as t6 use index(primary) on t6.id=t2.lmng
where t1.uid=".$_S['seuserid']." and t1.type=1".($umstr?" and t1.box in ($umstr)":"");
$sqlm1="";
$sqlend=" limit ".($cpage-1)*$ps.",".$ps;
$stp=(int)$_R['stype'];
if($stp==0||$stp==3){
	$ss="";$l=count($pcs=explode(",",trim($_R['sertag'])));
	if($l>1||$pcs[0]!="")for($i=0;$i<$l;$i++)if(ctype_digit($x=trim($pcs[$i])))$ss.=($i?",":"").$x;else f_toerror(submitcontentillegal);
}
if($stp){
	$sqlst=" and t2.stat=\"".f_rpspc($_R['istat'])."\"";
	$sstr=f_slquot($_R['serstr']);
	$sqlstr=($sstr==""?"":" and t2.".($_R['torb']?"content":"title")." like \"%$sstr%\"");

	if(isset($_R['isright'])){
		$rds[0]=$right_saved['guestview'];
		$rds[1]=$right_saved['userview'];
		$rds[2]=$right_saved['usershow'];
		$rds[3]=$right_saved['usermodify'];
		$rds[4]=$right_saved['supershow'];
		$rds[5]=$right_saved['userrpy'];
		$rds[6]=$right_saved['superrpy'];
		$mk=0x7fffffff;
		$lmk=$mk;$rs=0;
		$str=$_R['right'];
		for($i=0;$i<7;$i++)if($str[$i]){if($str[$i]==1)$rs|=$rds[$i];}else $lmk^=$rds[$i];
		$r=$_R['rnot'];
		$sqlrgt=" and t2.rigt".($_R['rtype']?($r?"&0x".sprintf("%x",$mk^$rs)."!=":"&")."0x".sprintf("%x",$rs):($lmk==$mk?"":"&0x".sprintf("%x",$lmk)).($r?"!=":"=")."0x".sprintf("%x",$rs));
	}
	$q="";
	if((int)$_R['ext']){
		$sqlext=($ppks=(int)$_R['packnum'])?"and t2.adnu>=$ppks":"";
	}else{
		if($_R['ftottime'])$pft=date("Y-m-d H:i:s",time()-(int)$_R['sectonow']);
		else {$pft=f_rpspc(trim($_R['fromtime']));$ptt=f_rpspc(trim($_R['totime']));}
		$sqlext=($pft?" and t2.ctime>\"$pft\"":"").($ptt?" and t2.ctime<\"$ptt\"":"");
	}
	$stag=str_replace("<","&lt;",f_slquot($_R['sertag']));
	switch($stp){
	case 1:$sqltag=$stag?" and t2.uid=\"$stag\"":"";break;
	case 2:$sqltag=$stag?" and t2.uid=(select id from tuser where name=\"$stag\")":"";break;
	case 3:$sqltag=$ss?" and t2.iid in ($ss)":"";break;
	case 4:$sqltag=$stag?" and t3.name like \"%$stag%\"":"";
	}
	if($stp<4)$q=$sqlhead.$sqlst.$sqltag.$sqlext.$sqlrgt.$sqlstr.$sqlm1.$sqlend;
	else $q=$sqlhead.$sqlst.$sqlext.$sqlrgt.$sqlm1.$sqltag.$sqlstr.$sqlend;

}else	$q=$sqlhead.($ss?" and t1.num in ($ss)":"").$sqlm1.$sqlend;