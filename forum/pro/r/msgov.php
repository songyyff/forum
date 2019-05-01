<?php
e_e();
$space=$su->maxr-$su->rmnu;
$query="select id from tmsg where uid=$su->id and type=\"2\" and del=0 order by stime asc limit 0,$space;";
$result=mysql_query($query) or die(f_e($query));
$resultrows=mysql_num_rows($result);
$chgrows=0;
for($i=0; $i<$resultrows; $i++){
 	$row=mysql_fetch_object($result);
	$query="update tmsg set type=\"0\" where id=$row->id";
	mysql_query($query) or die(f_e($query));
	$chgrows += mysql_affected_rows();
}
mysql_free_result($result);
$query="update tuser set nmnu=nmnu+$chgrows,rmnu=rmnu+$chgrows, inmnu=inmnu-$chgrows where id=$su->id";
mysql_query($query) or die(f_e($query));
$su->nmnu += $chgrows;
$su->rmnu += $chgrows;
$su->inmnu -= $chgrows;
?>