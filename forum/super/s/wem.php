<?php

e_e();

// 重写 /w/pf.js 表情数据文件


$f="$_rootpath/w/pf.js";
@unlink($f);
if($h=@fopen($f,"w")){
@fwrite ($h, "// 表情源数据文件 " . date("Y-m-d H:i:s",time()) . "
var emfacs=[
");
$q="select * from tdict where type=3 order by key2 asc;";
$R=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($R)){
@fwrite($h,"[$r->key1,\"$r->info\"],
[");

$q="select * from tdict where type=16 and key1=$r->key1 order by key2";
$C=mysql_query($q) or die(f_e($q));
while($c=mysql_fetch_object($C)){
@fwrite($h,"[\"".substr($c->info,0,-4)."\",\"$c->info2\"],");
}
mysql_free_result($C);
@fwrite($h,"0],
");
}
mysql_free_result($R);
@fwrite($h,"0]");

@fclose($h);
}
