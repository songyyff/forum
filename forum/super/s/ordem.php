<?php

e_e();

function resort(){ //重排所有表情顺序
global $mt;
$q="select id,key2 from tdict where type=16 and key1=$mt order by key2";
$R=mysql_query($q) or die(f_e($q));
for($i=1;$r=mysql_fetch_object($R);$i++)if($r->key2!=$i){$q="update tdict set key2=$i where id=$r->id";mysql_query($q) or die(f_e($q));}
mysql_free_result($R);
}

switch($T){
case 1: // 排序
if($_REQUEST[redata])resort();else{
$l=count($a=explode(" ,",$_REQUEST[resort]));$d=0;
$l-=$a[$l-1]?0:1;
for($i=1;$i<$l;$i++)if($i!=$c=(int)$a[$i]){$q="update tdict set key2=-$i where type=16 and key1=$mt and key2=$c";mysql_query($q) or die(f_e($q));$d=1;}
if($d){$q="update tdict set key2=-key2 where type=16 and key1=$mt and key2<0";mysql_query($q) or die(f_e($q));}
}
break;
case 2: // 修改说明
$q="update tdict set info2=\"".f_rpspc($_REQUEST[comm])."\" where type=16 and key1=$mt and key2=".(int)$_REQUEST[iconno];
mysql_query($q) or die(f_e($q));
break;
case 3: // 删除表情 以"_"开头的表情为用户添加表情，可以删除，例如 _1.gif。否则是系统保留表情，不能删除。
if(!preg_match("/[^\,\d]+/",$_REQUEST[delicons])){
$q="select * from tdict where type=16 and key1=$mt and key2 in($_REQUEST[delicons])";
$R=mysql_query($q) or die(f_e($q));
$s="";
while($r=mysql_fetch_object($R))if($r->info[0]=='_'){$s.=",$r->key2";@unlink("$_rootpath/icons/em/$mt/$r->info");}else $inf.="$r->key2,";
mysql_free_result($R);
if($s){$q="delete from tdict where type=16 and key1=$mt and key2 in(".substr($s,1).")";mysql_query($q) or die(f_e($q));resort();}
if($inf)$inf="编号为 $inf 的表情是系统保留表情，不能删除。";
}
break;
case 4: // 添加表情
if($_FILES[iconf][error])$msg="文件上传错误，错误号 $_FILES[iconf][error] 。";
else{
$q="select * from tdict where type=3 and key1=$mt";
$R=mysql_query($q) or die(f_e($q));
$fx=mysql_fetch_object($R)->info2;
mysql_free_result($R);
do{$f="$_rootpath/icons/em/$mt/_".($fn=base_convert(++$fx,10,36).".gif");}while(!$h=@fopen($f,"x"));fclose($h);
$q="update tdict set info2=$fx where type=3 and key1=$mt and info2<$fx";
mysql_query($q) or die(f_e($q));
if(@move_uploaded_file($_FILES[iconf][tmp_name],$f)){
$q="insert tdict(type,key1,key2,info,info2)values(16,$mt,(select ifnull(k,0)+1 from(select max(key2)as k from tdict where type=16 and key1=$mt)as t),\"_$fn\",\"".f_rpspc($_REQUEST[comm])."\")";
mysql_query($q) or die(f_e($q));
}else $msg="上传文件写入错误！";
}
} // switch end


// 重写 /w/pf.js 表情数据文件

include"wem.php";


?>