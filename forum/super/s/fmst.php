<?php

/*
forums.php
写入 /w/gt.js ut.js 查询论坛数结构数据文件
*/

e_e();

function E($id){
global $hg,$hu,$ig,$iu;
$q="select id,pid,sfnu,name,level,stat,rigt from tgup where pid=$id order by sort asc";
$R=mysql_query($q) or die(f_e($q));

while($r=mysql_fetch_object($R)){
$a=$b=0;
if($r->stat=='E'&&$r->level==1){
@fwrite($hg,"$r->pid,$r->id,\"$r->name\",
");
$ig++;
$a=1;
}

if($r->stat=='E'){
@fwrite($hu,"$r->pid,$r->sort,$r->id,\"$r->name\",$r->level,
");
$iu++;
$b=1;
}

if($a||$b){
$q="update tgup set ".($a?"gps=$ig":"").($a&$b?",":"").($b?"ups=$iu":"")." where id=$r->id";
mysql_query($q) or die(f_e($q));
}

if($r->sfnu)E($r->id);

}
mysql_free_result($R);
}

$G="$_rootpath/w/gt.js";
$U="$_rootpath/w/ut.js";
@unlink($G);
@unlink($U);

$MWF="写入查询论坛数结构数据文件错误！";
if(($hg=@fopen($G,"w"))&&($hu=@fopen($U,"w"))){
fwrite($hg,"
/*
游客查询论坛数结构数据文件 ".date("Y-m-d H:i:s",time())."
*/

forums=[");
fwrite($hu,"
/*
用户查询论坛数结构数据文件 ".date("Y-m-d H:i:s",time())."
*/

forums=[");

$q="update tgup set gps=0,ups=0";
mysql_query($q) or die(f_e($q));
$ig=0;
$iu=0;
E(0);

@fwrite($hg,"0]");
@fclose($hg);
@fwrite($hu,"0]");
@fclose($hu);

$q="update tdict set info2=0 where type=15 and key1=0";
mysql_query($q) or die(f_e($q));

$MWF="写入查询论坛数结构数据文件成功！";

}

?>