<?php e_e();

mb_ereg_search_init("","([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");
function ckstr(&$s,$L){$E=0;mb_ereg_search_init($s);@mb_ereg_search_setpos(0);while($r=@mb_ereg_search_pos())if($r[1]==1&&ord($s[$r[0]])&0x80)$E=1;if($E||strlen($s)>$L)f_toerror(submitcontentillegal);}

ckstr($_R['istat'],1);
ckstr($_R['serstr'],1200);
ckstr($_R['sertag'],(int)$_R['stype']?120:1000);
ckstr($_R['fromtime'],19);
ckstr($_R['totime'],19);

if($len=count($_R['sboxs']))for($i=0;$i<$len;$i++)$umstr.=($i?",":"").(int)$_R['sboxs'][$i];
$sqlhead="select t1.box,t1.ctime as mctime,t1.ltime as mltime,t1.comm,
t2.*,
t3.name as uname,
t4.name as gname,t4.inum as ginum,
t5.name as mname,
(select GROUP_CONCAT(m.ltime,\" <a href=../pro/userinfo.php?userid=\",uid,\">\",u.name,\"</a>:\\\n\",m.comm SEPARATOR \"\\\n\")
from tmng as m use index(tn) left join tuser as u on m.uid=u.id where m.type=9 and m.box=0 and m.num=t1.num group by m.type) as mc
from tmng as t1 use index(ind)
left join titem as t2 use index(primary) on t2.id=t1.num
left join tuser as t3 use index(primary) on t3.id=t2.uid
left join tgup as t4 use index(primary) on t4.id=t2.gid
left join tuser as t5 use index(primary) on t5.id=t2.lmng
where t1.uid=".$_S['seuserid']." and t1.type=0".($umstr?" and t1.box in ($umstr)":"");
$sqlend=" limit ".($cpage-1)*$ps.",".$ps;
if($stp=(int)$_R['stype']){
	$itp=(int)$_R['itype'];
	$idc=(int)$_R['ideco'];
	$sqlstd=" and t2.stat=\"".f_rpspc($_R['istat'])."\"".(isset($_R['itype'])&&$itp?" and t2.type=$itp":"").(isset($_R['ideco'])&&$idc?" and t2.deco=$idc":"");
	$sstr=f_slquot($_R['serstr']);
	$sqlstr=($sstr==""?"":" and t2.".($_R['torb']?"content":"title")." like \"%$sstr%\"");

	switch((int)$_R['ext']){
	case 0:
		if($_R['ftottime'])$pft=date("Y-m-d H:i:s",time()-(int)$_R['sectonow']);
		else {
			$pft=f_rpspc($_R['fromtime']);
			$ptt=f_rpspc($_R['totime']);
		}
		$sqlext=($pft?" and t2.ctime>\"$pft\"":"").($ptt?" and t2.ctime<\"$ptt\"":"");
	break;
	case 1:
		$ppks=(int)$_R['packnum'];
		$sqlext=$ppks?"and t2.adnu>=$ppks":"";
	break;
	case 2:
		$prd=(int)$_R['rdnum'];
		$sqlext=$prd?"and t2.rdnum>=$prd":"";
	}
	if(isset($_R['isright'])){
		$rds[0]=$right_saved['guestview'];
		$rds[1]=$right_saved['userview'];
		$rds[2]=$right_saved['usershow'];
		$rds[3]=$right_saved['usermodify'];
		$rds[4]=$right_saved['userrpy'];
		$rds[5]=$right_saved['supershow'];
		$rds[6]=$right_saved['superrpy'];
		$mk=0x7fffffff;
		$lmk=$mk;$rs=0;
		$str=f_rpspc($_R['right']);
		for($i=0;$i<7;$i++)if($str[$i]){if($str[$i]==1)$rs|=$rds[$i];}else $lmk^=$rds[$i];
		$r=$_R['rnot'];
		$sqlrgt=" and t2.rigt".($_R['rtype']?($r?"&0x".sprintf("%x",$mk^$rs)."!=":"&")."0x".sprintf("%x",$rs):($lmk==$mk?"":"&0x".sprintf("%x",$lmk)).($r?"!=":"=")."0x".sprintf("%x",$rs));
	}

	$stag=str_replace("<","&lt;",f_slquot($_R['sertag']));
	switch($stp){
	case 1:
		$sqltag=$stag?" and t2.uid=".(int)$stag:"";
	case 2:
		if($stp==2)$sqltag=$stag?" and t2.uid=(select id from tuser where name=\"$stag\")":"";
		$q="$sqlhead$sqltag$sqlstd$sqlext$sqlrgt$sqlstr$sqlend";
	break;
	case 3:
		$q="$sqlhead$sqlstd$sqlext$sqlrgt".($stag?" and t3.name like \"%$stag%\"":"").$sqlstr.$sqlend;
	}
}else{
	$ss="";$l=count($pcs=explode(",",trim($_R['sertag'])));
	if($l>1||$pcs[0]!="")for($i=0;$i<$l;$i++)if(ctype_digit($x=trim($pcs[$i])))$ss.=($i?",":"").$x;else f_toerror(submitcontentillegal);
	$q=$sqlhead.($ss?" and t1.num in ($ss)":"").$sqlend;
}