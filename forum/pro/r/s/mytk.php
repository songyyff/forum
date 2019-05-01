<?php e_e();

if($l=count($_R['del'])){
for($s="",$i=0;$i<$l;$i++)$s.=($i?",":"")."\"".(int)$_R['del'][$i]."\"";
$q="delete from tsubs where uid=$ur->id and iid in($s);";
mysql_query($q) or die(f_e($q));
$q="select count(*) as c from tsubs where uid=$ur->id";
$R=mysql_query($q) or die(f_e($q));
$r=mysql_fetch_object($R);
mysql_free_result($R);
$q="update tuser set sbnu=$r->c where id=$ur->id";
mysql_query($q) or die(f_e($q));
$ur->sbnu=$r->c;
}

$E=0;
$Q=substr;$ini=mb_ereg_search_init;
$ini($S,"<|([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");

function ckstr(&$s,&$S,$L){global$E,$Q,$ini;$S="";for($E=$P=0,$ini($s),@mb_ereg_search_setpos(0);$r=@mb_ereg_search_pos();){$c=ord($n=$s[$p=$r[0]]);if($r[1]==1&&$c&0x80)$E=1;if($n=='<'){$S.=$Q($s,$P,$p-$P)."&lt;";$P=$p+1;}}$S.=$Q($s,$P);if(strlen($S)>$L)$E=1;}

$mysqli = new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}

$stmt = $mysqli->prepare("update tsubs set comm=? where uid=$ur->id and iid=?");

if($l=count($_R[com]))for($i=0;$i<$l;$i++)if($s=&$_R[comm][$i]){ckstr($s,$S,3000);$S=f_delsla($S);if(!$E&&ctype_digit($I=&$_R[com][$i])){$stmt->bind_param('ss',$S,$I);$stmt->execute();}}