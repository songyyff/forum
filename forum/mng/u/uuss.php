<?php e_e();

mb_ereg_search_init("","([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");
function ckstr(&$s,$L){$E=0;mb_ereg_search_init($s),@mb_ereg_search_setpos(0);while($r=@mb_ereg_search_pos())if($r[1]==1&&ord($s[$r[0]])&0x80)$E=1;if($E||strlen($s)>$L)f_toerror(submitcontentillegal);}

ckstr($_R['istat'],1);
ckstr($_R['sertag'],(int)$_R['stype']?120:1000);
ckstr($_R['fromtime'],19);
ckstr($_R['totime'],19);

if($l=count($_R['schboxs']))for($i=0;$i<$l;$i++)$inbox.=($i?",":"").(int)$_R['schboxs'][$i];
$sqlhead="select t1.box,t1.ctime as mctime,t1.ltime as mltime,t1.comm,
t2.*,
t3.name as mname,
(select GROUP_CONCAT(m.ltime,\" <a href=../pro/userinfo.php?userid=\",uid,\">\",u.name,\"</a>:\\\n\",m.comm SEPARATOR \"\\\n\")
from tmng as m use index(tn) left join tuser as u on m.uid=u.id where m.type=11 and m.num=t1.num group by m.type) as mc
from tmng as t1 force index(ind)
left join tuser as t2 on t2.id=t1.num
left join tuser as t3 on t3.id=t2.lmng 
where t1.uid=".$_S['seuserid']." and t1.type=2".($inbox?" and t1.box in ($inbox)":"");
$sqlend=" order by t1.ctime desc limit ".($cpage-1)*$ps.",".$ps;
$stp=(int)$_R['stype'];
if(!$stp){
	$ss="";$l=count($pcs=explode(",",trim($_R['sertag'])));
	if($l>1||$pcs[0]!="")for($i=0;$i<$l;$i++)if(ctype_digit($x=trim($pcs[$i])))$ss.=($i?",":"").$x;else f_toerror(submitcontentillegal);
	$q=$sqlhead.($ss?" and t1.num in ($ss)":"").$sqlend;
}elseif($stp==1){
	$q=$sqlhead.(strlen($_R['sertag'])?" and t2.name=\"".str_replace("<","&lt;",f_slquot($_R['sertag']))."\"":"").$sqlend;
}else{
	if(isset($_R['isright'])){
		$rds[0]=$right_saved['userview'];
		$rds[1]=$right_saved['usernew'];
		$rds[2]=$right_saved['userrpy'];
		$rds[3]=$right_saved['usermodify'];
		$rds[4]=$right_saved['uservote'];
		$rds[5]=$right_saved['usermsg'];
		$rds[6]=$right_saved['usershow'];
		$mk=0x7fffffff;
		$lmk=$mk;$rs=0;
		$str=$_R['right'];
		for($i=0;$i<7;$i++)if($str[$i]){if($str[$i]==1)$rs|=$rds[$i];}else $lmk^=$rds[$i];
		$r=$_R['rnot'];
		$sqlrgt=" and t2.rigt".($_R['rtype']?($r?"&0x".sprintf("%x",$mk^$rs)."!=":"&")."0x".sprintf("%x",$rs):($lmk==$mk?"":"&0x".sprintf("%x",$lmk)).($r?"!=":"=")."0x".sprintf("%x",$rs));
	}
	$st=f_rpspc($_R['state']);
	$stag=str_replace("<","&lt;",f_slquot($_R['sertag']));
	$sx=(int)$_R['sex'];
	$sl=(int)$_R['level'];
	$pft=f_rpspc($_R['fromtime']);
	$ptt=f_rpspc($_R['totime']);
	$q=$sqlhead.
	($sx?" and t2.sex=".($sx-1):"").
	($pft?" and t2.ctime>=\"$pft\"":"").
	($ptt?" and t2.ctime<=\"$ptt\"":"").$sqlrgt.
	($st?" and t2.stat=\"$st\"":"").
	($sl?" and t2.level=$sl":"").
	($stag?" and t2.name like \"%$stag%\"":"").$sqlend;
}