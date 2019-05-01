<?php
e_e();
$q="update tmng set box=box-1 where uid=$uid and type=5 and num=(select box from (select box from tmng where uid=$uid and type=0 and num=$id) as t2)";
mysql_query($q) or die(f_e($q));
$q="delete from tmng where uid=$uid and type=0 and num=$id";
mysql_query($q) or die(f_e($q));
$msgs.="<br>[ $id ] 被管理后放弃管理";
$mlost=1;
?>