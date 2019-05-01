

<div class=O>全文查询</div>
<table width=100% id=E cellspacing=0 cellpadding=10>
<tr><td style=border-top:0>
<FORM id=MF method=POST action=?type=1><?php

if(isset($_R['SER'])){

$E=0;
$Q=substr;$ini=mb_ereg_search_init;
$ini($S,"<|([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");

function ckstr(&$s,&$S,$L){global$E,$Q,$ini;$S="";for($P=0,$ini($s),@mb_ereg_search_setpos(0);$r=@mb_ereg_search_pos();){$n=$s[$p=$r[0]];if($r[1]==1&&ord($n)&0x80)$E=1;if($n=='<'){$S.=$Q($s,$P,$p-$P)."&lt;";$P=$p+1;}}$S.=$Q($s,$P);if(strlen($S)>$L)$E=1;}

ckstr($_R['SER'],$S,6000);$S=f_slquot($S);

}
echo"<input type=radio name=T value=0",($b=$_R['T'])?"":" checked",">帖子 <input type=radio name=T value=1",$b?" checked":"",">回复 查找 <input type=text name=SER value=\"",$E?"":f_rpspc($_R[SER]),"\" maxlength=1000> <input type=submit value='  搜索  '>";
?></FORM>

<?php if($E)echo"<hr>提交内容非法.";elseif(isset($_R['SER']))include"s/ser1.php";?>
</table>
<div class=O>全文查询</div>
