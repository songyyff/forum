<?php e_e();

$CR=$r;
include"s/ck.php";
$r=$CR;

if($E)f_toerror(submitcontentillegal);

include"../mng/lock.php";
if($lk=getlock("titem",$sid,5)){
if($lk==1)$msg="系统繁忙，请稍后再试。";
else f_toerror(rplitemdeled);
}else{

$rgt|=($_R['canshow']?$right_saved['usershow']:0)|
($_R['cangview']?$right_saved['guestview']:0)|
$right_saved['supershow']|$right_saved['usermodify']|$right_saved['userview'];

function f_mtime(){list($u,$s)=explode(" ",microtime()); return ((float)$u+(float)$s);}

$mysqli = new mysqli($_host,$_super,$_pass,$_db,$_port);
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());exit();}
$mysqli->query("set names utf8");
$stmt=$mysqli->stmt_init();
$stmt->prepare("insert into trpl(pos,stime,rigt,gid,uid,iid,ctime,href,lan,content)values(".($r->rnum+1).",".f_mtime().",$rgt,$r->gid,$uid,$sid,now(),?,\"$C\",?)");
$stmt->bind_param("ss",$H,$S);
$stmt->execute();
$id=$mysqli->insert_id;

if($tID=(int)$_R[tid]){
$q="update trsc set rid=$id where rid=-$tID and uid=$uid and TO_DAYS(now())-TO_DAYS(time)<3";
mysql_query($q) or die(f_e($q));
if($as=mysql_affected_rows()){
$q="update trpl set adnu=$as where id=$id";
mysql_query($q) or die(f_e($q));
}
if($G){
$q="update trsc set used=1 where rid=$id and id in(".$Q($G,1).")";
mysql_query($q) or die(f_e($q));
}
}

$q="update tgup set rnum=rnum+1 where id=$r->gid";
mysql_query($q) or die(f_e($q));

$stmt=$mysqli->stmt_init();
$stmt->prepare("update titem set lrrg=$rgt,rnum=rnum+1,lrid=$id,luid=$uid,luser=?,ltime=now() where id=$sid");
$stmt->bind_param("s",$_S[seusername]);
$stmt->execute();
$q="update tuser set rnum=rnum+1,inte=inte+".($pointperreplay+$pointperaddtional*$as)." where id=$uid";
mysql_query($q) or die(f_e($q));

setunlock("titem",$sid);

@header("location: http://$_SERVER[HTTP_HOST]".f_getsubpath()."pro/view.php?noteid=$sid&page=".(int)(($i=$r->rnum+1)/$_S[serpsize])."#site".($i%$_S[serpsize])); exit; 

}