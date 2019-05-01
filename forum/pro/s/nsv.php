<?php e_e();

include_once"suvck.php";
$E=0;

$R=mysql_query($q="select id from titem where id=$sid and suvn>19") or die(f_e($q));
if(!mysql_num_rows()){
$si=$mysqli->prepare("insert suvy(des,time,min,max,peri,data)values(?,now(),".(int)$_R['minsuv'].",".(int)$_R['maxsuv'].",".(int)$_R['suvdate'].",".(int)$_R['suvaftshow'].")");
ckstr($_R['suvdesc'],$S,4000);
$si->bind_param('s',$S);
$si->execute();
$suvid=$mysqli->insert_id;
$si->close();
$sy=$mysqli->prepare("insert suvi(sid,time,item)values($suvid,now(),?)");
$k=count($_R['suviname']);
for($t=$rn=0;$t<$k;$t++){ckstr($_R['suviname'][$t],$S,2000);$rn++;$sy->bind_param('s',$S);$sy->execute();}
if($rn<2||$E){$q="delete from suvy where id=$suvid";mysql_query($q) or die(f_e($q));$q="delete from suvi where sid=$suvid";
}else{$q="update suvy set iid=$sid,numi=$rn where id=$suvid";mysql_query($q) or die(f_e($q));$q="update titem set suvn=suvn+1 where id=$sid";}
mysql_query($q) or die(f_e($q));
}