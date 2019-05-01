<?php
//宋云峰		2008-6-20
$v_pgstr="";
function f_getpagestr(&$cpage, //当前页
	$rowcount, //总行数
	$psize,	//页面尺寸
	$plen,	//显示页面连接数
	$urlvar,	//连接地址url
	$maxrow,	//最多数量
	$maxp,	//最大翻页数量
	$isser	//是否是搜索页面
	){
	global $v_pgstr;
	$maxpage=(int)($rowcount/$psize);
	if($rowcount>$maxpage*$psize)$maxpage++;
	if($cpage>$maxpage&&$maxpage)$cpage=$maxpage;
	$hpl=$plen/2;
	if($cpage>$maxp&&$maxp){$cpage=$maxp;$i=$maxp-$plen+1;$len=$maxp;}
	else if($maxpage>$plen){
	 	if($cpage>$hpl)
			if($maxpage-$cpage>=$hpl){$i=$cpage-$hpl;$len=$cpage+$hpl-1;}
			else{$i=$maxpage-$plen+1;$len=$maxpage;}
		else{$i=1;$len=$plen;}
	}else{$i=1;$len=$maxpage;}
	$v_pgstr="<td class=pdpage><table cellpadding=0 cellspacing=0 border=0><tr><td class=pdpagetb>";
	$v_pgstr.=$maxrow?"<font class=msgpagenum>$maxrow</font>":"";
	if($rowcount)$v_pgstr.="<font class=msgpagenum>".(($cpage-1)*$psize+1)."/".($cpage==$maxpage?$rowcount-($cpage-1)*$psize:$psize)."/$rowcount</font>";
	if($i>1) $v_pgstr.="<a class=msgpage href=\"".($isser?"javascript:jumptopage(1)":"$urlvar&page=1")."\">[1]</a>";
	for(;$i<=$len;$i++)$v_pgstr.=$i==$cpage?"<font class=visitedmsgpage>$i</font>":"<a class=msgpage href=\"".($isser?"javascript:jumptopage($i)":"$urlvar&page=$i")."\">$i</a>";
	if($maxpage>$len)$v_pgstr.="<a class=msgpage href=\"".($isser?"javascript:jumptopage($maxpage)":"$urlvar&page=$maxpage")."\">[$maxpage]</a>";
	$v_pgstr.=$maxp?"<font class=msgpagenum>$maxp</font>":"";
	$v_pgstr.="</td><td class=pdpgintd><input class=injppage type=".($maxpage>$plen+1?"text":"hidden")." name=injppg onkeydown=\"jumppage(this,event)\">&nbsp;</td></tr></table></td>";
	echo "\n<script language=javascript>\nfunction jumppage(t,e){if(e.keyCode==13)if(".($isser?$isser:0).">0)jumptopage(t.value);else document.location.href=\"$urlvar&page=\"+t.value;}\n";
	if(isser) echo "function jumptopage(v){var m=G('mainform');m.action=\"$urlvar&isserpage=1&page=\"+v;if(iscansubmit())m.submit();}\n";
	echo "</script>\n";
}
?>
<script language="JavaScript">
function S(v){return document.styleSheets.item(0).rules[v].style;}
if(window.navigator.userAgent.search("Firefox")<0){i=0;while(i<6)S(i++).paddingBottom="0px";S(i).paddingTop="1px";}
</script>
