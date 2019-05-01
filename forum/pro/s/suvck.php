<?php e_e();
$E=0;
$Q=substr;$ini=mb_ereg_search_init;
$ini($S,"[\r\n<\\\"]|([\xc0-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xf7][\x80-\xbf]{3})+|[\x80-\xff]");
$U=array("\r"=>"\\r","\n"=>"\\n",'"'=>"\\\"",'\\'=>"\\\\",'<'=>"&lt;");
function ckstr(&$s,&$S,$L){global$E,$U,$v_mgcc,$Q,$ini;if($v_mgcc)$s=stripslashes($s);$S="";if($s)for($P=0,$ini($s),@mb_ereg_search_setpos(0);$r=@mb_ereg_search_pos();){if($r[1]==1)if($h=&$U[$s[$p=$r[0]]]){$S.=$Q($s,$P,$p-$P).$h;$P=$p+1;}else$E=1;}$l=strlen($S.=$Q($s,$P));if(!$l||$l>$L)$E=1;}
?>