<?php e_e();

$s="";$U=$_S[seuserid];$len=count($_R['delmsg']);
for($i=0;$i<$len;$i++)$s.=($i?",":"").(int)$_R['delmsg'][$i];
if(!$VT){
$R="select count(id) as cou from msg where uid=$U and type=0 and id in ($s) and rd=0";
$R=mysql_query($R) or die(f_e($R));
$r=mysql_fetch_object($R);
$DN=$r->cou;
mysql_free_result($R);
$su->nmnu-=$DN;
}
if($VT<2){
$q=$su->maxd>$su->dmnu?"update msg set type=2 where uid=$U and type=$VT and id in ($s)":"delete from msg where uid=$U and type=$VT and id in ($s)";
mysql_query($q) or die(f_e($q));
$DR=mysql_affected_rows();
$q=$VT?"update tuser set smnu=smnu-$DR".($su->maxd>$su->dmnu?",dmnu=dmnu+$DR":"")." where id=$U":"update tuser set nmnu=nmnu-$DN,rmnu=rmnu-$DR".($su->maxd>$su->dmnu?",dmnu=dmnu+$DR":"")." where id=$U";
mysql_query($q) or die(f_e($q));
if($VT)$su->smnu-=$DR;else$su->rmnu-=$DR;
if($su->maxd>$su->dmnu)$su->dmnu+=$DR;
}else{
$q="update msgs set ref=ref-1 where bid in(select mid from msg where uid=$U and type=2 and  id in($s))";
mysql_query($q) or die(f_e($q));
$q="delete from msgs where bid in(select mid from msg where uid=$U and type=2 and id in($s)) and ref=0";
mysql_query($q) or die(f_e($q));
$q="delete from msg where uid=$U and type=2 and id in ($s)";
mysql_query($q) or die(f_e($q));
$DR=mysql_affected_rows();
$q="update tuser set dmnu=dmnu-$DR where id=$U";
mysql_query($q) or die(f_e($q));
$su->dmnu-=$DR;
}