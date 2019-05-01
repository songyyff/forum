<?php
e_e();
$query="update tmng set box=box+1 where uid=$uid and type=5 and num=$bid";
mysql_query($query) or die(f_e($query));
if(mysql_affected_rows()){
	$query="update tmng set box=box-1 where uid=$uid and type=5 and num=$irow->box";
	mysql_query($query) or die(f_e($query));
	$query="update tmng set box=$bid where uid=$uid and type=0 and num=$id";
	mysql_query($query) or die(f_e($query));
	$msgs.="<br>[ $id ] 从管理箱 [$irow->box] 成功移动到 [$bid] 管理箱";
}else $msgs.="<br>[ $id ] 从管理箱 [$irow->box] 移动到 [$bid] 管理箱失败";
?>