<?php e_e();

//写入email变量文件

$fname="$_rootpath/w/mailsetvar.php";
@unlink($fname);
if($h=@fopen($fname,"w")){
fwrite($h, "<?php
e_e();
// DATE: ".date("Y-m-d H:i:s",time()));
$z=Array();$i=0;
$q="select * from tdict where type=12 order by key1";
$rs=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($rs))fwrite($h,"
\$M$r->info=\"".addslashes($r->info2)."\";");
mysql_free_result($rs);
fwrite($h, "
?>");
@fclose ($h);
}