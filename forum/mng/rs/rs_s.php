<?php e_e();
mb_ereg_search_init("","([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");
function ckstr(&$s,$L){$E=0;mb_ereg_search_init($s),@mb_ereg_search_setpos(0);while($r=@mb_ereg_search_pos())if($r[1]==1&&ord($s[$r[0]])&0x80)$E=1;if($E||strlen($s)>$L)f_toerror(submitcontentillegal);}
ckstr($_R['istat'],1);
ckstr($_R['serstr'],1200);
ckstr($_R['sertag'],(($x=(int)$_R['stype'])&&$x!=4)?120:1000);
ckstr($_R['fromtime'],19);
ckstr($_R['totime'],19);

do{
if($l=count($_R['forums']))for($i=0;$i<$l;$i++)$gstr.=($i?",":"").(int)$_R['forums'][$i];
else{$query="select id from trpl where id=0";break;}
$sqlhead="select t1.*,
t2.name as uname,
t3.name as gname,t3.inum as ginum,
t4.title as ititle,
(select name from tuser where id=t1.lmng) as mname
from trpl as t1 use index(";
$sqlmid=")
left join tuser as t2 use index(primary) on t2.id=t1.uid
left join tgup as t3 use index(primary) on t3.id=t1.gid
left join titem as t4 use index(primary) on t4.id=t1.iid
where t1.gid in ($gstr)";
$sqlend=" limit ".($cpage-1)*$ps.",".$ps;
$stp=(int)$_R['stype'];
if($stp==0||$stp==4){
	$ss="";$l=count($pcs=explode(",",f_rpspc($_R['sertag'])));
	if($l>1||$pcs[0]!="")for($i=0;$i<$l;$i++)if(ctype_digit($x=trim($pcs[$i])))$ss.=($i?",":"").$x;else f_toerror(submitcontentillegal);
}
if($stp){
	$sqlst=" and t1.stat=\"".f_rpspc($_R['istat'])."\"";
	$sstr=f_slquot($_R['serstr']);
	$sqlstr=($sstr==""?"":" and t1.".($_R['torb']?"content":"title")." like \"%$sstr%\"");
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
		$sqlrgt=" and t1.rigt".($_R['rtype']?($r?"&0x".sprintf("%x",$mk^$rs)."!=":"&")."0x".sprintf("%x",$rs):($lmk==$mk?"":"&0x".sprintf("%x",$lmk)).($r?"!=":"=")."0x".sprintf("%x",$rs));
	}
	$stag=str_replace("<","&lt;",f_slquot($_R['sertag']));
	switch($stp){
	case 1:$sqltag=$stag?" and t1.uid=".(int)$stag:"";break;
	case 2:$sqltag=$stag?" and t1.uid=(select id from tuser where name=\"$stag\")":"";break;
	case 3:$sqltag=strlen($stag)>1?" and t1.uid in (select id from tuser where name like \"%$stag%\")":"";break;
	case 4:$sqltag=$ss?" and t1.iid in ($ss)":"";
	}
	$query="";
	if((int)$_R['ext']){
		$ppks=(int)$_R['packnum'];$sqlext=$ppks?"and t2.adnu>=$ppks":"";
		$query=$sqlhead.($sqltag?"gup":"gp").$sqlmid.$sqlst.$sqltag.$sqlext.$sqlrgt.$sqlstr.$sqlend;
	}else{
		if($_R['ftottime'])$pft=date("Y-m-d H:i:s",time()-(int)$_R['sectonow']);
		else {$pft=f_rpspc($_R['fromtime']);$ptt=f_rpspc($_R['totime']);}
		$sqlext=($pft?" and t2.ctime>\"$pft\"":"").($ptt?" and t2.ctime<\"$ptt\"":"");
		$query=$sqlhead.($sqltag?"gut":($sqlrgt?"ggt":"gt")).$sqlmid.$sqlst.$sqltag.$sqlext.$sqlrgt.$sqlstr.$sqlend;
	}
}else	$query=$sqlhead."primary".$sqlmid.($ss?" and t1.id in ($ss)":"").$sqlend;
}while(0);