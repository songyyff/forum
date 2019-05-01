<?php 
$_R=&$_REQUEST;
$_R['couserpass']=$_R['acouserpass'];
$_R['cousername']=$_R['acousername'];
include"../func/upmfunc.php";

function e($s){exit($s);}
if(!$uid=$_S['seuserid'])e("user not logined");
$vt=(int)$_R['type'];
if(!($sid=(int)$_R['id'])&&($vt<0||$vt>3))e("url request arguments error");
if(!($vt&1)){$a=split (",",$_R['id']);$sid=(int)$a[0];$id=(int)$a[1];}
$M=$_S['seismng'];

$f=&$_FILES['Filedata'];
if($i=$f['error'])include"t/upE.php";

include"r/er$vt.php";
if($i)e("no right upload");

$E=0;
$Q=substr;$ini=mb_ereg_search_init;
$ini($S,"[\r\n<\\\"]|([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");
$U=array("\r"=>"\\r","\n"=>"\\n",'"'=>"\\\"",'\\'=>"\\\\",'<'=>"&lt;");
function ckstr(&$s,&$S,$L){global$E,$U,$v_mgcc,$Q,$ini;if($v_mgcc)$s=stripslashes($s);if($s)for($S="",$P=0,$ini($s),@mb_ereg_search_setpos(0);$r=@mb_ereg_search_pos();){if($r[1]==1)if($h=&$U[$s[$p=$r[0]]]){$S.=$Q($s,$P,$p-$P).$h;$P=$p+1;}else$E=1;}$l=strlen($S.=$Q($s,$P));if(!$l||$l>$L)$E=1;}

ckstr($f['name'],$S,1000);
if($E)e("file name error");
$e=pathinfo($S);
$e=$e["extension"];

$q="select * from tdict use index(ki) where type=10 and ikey=\"$e\"";
$R=mysql_query($q) or die(f_e($q));
$z=mysql_fetch_object($R)->info;
mysql_free_result($R);
W($f['tmp_name']);
if(!$z)$z="application/unknow";
//if($z[1]=='/')include"t/".substr($z,2).".php";

$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->stmt_init();

$t=date("Y-m-d H:i:s");

if($rd=(int)$_R['rid']){
$R=mysql_query($q="select * from trsc where id=$rd and ".($vt<2?"i":"r")."id=".($vt&1?$sid:-$id)." and uid=$_S[seuserid]") or die(f_e($q));
if(!$r=mysql_fetch_object($R))e("replace file not exist");
@unlink(($fn=$uploaddir."$r->path/$rd.").$r->ext);
if(@move_uploaded_file($f['tmp_name'],$fn.$e)){
$stmt->prepare("update trsc set name=?,ext=?,type='$z',size=".(int)$f['size'].",time='$t' where id=$rd");
$stmt->bind_param('ss',$S,$e);
$stmt->execute();
if($vt==1&&$z!=$r->type){
$q="update titem set ".
(($w=substr($z,0,2)=="a/"?" adoi=adoi":$w=="v/"?"vdoi=vdoi":$w=="i/"?"pici=pici":"athi=athi")."+1,").
(($y=substr($r->info,0,2)=="a/"?" adoi=adoi":$y=="v/"?"vdoi=vdoi":$y=="i/"?"pici=pici":"athi=athi")."-1").
" where id=$r->iid";
mysql_query($q) or die(f_e($q));
}
e("$t.$z");
}e("move uploaded file failed");
}

$stmt->prepare("insert trsc(".($vt<2?"i":"r")."id,uid,path,name,ext,type,size,time)values(".($vt&1?$sid:-$id).",$uid,?,?,?,'$z',".(int)$f['size'].",'$t')");
$p=date("Y/W");
if(!file_exists($pp=$uploaddir.$p))@mkdir($pp,0777,true);
$stmt->bind_param('sss',$p,$S,$e);
$stmt->execute();
$d=$mysqli->insert_id;
if(!@move_uploaded_file($f['tmp_name'],"$pp/$d.$e")){
$q="delete from trsc where id=$d";
mysql_query($q) or die(f_e($q));
e("move uploaded file failed");
}
if($vt&1){
$q="update ".($vt<2?"titem":"trpl")." set adnu=adnu+1".
($vt<2?",".(($w=substr($z,0,2))=="a/"?" adoi=adoi":$w=="v/"?"vdoi=vdoi":$w=="i/"?"pici=pici":"athi=athi")."+1":"").
" where id=".($vt&1?$sid:-$id);
mysql_query($q) or die(f_e($q));
$q="update tuser set inte=inte+$pointperaddtional where id=$uid";
mysql_query($q) or die(f_e($q));
}
e("$t.$z.$d");

function W(&$n){global$e,$uid,$z;
$N=array("jpg"=>imagecreatefromjpeg,"jpeg"=>imagecreatefromjpeg,"png"=>imagecreatefrompng,"gif"=>imagecreatefromgif);
$D=array("jpg"=>imagejpeg,"jpeg"=>imagejpeg//,"png"=>imagepng,"gif"=>imagegif
);
if($x=$N[$E=strtolower($e)])
if($i=$x($n)){
if($x=$D[$E]){
imagecolorallocate($i,0,0,0);
$f="e/simsun.ttc";
$q="select u.name,d.info from tuser as u left join tdict as d on d.type=13 and d.ikey='name' where u.id=$uid";
$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
$s=html_entity_decode($r->name."「".$r->info."」");
$b=imagettfbbox(9,0,$f,$s);$w=$b[2]-$b[0];$h=$b[1]-$b[5];
$W=imagesx($i);$H=imagesy($i);
if($W>$w+20&&$H>5*$h){
$C=imagecolorallocatealpha($i,0,0,0,60);
imagettftext($i,9,0,$W-$w-5,$H-$h,$C,$f,$s);
$C=imagecolorallocatealpha($i,255,255,255,60);
imagettftext($i,9,0,$W-$w-6,$H-$h-1,$C,$f,$s);
$x($i,$n,97);}
}
imagedestroy($i);
}else$z=0;
}