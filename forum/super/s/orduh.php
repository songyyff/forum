<?php
/*

userheads.php 提交代码

*/

e_e();

function resort(){ //重排所有头像顺序
$q="select id,key1 from tdict where type=1 order by key1";
$rs=mysql_query($q) or die(f_e($q));
for($i=1;$r=mysql_fetch_object($rs);$i++)if($r->key1!=$i){$q="update tdict set key1=$i where id=$r->id";mysql_query($q) or die(f_e($q));}
mysql_free_result($rs);
}

switch($T){
case 1: // 排序
if($_REQUEST[redata])resort();else{
$l=count($a=explode(" ,","$_REQUEST[resort]"));$d=0;
$l-=$a[$l-1]?0:1;
for($i=1;$i<$l;$i++)if($i!=$c=(int)$a[$i]){$q="update tdict set key1=-$i where type=1 and key1=$c";mysql_query($q) or die(f_e($q));$d=1;}
if($d){$q="update tdict set key1=-key1 where type=1 and key1<0";mysql_query($q) or die(f_e($q));}
}
break;
case 2: // 修改说明
$q="update tdict set info2=\"".f_rpspc($_REQUEST[comm])."\" where type=1 and key1=".(int)$_REQUEST[iconno];
mysql_query($q) or die(f_e($q));
break;
case 3: // 删除头像 以"_"开头的表情为用户添加头像，可以删除，例如 _1.gif。否则是系统保留头像，不能删除。
if(!preg_match("/[^\,\d]+/",$_REQUEST[delicons])){
$q="select * from tdict where type=1 and key1 in($_REQUEST[delicons])";
$rs=mysql_query($q) or die(f_e($q));
$s="";
while($r=mysql_fetch_object($rs))if($r->info[4]=='_'){$s.=",$r->key1";@unlink("$_rootpath/faces/$r->info");}else $inf.="$r->key1,";
mysql_free_result($rs);
if($s){$q="delete from tdict where type=1 and key1 in(".substr($s,1).")";mysql_query($q) or die(f_e($q));resort();}
if($inf)$inf="编号为 $inf 的头像是系统保留头像，不能删除。";
}
break;
case 4: // 添加表情
if($_FILES[iconf][error])$msg="文件上传错误，错误号 $_FILES[iconf][error] 。";
else{
$q="select * from tdict where type=0 and key1=1";
$rs=mysql_query($q) or die(f_e($q));
$fx=mysql_fetch_object($rs)->info2;
mysql_free_result($rs);
do{$f="$_rootpath/faces/sys/_".($fn=base_convert(++$fx,10,36).".gif");}while(!$h=@fopen($f,"x"));fclose($h);
$q="update tdict set info2=$fx where type=0 and key1=1 and info2<$fx";
mysql_query($q) or die(f_e($q));
if(@move_uploaded_file($_FILES[iconf][tmp_name],$f)){
$q="insert tdict(type,key1,info,info2)values(1,(select k+1 from(select max(key1)as k from tdict where type=1)as t),\"sys/_$fn\",\"".f_rpspc($_REQUEST[comm])."\")";
mysql_query($q) or die(f_e($q));
}else $msg="上传文件写入错误！";
}
} // switch end

// 重写 /w/uh.js 系统用户头像数据文件
include"wuh.php";