<?php e_e();

include"s/ck.php";

if($E)f_toerror(submitcontentillegal);

$rgt=($_R['canshow']?$right_saved['usershow']:0)|
($_R['cangview']?$right_saved['guestview']:0);
//|$right_saved['supershow']|$right_saved['usermodify']|$right_saved['userview'];

$mysqli = new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n",mysqli_connect_error());exit();}

$stmt=$mysqli->prepare("update trpl set rigt=rigt&0x".sprintf("%x",0x7fffffff^$right_saved['usershow']^$right_saved['guestview'])."|0x".sprintf("%x",$rgt).",lctm=now(),cuser=?,cuid=$uid,href=?,lan=?,content=? where id=$sid");
$stmt->bind_param('ssss',$_S[seusername],$H,$C,$S);
$stmt->execute();

$q="update trsc set used=0 where rid=$sid";
mysql_query($q) or die(f_e($q));
if($G){
$q="update trsc set used=1 where rid=$sid and id in(".$Q($G,1).")";
mysql_query($q) or die(f_e($q));
}
@header("location: http://$_SERVER[HTTP_HOST]".f_getsubpath()."pro/view.php?noteid=".strtr($_R[hiddenextra],array("p"=>"&page=","s"=>"#site")));
exit;