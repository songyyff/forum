<?php

e_e();

function &SL(&$s){global $v_mgcc;return $v_mgcc?stripslashes($s):$s;}
function &f_rpspc_1($s){return preg_replace(array("/&/","/</","/>/","/\"/","/\\\\/","/\r\n/","/\r/","/\n/"),array("&amp;","&lt;","&gt;","&quot;","&#092;","&#10;","&#10;","&#10;"),SL($s));}
function &rpd(&$s){return preg_replace(array(),array(),SL(strtoupper ($s)));}

function resort(){ //重排所有类别顺序
$q="select id,key1 from tdict where type=17 order by key1";
$rs=mysql_query($q) or die(f_e($q));
for($i=1;$r=mysql_fetch_object($rs);$i++)if($r->key2!=$i){$q="update tdict set key1=$i where id=$r->id";mysql_query($q) or die(f_e($q));}
mysql_free_result($rs);
}

switch($T){
case 1: // 排序
if($_REQUEST[redata])resort();else{
$l=count($a=explode(" ,",$_REQUEST[resort]));$d=0;
$l-=$a[$l-1]?0:1;
for($i=1;$i<$l;$i++)if($i!=$c=(int)$a[$i]){$q="update tdict set key1=-$i where type=17 and key1=$c";mysql_query($q) or die(f_e($q));$d=1;}
if($d){$q="update tdict set key1=-key1 where type=17 and key1<0";mysql_query($q) or die(f_e($q));}
}
break;
case 2: // 修改名称
$q="select * from tdict where type=17 and info2=\"".($D=rpd($_REQUEST[tadd]))."\"";
$R=mysql_query($q) or die(f_e($q));
if($r=mysql_fetch_object($R)){$msg="识别地址与 [ $r->info ] 重复,修改失败！";break;}
$q="update tdict set info=\"".f_rpspc_1($_REQUEST[tname])."\",info2=\"$D\" where type=17 and key1=".(int)$_REQUEST[tno];
mysql_query($q) or die(f_e($q));
break;
case 3: // 删除类别
if(!preg_match("/[^\,\d]+/",$_REQUEST[delts])){
$q="delete from tdict where type=17 and key1 in($_REQUEST[delts])";
$rs=mysql_query($q) or die(f_e($q));
resort();
}
break;
case 4: // 添加类别
$q="select * from tdict where type=17 and info2=\"".($D=rpd($_REQUEST[tadd]))."\"";
$R=mysql_query($q) or die(f_e($q));
if($r=mysql_fetch_object($R)){$msg="识别地址与 [ $r->info ] 重复,添加失败！";break;}
mysql_free_result($R);
$q="insert tdict(type,key1,info,info2)values(17,(select k+1 from(select max(key1)as k from tdict where type=17)as t),\"".f_rpspc_1($_REQUEST[tname])."\",\"$D\")";
mysql_query($q) or die(f_e($q));
}

// 重写 /w/av.js 支持视频网数据文件
include"wmedia.php";

?>