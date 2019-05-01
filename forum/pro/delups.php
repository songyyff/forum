<?php
$_R=&$_REQUEST;
$_R['couserpass']=$_R['acouserpass'];
$_R['cousername']=$_R['acousername'];
include"../func/upmfunc.php";

function e($s){exit($s);}
//是否有权
if(!$uid=$_S['seuserid'])e("user not logined");
$vt=(int)$_R['type'];
if(!($sid=(int)$_R['id'])&&($vt<0||$vt>3))e("url request arguments error");
if(!($vt&1)){$a=split (",",$_R['id']);$sid=(int)$a[0];$id=(int)$a[1];}
$M=$_S['seismng'];

include"r/er$vt.php";
if($i)e("no right delete");

$s=&$_R['ids'];
for($i=0,$n=strlen($s);$s[$i]>'+'&&$s[$i]<':';$i++);
if($i<$n)e("url variable error");
$q="select id,path,ext".($vt&1?",substr(type,1,2) as t":"")." from trsc where ".($vt<2?"i":"r")."id=".($vt&1?$sid:-$id)." and uid=$uid and id in($s)";
$R=mysql_query($q) or die(f_e($q));
if(mysql_num_rows($R)){
$n=$na=$nv=$ni=$no=0;
while($r=mysql_fetch_object($R)){
@unlink("$uploaddir$r->path/$r->id.$r->ext");
$c.=",$r->id";
if($vt&1){$n++;if($vt==1){$t=$r->t;if($t=="i/")$ni++;elseif($t=="a/")$na++;elseif($t=="v/")$nv++;else$no++;}}
}
if($vt&1){
$q="update ".($vt==1?"titem set adoi=adoi-$na,vdoi=vdoi-$nv,pici=pici-$ni,athi=athi-$no,":"trpl set ")."adnu=adnu-$n where id=$sid";
mysql_query($q) or die(f_e($q));
}
$q="delete from trsc where id in(".substr($c,1).")";
mysql_query($q) or die(f_e($q));
}else e("delete none");