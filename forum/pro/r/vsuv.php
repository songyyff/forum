<?php

e_e();

function showsurvey($r){
global $uid;
$q="select s.*,u.uid from suvy as s use index(s) left join suvu as u on(u.type=1 and s.id=u.ids and u.uid=$uid) where iid=$r->id order by id";
$rs=mysql_query($q) or die(f_e( $q));
if(!mysql_num_rows($rs))return;
echo "
<div id=surveydiv></div>
<script language=javascript>
var suvdbs=[
";
$q="select i.*,u.uid from suvi as i use index(s)
left join suvu as u on(u.type=0 and i.id=u.ids and u.uid=$uid)
where i.sid in(select id from suvy use index(s) where iid=$r->id) order by i.sid,i.id";
$is=mysql_query($q) or die(f_e( $q));
$a=array();$h=0;
while($w=mysql_fetch_object($rs)){
	$t=$w->uid||($w->peri&&(time()-strtotime($w->time))>$w->peri*86400)?1:($w->data?2:3);
	echo "[$w->id,$t,$w->num,$w->inu,$w->imax,$w->min,$w->max,$w->peri,\"$w->time\",\"$w->des\",$w->alt],
";
	$a[$h++]=(int)$w->id;$a[$h++]=$t;
}
echo "$r->alts],
suvdbis=[
[";
$h=0;$k=1;
while($g=mysql_fetch_object($is)){
	while($a[$h]!=$g->sid){echo "0],
[";$h+=2;$k+=2;}
	echo "$g->id,\"$g->item\",",$a[$k]&1?$g->num:0,",";
}
echo "0]
]
</script>
<script src=js/sus.js language=javascript></script>
";
}

showsurvey($r);