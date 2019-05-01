<?php e_e();

$AA=array(array('<'=>"&lt;",'&'=>"&#38;"),array('"'=>'%22'),0,array(//'<'=>"%3C",
'\\'=>"\\\\",'"'=>'\\"'));
$AA[2]=&$AA[1];
$B=array_combine(split(',',"size,face,lign,tyle,olor,idth,ight"),array(1,1,1,2,1,1,1));
$F=array("I"=>"宋体","H"=>"黑体","K"=>"楷体","D"=>'"Times New Roman"',"E"=>"background-color:");
$T=array_combine(split(',',"i>,u>,b>,s>,hr,p ,di,h1,h2,h3,h4,h5,h6,p>,a>,im,co,fo"),array(1,1,1,1,2,2,2,2,2,2,2,2,2,1,4,3,5,2));
$U=$H=$G=$S="";$L=$l=$In=$W=$I=$A=$P=$p=$E=0;
$set=mb_ereg_search_setpos;$Q=substr;$ini=mb_ereg_search_init;

function RP($w,&$h,$b,$e){global$E,$L,$Q,$ini,$set,$s,$S,$H,$AA,$G,$U,$P,$p,$c;
if($w<3){$S.=$Q($s,$P,$p-$P+($w?$c:0));$P=$p+$c;}
if($w){if(strtolower($Q($h,($x=$w==3)?2:0,11))=="../uploads/")
if(ctype_digit($Y=$Q($h,$x=$x?13:11,(($X=strpos($h,".",$x))?$X:strlen($h))-$x)))$G.=",$Y";else$E=1;}
if($w==3)$I=&$H;else$I=&$S;
$R=&$AA[$w];$ini($h);@$set(0);$I.=$b;
for($Z=$w==3;$r=@mb_ereg_search_pos();){$x=ord($n=$h[$m=$r[0]]);if($r[1]==1&&$x&0x80||$w&&($x<32||$x==127))$E=1;if($R[$n]){if(!$w&&$n=='<'&&strtolower($Q($h,$m+1,2))!="/t")continue;$I.=$Q($h,$Z,$m-$Z).$R[$n];$Z=$m+1;}}
$I.=$Q($h,$Z).$e;$ini($s);}

$ini($s=&$_R['con'],"[\"&'<=>oO]|[\x0-\x1f\x7f]|([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");
while($r=@mb_ereg_search_pos()){$c=ord($n=$s[$p=$r[0]]);if($r[1]==1&&$c&0x80)$E=1;
if($In){
if($n=='>'){$In=0;if($p-$b>50)$E=1;}
elseif($n=='='){if(!($y=$B[$Q($s,$p-4,4)])||$y==2&&!ctype_xdigit($Q($s,$p+3,6))&&$s[$p+9]!='>')$E=1;
if($c=&$F[$s[++$p]]){$S.=$Q($s,$P,$p-$P).$c;@$set($P=++$p);}}
elseif($c&0x80||$c<32||$n=='<'||$n=='"'||$n=="'"||$c==127||($n=='O'||$n=='o')&&(($c=$s[$p+1])=='N'||$c=='n'))$E=1;
}elseif($s[$p]=='<'){$In=1;$b=$p;
if(!$c=$T[$Q($s,($y=$s[++$p]!='/')?$p:++$p,2)])$E=1;
if($c==3){if($s[$p+2]!='g'||!$y)$E=1;RP(2,$_R['Is'][$I++],' src="','"');
}elseif($c==4){$c=1;if($y){$a=&$_R['As'][$A++];if($a[0]==':')RP(3,f_delsla($a),',"','"');else RP(1,$a,' href="','"');}
}elseif($c==5){$In=0;if($Q($s,$p-1,6)!="<code>")$E=1;RP(0,$_R['code'][$W++],"textarea>","</textarea>");$c--;}
@$set($p+$c);}}
$S.=$Q($s,$P);
$L=strlen($S)+strlen($H);
if($In||$I+$A>100||$W>100||$I!=count($_R['Is'])||$A!=count($_R['As'])||$W!=count($_R['code']))$E=1;

$l=1;
if($vtype<2){$ini($s=&$_R['til']);@$set(0);
for($P=0,$T="";$r=@mb_ereg_search_pos();){$c=ord($x=$s[$p=$r[0]]);if($r[1]==1&&$c&0x80)$E=1;if($x=='<'){$T.=$Q($s,$P,$p-$P)."&lt;";$P=$p+1;}}
$T.=$Q($s,$P);
$l=strlen($T);}

for($i=0,$C=&$_R['Icode'];$c=$C[$i];$i++)if($c>'~'||$c<'#'||$c=='\\')$E=1;

if(!$l||$l>1000||!$L||$L>600000||$W!=$i)$E=1;

if($v_mgcc){$h=stripslashes;if($vtype<2)$T=$h($T);$S=$h($S);}