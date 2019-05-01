<?php include"../func/mustfunc.php";

if(!$uid=$_S['seuserid'])f_toerror(nologin);
$vtype=(int)$_R['type'];
$sid=(int)$_R['actionid'];
if($vtype!=0&&$vtype!=2||!$sid)f_toerror(urlerror);
$M=$_S['seismng'];

include"r/er$vtype.php";
if($i)f_toerror($i);

$m=$right_saved['usershow']|$right_saved['guestview']|($vtype?0:$right_saved['userrpy']);
$rgt=($vtype?$r->rrgt:$r->irgt)&$m;

if(isset($_R['con']))include"s/es$vtype.php";