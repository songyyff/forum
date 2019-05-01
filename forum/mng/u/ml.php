<?php e_e();
$q="update tmng set box=box-1 where uid=$uid and type=7 and num=$irow->box";
mysql_query($q) or die(f_e($q));
$q="delete from tmng where uid=$uid and type=2 and num=$id";
mysql_query($q) or die(f_e($q));
$msgs[]="被管理后放弃";