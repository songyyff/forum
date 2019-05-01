<?php

e_e();

function f_rpspc_1($s){global $v_mgcc;return preg_replace(array("/&/","/</","/>/","/\"/","/\\\\/","/\r\n/","/\r/","/\n/"),array("&amp;","&lt;","&gt;","&quot;","&#092;","&#10;","&#10;","&#10;"),($v_mgcc?stripslashes($s):$s));}

function resort(){ //重排所有类别顺序
$q="select id,key2 from tdict where type=3 order by key2";
$rs=mysql_query($q) or die(f_e($q));
for($i=1;$r=mysql_fetch_object($rs);$i++)if($r->key2!=$i){$q="update tdict set key2=$i where id=$r->id";mysql_query($q) or die(f_e($q));}
mysql_free_result($rs);
}

switch($T){
case 1: // 排序
if($_REQUEST[redata])resort();else{
$l=count($a=explode(" ,",$_REQUEST[resort]));$d=0;
$l-=$a[$l-1]?0:1;
for($i=1;$i<$l;$i++)if($i!=$c=(int)$a[$i]){$q="update tdict set key2=-$i where type=3 and key2=$c";mysql_query($q) or die(f_e($q));$d=1;}
if($d){$q="update tdict set key2=-key2 where type=3 and key2<0";mysql_query($q) or die(f_e($q));}
}
break;
case 2: // 修改名称
$q="update tdict set info=\"".f_rpspc_1($_REQUEST[tname])."\" where type=3 and key2=".(int)$_REQUEST[tno];
mysql_query($q) or die(f_e($q));
break;
case 3: // 删除类别
if(!preg_match("/[^\,\d]+/",$_REQUEST[delts])){
$q="select *,(select count(*) from tdict where type=16 and key1=t.key1) as c from tdict as t use index(k2) where type=3 and key2 in($_REQUEST[delts])";
$rs=mysql_query($q) or die(f_e($q));
$s="";
while($r=mysql_fetch_object($rs))if($r->c==0){$s.=",$r->key2";@unlink("$_rootpath/icons/em/$r->key2/*");@rmdir("$_rootpath/icons/em/$r->key2");}else $inf.="$r->key2,";
mysql_free_result($rs);
if($s){$q="delete from tdict where type=3 and key2 in(".substr($s,1).")";mysql_query($q) or die(f_e($q));resort();}
if($inf)$inf="编号为 $inf 的类别下还有表情，不能删除。";
}
break;
case 4: // 添加类别
$q="select key1 from tdict where type=3 and not(select max(key1)!=count(*) from tdict where type=3) order by key1";
$R=mysql_query($q) or die(f_e($q));
for($k=1,$i=0;$r=mysql_fetch_object($R);$i++)if($i!=$r->key1){$k=0;break;}
mysql_free_result($R);

$q="insert tdict(type,key1,key2,info,info2)values(3,".($k?"(select k+1 from(select max(key1)as k from tdict where type=3)as t)":$i).",(select k+1 from(select max(key2)as k from tdict where type=3)as t),\"".f_rpspc_1($_REQUEST[tname])."\",0)";
mysql_query($q) or die(f_e($q));

if($k){
$q="select max(key1) as m from tdict where type=3";
$R=mysql_query($q) or die(f_e($q));
$i=mysql_fetch_object($R)->m;
mysql_free_result($R);
}
@mkdir("$_rootpath/icons/em/$i",0777);
}

?>