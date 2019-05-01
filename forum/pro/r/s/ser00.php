<?php

e_e();

if($RM!="")echo "<div class=bp5><tt class=warningc><b>查询错误!</b></tt><br>$RM</div>";
else{
echo "<div id=X><tt class=fr>用时 ",substr($endtime-$starttime,0,8)," 秒</tt>查出 $len ",$T?"条回复":"个帖子","</div>";

if($len){

echo "<table width=100% id=E style=table-layout:fixed cellpadding=5 cellspacing=0><tr><TD>发表时间 ID.标题 ",$T?"&#123;附件数&#125; [回复人] .所属帖子 ":"","[阅读权限](回复/访问数)&#123;附件数&#125; [发贴人] .所属论坛(帖子数量)";

$G=0;

for($i=0;$r=mysql_fetch_object($R);){

$ad=$T?$r->radnu:$r->adnu;

echo "<tr",$i++&1?"":" class=tr","><TD><i class=fr>$i#</i>$r->ctime ",$T?$r->rid:$r->id;

if(
$r->gs=='E'&&$r->stat=='E'&&($T?$r->rs=='E':1)
&&(int)$r->level<=($uid?$ur->level:1)
&&$right_saved['userview']&$r->gr
&&($uid?$right_saved['userview']&$ur->rigt:$right_saved['guestview']&$r->gr)
){

if(

$right_saved['userstop']&$r->rur
&&$right_saved['userview']&$r->rr&&$right_saved['usershow']&$r->rr&&$right_saved['supershow']&$r->rr
&&$right_saved['userview']&$r->rigt
&&($uid?$r->rdnum<=$ur->rdnum||$uid==$r->uid:!$r->rdnum)
&&($uid?1:$right_saved['guestview']&$r->rr&$r->rigt)

){

echo" .<a class=itemlink href=view.php?noteid=$r->id&page=",ceil($r->pos/$Z=$_SESSION['serpsize']),"#site",$r->pos%$Z," target=_blank>",str_replace("<","&lt;",substr($r->rcon,0,100)),"   </a>",
$r->radnu?" &#123;$r->radnu&#125;":"",
" <font class=darkfont>[<a href=userinfo.php?userid=$r->ruid>$r->run</a>]</font>";

}elseif($T)echo" .<del>无权查看</del>",$r->radnu?"&#123;$r->radnu&#125;":"";

if($x=$G!=$r->id){

$G=$r->id;

echo" .<a class=itemlink href=view.php?noteid=$r->id>$r->title</a> ",
$r->rdnum?"[$r->rdnum]":"",
"($r->rnum/$r->vnum)",
$r->adnu?"&#123;$r->adnu&#125;":"",
" [<a href=userinfo.php?userid=$r->uid>$r->un</a>]";

}else echo" .同贴
";

if($x)if($O!=$r->gid){
$O=$r->gid;
echo" .<a href=list.php?groupid=$r->gid>$r->gn</a> ($r->ginu)
";
}else echo" .同坛
";

}else echo" .<del>无权查看</del>",$ad?" &#123;$ad&#125;":"";

}
echo"</table>";

mysql_free_result($R);

}else echo"<div class=d0>--- 没有记录 ---</div>";
}

?>