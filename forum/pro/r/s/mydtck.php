<?php e_e();

function RP(&$S,&$h,&$s,$l,$b){global$E,$P,$Rs,$Q,$ini,$set;$ini($h);@$set(0);$Rs++;$S.=$Q($s,$P,$l)." $b=\"";for($Z=0;$r=@mb_ereg_search_pos();){$x=ord($c=$h[$m=$r[0]]);if($r[1]==1&&$x&0x80||$x<32||$x==127)$E=1;if($c=='"'){$S.=$Q($h,$Z,$m-$Z)."%22";$Z=$m+1;}}$S.=$Q($h,$Z).'"';$ini($s);}

$T=array("a>"=>1,"im"=>2);
$S="";$Rs=$I=$A=$E=0;
$set=mb_ereg_search_setpos;$Q=substr;$ini=mb_ereg_search_init;
$ini($S,"[\"<]|[\x0-\x1f\x7f]+|([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");

function ckinfo(&$s,&$S){global$E,$P,$Rs,$Q,$set,$ini,$I,$A,$T,$_R;
$S="";$Rs=$P=0;$ini($s);@$set(0);
while($r=@mb_ereg_search_pos()){
$c=ord($n=$s[$p=$r[0]]);
if($r[1]==1&&$c&0x80)$E=1;
if($n=='<'){if(!$c=@$T[$Q($s,($y=$s[++$p]!='/')?$p:++$p,2)])$E=1;
if($c==1){$p++;if($y){RP($S,$_R['As'][$A++],$s,$p-$P,"href");$P=$p;}
}else{if(!$y||$s[$p+2]!='g')$E=1;RP($S,$_R['Is'][$I++],$s,$p-$P+3,"src");$P=$p+=3;
if($s[$p]==' ')$E|=!($Q($s,$p,7)==" width="&&($n=strpos($s,' ',$p+=7))&&ctype_digit($Q($s,$p,$n-$p))&&$Q($s,$n,8)==" height="&&($p=strpos($s,'>',$n+=8))&&ctype_digit($Q($s,$n,$p-$n)));}
if($s[$p]!='>')$E=1;@$set($p);}}
$S.=$Q($s,$P);
if(strlen($S)>6000||$Rs>10)$E=1;}

function ckstr(&$s,&$S,$L){global$E,$Q,$set,$ini;$S="";for($P=0,$ini($s),@$set(0);$r=@mb_ereg_search_pos();){$c=$s[$p=$r[0]];if($r[1]==1&&ord($c)&0x80)$E=1;if($c=='<'){$S.=$Q($s,$P,$p-$P)."&lt;";$P=$p+1;}}$S.=$Q($s,$P);if(strlen($S)>$L)$E=1;}

if($_R['isaltermain']){$NM=$_R['username'];ckstr($NM,$Nm,120);$E|=!strlen($NM);}
ckinfo($_R['myS'],$iS);
ckinfo($_R['myI'],$iI);
if($A!=count($_R['As'])||$I!=count($_R['Is']))$E=1;
ckstr($_R['email'],$Em,600);
ckstr($_R['homepage'],$Hp,3000);
$D=ctype_digit;$B=&$_R['birthday'];
$nT=(int)$_R['newtime'];
$rZ=(int)$_R['replaysize'];
$iZ=(int)$_R['itemsize'];
$E|=!(($_R['phone']?$D($_R['phone']):1)&&($_R['QQ']?$D($_R['QQ']):1)&&$D($Q($B,0,4))&&$D($Q($B,5,2))&&$D($Q($B,9))&&$nT>1&&$nT<300&&$rZ>19&&$rZ<61&&$iZ>19&&$iZ<61);

if($v_mgcc){$h=stripslashes;$Nm=$h($Nm);$iS=$h($iS);$iI=$h($iI);$Em=$h($Em);$Hp=$h($Hp);}

if($E)$MSG.="提交内容有错误!";else include"$sub.php";