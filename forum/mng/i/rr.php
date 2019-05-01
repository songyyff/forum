<?php
e_e();
$query="update titem set rnum=(select count(id) from trpl where iid=$id and stat='E'),drnu=(select count(id) from trpl where iid=$id and stat!='E') where id=$id";
mysql_query($query) or die(f_e($query));
$query="update trpl as t1 set pos=(select count(*) from (select stime from trpl where iid=$id and stat='E' order by stime) as t2 where t2.stime<=t1.stime) where iid=$id and stat='E'";
mysql_query($query) or die(f_e($query));
$msgs.="<br>[ $id ] 帖子的所有回复位置被重新排序";
?>