<?php
e_e();
function getlock($table,$id,$l){
$q="update $table set inmg=1,chgt=now() where id=$id and (inmg=0 or abs(unix_timestamp(now())-unix_timestamp(chgt))>200)";
for($i=0;$i<$l;$i++){
mysql_query($q) or die(f_e($q));
if(mysql_affected_rows()) return 0;//成功获取 get lock success
else{
if(!$i)$q="select 1 from $table where id=$id";
$s=mysql_query($q) or die(f_e($q));
$c=mysql_num_rows($s);
mysql_free_result($s);
if($c)sleep(2);else return 2; //没有记录, havn't record
}
}
return 1;//被占用
}
function setunlock($table,$id){$q="update $table set inmg=0,chgt=now() where id=$id";mysql_query($q) or die(f_e($q));}
?>