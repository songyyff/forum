<?php e_e();

$T=array("a>"=>1,"im"=>2);
$S="";$I=$A=$P=$E=0;
$set=mb_ereg_search_setpos;$Q=substr;$ini=mb_ereg_search_init;
$ini($S,"[\"<]|[\x0-\x1f\x7f]+|([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");

function RP(&$S,&$h,&$s,$l,$b){global$E,$P,$Q,$ini,$set;$ini($h);@$set(0);$S.=$Q($s,$P,$l)." $b=\"";for($Z=0;$r=@mb_ereg_search_pos();){$x=ord($c=$h[$m=$r[0]]);if($r[1]==1&&$x&0x80||$x<32||$x==127)$E=1;if($c=='"'){$S.=$Q($h,$Z,$m-$Z)."%22";$Z=$m+1;}}$S.=$Q($h,$Z).'"';$ini($s);}

function ckinfo(&$s,&$S){global$E,$P,$Q,$set,$ini,$I,$A,$T,$_R;
$S="";$P=0;$ini($s);@$set(0);
while($r=@mb_ereg_search_pos()){$c=ord($n=$s[$p=$r[0]]);if($r[1]==1&&$c&0x80)$E=1;
if($n=='<'){if(!$c=$T[$Q($s,($y=$s[++$p]!='/')?$p:++$p,2)])$E=1;
if($c==1){$p++;if($y){RP($S,$_R['As'][$A++],$s,$p-$P,"href");$P=$p;}
}else{if($s[$p+2]!='g'||!$y)$E=1;RP($S,$_R['Is'][$I++],$s,$p-$P+3,"src");$P=$p+=3;
if($s[$p]==' ')$E|=!($Q($s,$p,7)==" width="&&($n=stripos($s,' ',$p+=7))&&ctype_digit($Q($s,$p,$n-$p))&&$Q($s,$n,8)==" height="&&($p=stripos($s,'>',$n+=8))&&ctype_digit($Q($s,$n,$p-$n)));}
if($s[$p]!='>')$E=1;@$set($p);}}
$l=strlen($S.=$Q($s,$P));
if(!$l||$l>6000||$A+$I>50||$A!=count($_R['As'])||$I!=count($_R['Is']))$E=1;}

function ckstr(&$s,&$S,$L){global$E,$Q,$set,$ini;$S="";for($P=0,$ini($s),@$set(0);$r=@mb_ereg_search_pos();){$n=$s[$p=$r[0]];if($r[1]==1&&ord($n)&0x80)$E=1;if($n=='<'){$S.=$Q($s,$P,$p-$P)."&lt;";$P=$p+1;}}$l=strlen($S.=$Q($s,$P));if(!$l||$l>$L)$E=1;}

$NM=&$_R['receiver'];
$E|=strlen($NM)?($_R['isID']?!ctype_digit($NM):0):($_R['friends']?0:1);
if(strlen($NM)&&!$_R['isID'])ckstr($NM,$Nm,120);
ckinfo($_R['con'],$coN);
ckstr($_R['til'],$tlE,3000);
$E|=count($_R['friends'])>10;

if($v_mgcc){$h=stripslashes;$Nm=$h($Nm);$coN=$h($coN);$tlE=$h($tlE);}

if($E)$SRM.="提交内容有错误!";else include"msg.php";