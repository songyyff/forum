<?php e_e(); //提交修改调查表

include_once"suvck.php";

$Du=$mysqli->prepare("delete from suvu where(type=1 and ids=?)or(type=0 and ids in(select id from suvi where sid=?))");$Du->bind_param('ii',$I,$I);
$Uy=$mysqli->prepare("update suvy set num=0,inu=0,imax=0,time=now(),numi=numi+? where id=?");$Uy->bind_param('ii',$x,$I);
$Ui=$mysqli->prepare("update suvi set num=0,time=now() where sid=?");$Ui->bind_param('i',$I);
function ut(){global$Uy,$Ui,$Du;$Uy->execute();$Ui->execute();$Du->execute();}

//删除调查
if($c=&$_R['delsuv']){
$Di=$mysqli->prepare("delete from suvi where sid=?");
$Di->bind_param('i',$I);
$Dy=$mysqli->prepare("delete from suvy where id=? and iid=$sid");
$Dy->bind_param('i',$I);
for($p=$i=0,$l=count($c);$i<$l;$i++){$I=$c[$i];$Dy->execute();if($Dy->affected_rows){$p++;$Di->execute();$Du->execute();}}
if($p){$Ui=$mysqli->prepare("update titem set suvn=suvn-? where id=$sid");$Ui->bind_param('i',$p);$Ui->execute();}
$Ui->close();$Di->close();$Dy->close();}
//添加新条目
if($b=&$_R['esuvadd']){
$sy=$mysqli->prepare("select id from suvy where id=? and iid=$sid");
$sy->bind_param('i',$I);
$si=$mysqli->prepare("insert suvi(sid,time,item)values(?,now(),?)");
$si->bind_param('is',$I,$S);
for($W=&$_R['esuvia'],$P=$i=0,$l=count($a=explode(",",$b));$i<$l;$i++){$I=$a[$i];$x=0;
$sy->execute();$sy->store_result();
if($sy->num_rows){for($il=(int)$a[++$i],$p=0;$p<$il;$p++)if($s=&$W[$P++]){$E=0;ckstr($s,$S,4000);if($E)continue;$si->execute();$x++;}
if($x)ut();}}
$sy->close();$si->close();}
$x=0;
//修改条目
if($l=count($A=&$_R['esuvci'])){$W=&$_R['esuvi'];$sd=$e=$d=$V=$VI=$T=0;
$si=$mysqli->prepare("select i.sid from suvi as i left join suvy as y on y.id=i.sid where i.id=? and y.iid=$sid");
$si->bind_param('i',$w);
$si->bind_result($VI);
$su=$mysqli->prepare("update suvi as i set i.item=? where i.id=?");
$su->bind_param('si',$S,$w);
for($i=0;$i<$l;$i++){$w=$A[$i];
$si->execute();$VI=0;$si->fetch();$si->fetch();
if($V!=$VI){if($V&&($e||$d)){$I=$V;ut();$d=$e=0;}$V=$VI;}
if($VI)if($s=&$W[$i]){$E=0;ckstr($s,$S,4000);if($E)continue;$su->execute();$e|=$su->affected_rows;
}else{if(!$sd){$sd=$mysqli->prepare("delete from suvi where id=? and (select y.numi>2 from suvy as y where y.id=suvi.sid)");$sd->bind_param('i',$w);
$se=$mysqli->prepare("update suvy set numi=numi-1 where id=?");$se->bind_param('i',$VI);}
$sd->execute();if($sd->affected_rows){$d=1;$se->execute();}}}
$I=$VI;ut();
$si->close();$su->close();if($sd){$sd->close();$se->close();}}
//修改投票
if($l=count($a=&$_R['esuvt'])){
$su=$mysqli->prepare("update suvy set num=0,inu=0,imax=0,time=now(),peri=?,des=?,min=?,max=?,data=? where id=? and iid=$sid");
$su->bind_param('isiiii',$t,$S,$mi,$ma,$u,$I);
for($h=$v=$i=0,$MI=&$_R['eminsuv'],$MA=&$_R['emaxsuv'],$m=&$_R['esuvmut'],$f=&$_R['esuvaftshow'],$p=&$_R['esuvpriod'],$d=&$_R['esuvdesc'];$i<$l;$i++){$E=0;ckstr($d[$i],$S,4000);if($E&&$S)continue;$I=$a[$i];if($m[$v]==$I){$mi=(int)$MI[$v];$ma=(int)$MA[$v++];}else$mi=$ma=0;$t=(int)$p[$i];if($u=$f[$h]==$I)$h++;
$su->execute();if($su->affected_rows){$Ui->execute();$Du->execute();}}
$su->close();$si->close();}
?>