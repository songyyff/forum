<?php e_e();

$irow=$r;
include"s/ck.php";

if($E)f_toerror(submitcontentillegal);

$rgt=($_R['canshow']?$right_saved['usershow']:0)|
($_R['cangview']?$right_saved['guestview']:0)|
($_R['canrpl']?$right_saved['userrpy']:0);
//|$right_saved['supershow']|$right_saved['superrpy']|$right_saved['usermodify']|$right_saved['userview'];

$mysqli = new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();}

$stmt = $mysqli->prepare("update titem set rigt=rigt&0x".sprintf("%x",0xffffffff^$right_saved['usershow']^$right_saved['guestview']^$right_saved['userrpy'])."|0x".sprintf("%x",$rgt).",rdnum=".(int)$_R[readnum].",lctm=now() , cuser=?, cuid=$uid, title=?,href=?,lan=\"$C\",content=? where id=$sid");
$stmt->bind_param('ssss',$_S[seusername],$T,$H,$S);
$stmt->execute();

$q="update trsc set used=0 where iid=$sid";
mysql_query($q) or die(f_e($q));
if($G){
$q="update trsc set used=1 where iid=$sid and id in(".$Q($G,1).")";
mysql_query($q) or die(f_e($q));
}

//检查是否有修改调查表
if(isset($_R[altsuv]))include"asv.php";
//检查是否有新的调查表
if(isset($_R[suvdate]))include"nsv.php";

@header("location: http://$_SERVER[HTTP_HOST]".f_getsubpath()."pro/view.php?noteid=$sid&page=$_R[hiddenpage]#site0");
die;