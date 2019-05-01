<?php e_e();

function f_rpspc_1($s){global $v_mgcc;return preg_replace(array("/&/","/</","/>/","/\"/","/\\\\/","/\r\n/","/\r/","/\n/"),array("&amp;","&lt;","&gt;","&quot;","&#092;","&#10;","&#10;","&#10;"),($v_mgcc?stripslashes($s):$s));}

function resort(){ //重排所有徽章顺序
$q="select id,s from bgs where uid=0 order by s";
$rs=mysql_query($q) or die(f_e($q));
for($i=1;$r=mysql_fetch_object($rs);$i++)if($r->s!=$i){$q="update bgs set s=$i where id=$r->id";mysql_query($q) or die(f_e($q));}
mysql_free_result($rs);
}

switch($T){
case 1: // 排序
if($_R[redata])resort();else{
$l=count($a=explode(" ,",$_R[resort]));$d=0;
$l-=$a[$l-1]?0:1;
for($i=1;$i<$l;$i++)if($i!=$c=(int)$a[$i]){$q="update bgs set s=-$i where uid=0 and s=$c";mysql_query($q) or die(f_e($q));$d=1;}
if($d){$q="update bgs set s=-s where uid=0 and s<0";mysql_query($q) or die(f_e($q));}
}
break;
case 2: // 修改说明
$q="update bgs set n=\"".f_rpspc_1($_R[bname])."\",q=\"".f_rpspc_1($_R[comm])."\",r=".(int)$_R[iradio]." where uid=0 and s=".(int)$_R[iconno];
mysql_query($q) or die(f_e($q));
break;
case 3: // 删除徽章 以"_"开头的徽章为用户添加徽章，可以删除，例如 _1.gif。否则是系统保留徽章，不能删除。
if(!preg_match("/[^\,\d]+/",$_R[delicons])){
$q="select * from bgs where uid=0 and s in($_R[delicons])";
$rs=mysql_query($q) or die(f_e($q));
$s="";
while($r=mysql_fetch_object($rs))if($r->bg[0]=='_'){$s.=",$r->s";@unlink("$_rootpath/icons/bg/$r->bg");@unlink("$_rootpath/icons/bg/b/$r->bg");}else $inf.="$r->s,";
mysql_free_result($rs);
if($s){$q="delete from bgs where uid=0 and s in(".substr($s,1).")";mysql_query($q) or die(f_e($q));resort();}
if($inf)$inf="编号为 $inf 的徽章是系统保留徽章，不能删除。";
}
break;
case 4: // 添加徽章
$fn=-1;
if(isset($_R[ifhr]))$fn=0;
else if($_FILES[iconf][error])$msg="文件上传错误，错误号 $_FILES[iconf][error] 。";
else{
$q="select key1 from tdict use index(typekey) where `type`=2";
$rs=mysql_query($q) or die(f_e($q));
$fx=mysql_fetch_object($rs)->key1;
mysql_free_result($rs);
$p="$_rootpath/icons/bg/";
do{$f=$p.($fn="_".base_convert(++$fx,10,36)).".gif";}while(!$h=@fopen($f,"x"));fclose($h);
$q="update tdict set key1=$fx where `type`=2 and key1<$fx";
mysql_query($q) or die(f_e($q));
if(!@move_uploaded_file($_FILES[iconf][tmp_name],$f)||!@move_uploaded_file($_FILES[iconb][tmp_name],$p."B/$fn.gif")){$fn=-1;$msg="上传文件写入错误！";}
}
if($fn!=-1){
$q="insert bgs(uid,s,bg,n,q,r)values(0,(select k+1 from(select max(s)as k from bgs where uid=0)as t),\"$fn\",\"".f_rpspc_1($_R[bname])."\",\"".f_rpspc_1($_R[comm])."\",".(int)$_R[ifhr].")";
mysql_query($q) or die(f_e($q));
}

}