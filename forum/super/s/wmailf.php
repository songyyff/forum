<?php e_e();

//写入邮件页脚

$fname="$_rootpath/w/mailfootvar.php";
@unlink($fname);
if($h=@fopen($fname,"w")){
$q="select info from tdict where type=13 and ikey in('footmode','mailrealfoot') order by ikey";
$rs=mysql_query($q) or die(f_e($q));
$q=mysql_fetch_object($rs);
$r=mysql_fetch_object($rs);
@fwrite($h,"<?php
e_e();
// DATE: ".date("Y-m-d H:i:s",time())."
\$w_mailmode=".!$q->info.";
\$w_mailfoot=\"".addslashes($r->info)."\";
?>");
@fclose ($h);
}