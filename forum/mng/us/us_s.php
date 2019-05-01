<?php e_e();

mb_ereg_search_init("","([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");
function ckstr(&$s,$L){$E=0;mb_ereg_search_init($s),@mb_ereg_search_setpos(0);while($r=@mb_ereg_search_pos())if($r[1]==1&&ord($s[$r[0]])&0x80)$E=1;if($E||strlen($s)>$L)f_toerror(submitcontentillegal);}

ckstr($_R['istat'],1);
ckstr($_R['sertag'],(int)$_R['stype']?120:1000);
ckstr($_R['fromtime'],19);
ckstr($_R['totime'],19);

do{
$sqlhead="select id,name,stat,sex,rigt,level,ctime,inum,dnum,rnum,drnu from tuser force index(";
$sqlmid=") where";
$sqlend=" limit 100";
$stp=(int)$_R['stype'];
if(!$stp){
	$ss="";$l=count($pcs=explode(",",trim($_R['sertag'])));
	if($l>1||$pcs[0]!="")for($i=0;$i<$l;$i++)if(ctype_digit($x=trim($pcs[$i])))$ss.=($i?",":"").$x;else f_toerror(submitcontentillegal);
	$query=$sqlhead."primary".$sqlmid.($ss?" id in ($ss)":" id>0").$sqlend;
}elseif($stp==1){
	$query=$sqlhead."name".$sqlmid.(strlen($_R['sertag'])?" name=\"".str_replace("<","&lt;",f_slquot($_R['sertag']))."\"":" name!=''").$sqlend;
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
		$sqlrgt=" and rigt".($_R['rtype']?($r?"&0x".sprintf("%x",$mk^$rs)."!=":"&")."0x".sprintf("%x",$rs):($lmk==$mk?"":"&0x".sprintf("%x",$lmk)).($r?"!=":"=")."0x".sprintf("%x",$rs));
	}
	$st=f_rpspc($_R['state']);
	$stag=str_replace("<","&lt;",f_slquot($_R['sertag']));
	$sx=(int)$_R['sex'];
	$sl=(int)$_R['level'];
	$pft=f_rpspc($_R['fromtime']);
	$ptt=f_rpspc($_R['totime']);
	$query=$sqlhead."si".$sqlmid.($sx?" and sex=".($sx-1):"").($pft?" and ctime>=\"$pft\"":"").($ptt?" and ctime<=\"$ptt\"":"").$sqlrgt.($st?" and stat=\"$st\"":"").($sl?" and level=$sl":"").($stag?" and name like \"%$stag%\"":"").$sqlend;
	$query[94]=' ';$query[95]=' ';$query[96]=' ';
}
}while(0);