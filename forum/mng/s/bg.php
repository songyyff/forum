<?php e_e();
/*
bgs.php 提交代码
2011.3
*/

// 删除用户勋章 delete user bedge
if($n=count($_R[del])){
for($i=0;$i<$n;$i++){
$q="delete from bgs where uid=$uid and id=".(int)$_R[del][$i];
mysql_query($q) or die(f_e($q));
}

$q="select id,s from bgs where uid=$uid order by s";
$rs=mysql_query($q) or die(f_e($q));
for($i=1;$r=mysql_fetch_object($rs);$i++)if($r->s!=$i){$q="update bgs set s=$i where id=$r->id";mysql_query($q) or die(f_e($q));}
mysql_free_result($rs);
}


$I=$P=$p=$i=$E=0;
$Q=substr;$ini=mb_ereg_search_init;
$ini($S,"<|([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");

function ckstr(&$s,&$S,$L){global$E,$Q,$ini;$S="";for($E=$P=0,$ini($s),@mb_ereg_search_setpos(0);$r=@mb_ereg_search_pos();){$p=$r[0];if($r[1]==1&&ord($s[$p])&0x80)$E=1;if($s[$p]=='<'){$S.=$Q($s,$P,$p-$P)."&lt;";$P=$p+1;}}$S.=$Q($s,$P);if(strlen($S)>$L)$E=1;}

if($n=count($_R[altbg])||$N=count($_R[givebg])){

$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}

if($n){
$stmt=$mysqli->stmt_init();
$stmt->prepare("update bgs set q=?,r=r&253|? where uid=$uid and id=?");
$stmt->bind_param('sii',$S,$r,$m);
for($i=0;$i<$n;$i++){$r=$_R["dis".$m=(int)$_R[altbg][$i]]?2:0;
ckstr($_R[ucom][$i],$S,3000);
if(!$E)$stmt->execute();}
$stmt->close();
}

if($N){
$stmt=$mysqli->stmt_init();
$stmt->prepare("insert bgs(uid,mid,t,bg,n,s,q) select $uid,$mid,now(),bg,n,(select ifnull(max(s),0)+1 from bgs use index(us) where uid=$uid),? from bgs where uid=0 and s=?");
$stmt->bind_param('si',$S,$m);
for($i=0;$i<$N;$i++){$m=(int)$_R[givebg][$i];
ckstr($_R[scom][$i],$S,3000);
if(!$E)$stmt->execute();}
$stmt->close();
}

}

$q="update tuser set bgs=(select count(*) from bgs where uid=$uid) where id=$uid";
mysql_query($q) or die(f_e($q));