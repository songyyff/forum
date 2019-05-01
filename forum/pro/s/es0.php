<?php e_e();

include"s/ck.php";

if($E)f_toerror(submitcontentillegal);

$rgt|=($_R['canshow']?$right_saved['usershow']:0)|
($_R['cangview']?$right_saved['guestview']:0)|
($_R['canrpl']?$right_saved['userrpy']:0)|
$right_saved['supershow']|$right_saved['superrpy']|$right_saved['usermodify']|$right_saved['userview'];

$mysqli = new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}

$stmt = $mysqli->prepare("insert into titem(rigt,rdnum,ltime,uid,gid,ctime,title,href,lan,content) values ($rgt,\"".(int)$_R['readnum']."\",now(),$uid,$sid,now(),?,?,?,?)");
$stmt->bind_param('ssss',$T,$H,$C,$S);
$stmt->execute();
$id=$mysqli->insert_id;

if($tID=(int)$_R[tid]){
$q="update trsc set iid=$id where iid=-$tID and uid=$uid and TO_DAYS(now())-TO_DAYS(time)<3";
mysql_query($q) or die(f_e($q));
if($as=mysql_affected_rows()){
$q="update titem set
adnu=$as,
adoi=(select count(*) from trsc where iid=$id and substr(type,1,2)='a/'),
vdoi=(select count(*) from trsc where iid=$id and substr(type,1,2)='v/'),
pici=(select count(*) from trsc where iid=$id and substr(type,1,2)='i/'),
athi=adnu-adoi-vdoi-pici
where id=$id";
mysql_query($q) or die(f_e($q));
}
if($G){
$q="update trsc set used=1 where iid=$id and id in(".$Q($G,1).")";
mysql_query($q) or die(f_e($q));
}
}
//更新组信息
$q="update tgup set inum=inum+1,ltime=now() where id=$sid";
mysql_query($q) or die(f_e($q));

//更新用户信息
$q="update tuser set inum=inum+1,inte=inte+".($pointperitem+$pointperaddtional*$as)." where id=$uid";
mysql_query($q) or die(f_e($q));

//检查是否有新的调查表
if(isset($_R['suvdate']))include"nsv.php";

@header("location: http://".$_SERVER['HTTP_HOST'].f_getsubpath()."pro/view.php?noteid=$id#site0"); exit;