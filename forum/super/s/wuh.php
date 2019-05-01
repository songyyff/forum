<?php e_e();

// 重写 /w/uh.js 系统用户头像数据文件

$f="$_rootpath/w/uh.js";
@unlink($f);
if($h=@fopen($f,"w")){
@fwrite ($h, "// 用户头像源数据文件 " . date("Y-m-d H:i:s",time()) . "
var uheads=[");
$q="select * from tdict where type=1 order by key1 asc;";
$rs=mysql_query($q) or die(f_e($q));
$lw=7; //行宽
$pl=2; //每页的行数
$c=mysql_num_rows($rs);
while($r=mysql_fetch_object($rs))@fwrite($h,"[\"".substr($r->info,4)."\",\"$r->info2\"],");
mysql_free_result($rs);
@fwrite($h,"$lw,$pl]");	//行宽,每页的行数
@fclose($h);
}