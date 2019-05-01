<?php
e_e();
$rs=0;
$rrs=(int)$_REQUEST['right'.$id];
if($rrs&1)$rs|=$right_saved['guestview'];
if($rrs&2)$rs|=$right_saved['userview'];
if($rrs&4)$rs|=$right_saved['usershow'];
if($rrs&8)$rs|=$right_saved['usermodify'];
if($rrs&16)$rs|=$right_saved['userrpy'];
if($rrs&32)$rs|=$right_saved['supershow'];
if($rrs&64)$rs|=$right_saved['superrpy'];
if($irow->rigt!=$rs){
	$query="update titem set rigt=$rs where id=$id";
	mysql_query($query) or die(f_e($query));
	$msgs.="<br>[ $id ] 权限被重设";
}
?>