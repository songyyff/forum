<?php e_e();

$pbid=isset($_R['boxid'])?(int)$_R['boxid']:2;
$iss1=!(!$pbid&&!isset($_R['stype']));
$stt=f_mtime();
$msgs="";
if((isset($_R['comms'])||isset($_R['mscomms'])||isset($_R['mngs']))&&!isset($_R['isserpage']))include "i/nsub.php";
if(!$pbid){
	if(isset($_R['stype']))include"i/iiss.php";
}else{
$q="select t1.num,t1.box,t1.ctime as mctime,t1.ltime as mltime,t1.comm,
t2.*,
t3.name as uname,
t4.name as gname,t4.inum as ginum,
t5.name as mname,
(select GROUP_CONCAT(m.ltime,\" <a href=../pro/userinfo.php?userid=\",uid,\">\",u.name,\"</a>:\\\n\",m.comm SEPARATOR \"\\\n\")
from tmng as m use index(tn) left join tuser as u on m.uid=u.id where m.type=9 and m.box=0 and m.num=t1.num group by m.type) as mc 
from tmng as t1 force index(ind)
left join titem as t2 force index(primary) on t2.id=t1.num 
left join tuser as t3 force index(primary) on t3.id=t2.uid
left join tuser as t5 force index(primary) on t5.id=t2.lmng
left join tgup as t4 force index(primary) on t4.id=t2.gid
where t1.uid=$_S[seuserid] and t1.type=0".($pbid>1?" and t1.box=$pbid":"")." order by t1.ctime desc limit ".($cpage-1)*$ps.",".$ps;
}

if($iss1){
	$serrs=mysql_query($q) or die(f_e($q));
	$edt=f_mtime();
	$lens=mysql_num_rows($serrs);
}
function f_mtime(){list($u,$s)=explode(" ",microtime()); return ((float)$u+(float)$s);}

$q="select * from tmng force index(ind) where uid=$uid and type=5 order by num asc";
$r1=mysql_query($q) or die(f_e($q));
if($l1=mysql_num_rows($r1))for($i=0;$i<$l1;$i++){
		$row=mysql_fetch_object($r1);
		$boxsel.="<option value=$row->num".($row->num==$pbid?" $d":"").">$row->comm ($row->box)</option>";
		if($row->num==$pbid) $rowcnt=$row->box;
		if(!$pbid)$boxs.=($i?",":"").$row->num.",".$row->box.",\"".$row->comm."\"";
		$cn+=$row->box;
}
mysql_free_result($r1);
$boxsel.="<option value=1".($pbid==1?$d:"").">所有帖子 ($cn)</option>";
$boxsel.="<option value=0".($pbid?"":$d).">搜索</option>";
include "../func/pgnum.php";
f_getpagestr($cpage,$pbid?($pbid>1?$rowcnt:$cn):($iss1?($lens<$ps?($cpage-1)*$ps+($lens?$lens:1):($cpage+3)*$ps):0),$ps,10,"?type=$vartype&boxid=$pbid",0,0,isset($_R['stype']));
?>
<form id=mainform enctype="multipart/form-data" method="POST" action="?type=<?php echo "$vartype&page=$cpage"; ?>" onsubmit="return submitform()">
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;帖子管理</td>
<td class="pdtb1p"><select id=glist name=boxid onchange="changebox(this.value)">
<?php echo $boxsel; ?>
</select></td>
<td width="100" align=right><input type=submit value=" 提交 ">&nbsp;</td>
</tr>
</table>
<?php
if(!$pbid)include "i/iis.php";
if($iss1)echo "<table width=100% class=bdb1 border=1 cellpadding=0 cellspacing=0><tr height=23 class=darkbar><TD width=120>&nbsp;翻页</td>$v_pgstr<td width=150 align=right>查询用时 ".substr($edt-$stt,0,8)." 秒&nbsp;</td></tr></table>\n";
if($msgs)echo "<table width=100% border=1 cellpadding=0 cellspacing=0><tr height=23 class=darkbar><TD width=120>&nbsp;提交结果</td><td>共有 [ ".count($_R['mngs'])." ] 个修改提交</td><td width=100 align=right><a id=expmsg class=goldlink href=\"javascript:expmsg()\">[-]</a>&nbsp;</td></tr></table>\n".
"<div id=rsmsg class=msgdiv><table width=100% class=bd1 border=1 cellpadding=0 cellspacing=0><tr><td class=pd1>$msgs<br>&nbsp;</td></tr></table></div>";
if($lens){
	$rds0=$right_saved['guestview'];
	$rds1=$right_saved['userview'];
	$rds2=$right_saved['usershow'];
	$rds3=$right_saved['usermodify'];
	$rds4=$right_saved['userrpy'];
	$rds5=$right_saved['supershow'];
	$rds6=$right_saved['superrpy'];
	echo "<table width=100% class=bdb1 border=1 cellpadding=0 cellspacing=0><tr height=23 class=darkbar><TD width=120>&nbsp;加入时间</td><td>编号.标题 发表时间 [阅读权限] (访问/回复数) {附件数} [用户]<td width=172>论坛 贴数<td width=60 align=right><a id=eprs class=goldlink href=\"javascript:exprows()\">[+]</a>&nbsp;</table>\n";
	$irows=Array();
	for($i=0;$i<$lens;$i++){
		$row=mysql_fetch_object($serrs);
		echo "<table width=100%  border=1 cellpadding=0 cellspacing=0>".
			"<tr height=23 class=darkbar><TD width=120>&nbsp;".f_date($row->mctime)."</td><td class=pdtb1p>".
			"$row->num.<a class=goldlink href=\"../pro/view.php?noteid=$row->num\" target=i$row->num>$row->title</a> $row->ctime".
			($row->rdnum?" [$row->rdnum]":"")." ($row->vnum/$row->rnum)".
			($row->adnu?" &#123;$row->adnu&#125;":"").
			" <font class=darkfont>[<a class=goldlink href=\"../pro/userinfo.php?userid=$row->uid\" target=u$row->uid>$row->uname</a>]</font></td>".
			"<td width=172><a class=goldlink href=\"../pro/list.php?groupid=$row->gid\" target=g$row->gid title=\"$row->gname ($row->ginum)\">$row->gname</a> $row->ginum".
			"<td width=60 align=right><font class=darkfont12>#".sprintf("%02d",$i)."</font> <a id=li$i class=goldlink href=\"javascript:exprow($i)\">[+]</a>&nbsp;</table>\n";
		//内容
		echo "<div id=cdiv$i class=hdiv><div>",str_replace("<","&lt;",substr($row->content,0,270))," </div><div>$row->comm </div><pre class=prem>$row->mc </pre>",$row->lmng?"<a href=../pro/userinfo.php?userid=$row->lmng>$row->mname</a>":"","</div>\n";
		$r=$row->rigt;
		$rs=($r&$rds0?1:0)|($r&$rds1?2:0)|($r&$rds2?4:0)|($r&$rds3?8:0)|($r&$rds4?16:0)|($r&$rds5?32:0)|($r&$rds6?64:0);
		$irows[$i]="$row->num,'$row->stat','$row->type','$row->deco',$rs,$row->gid,$row->box,\"$row->lmtm\"";
	}
} else if($iss1)echo "<table width=100% class=bd1><tr height=100><td align=center>--- 没有记录 ---</table>";
if($iss1)mysql_free_result($serrs);
?>
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;帖子管理</td><?php echo $v_pgstr; ?>
<td width="100" align="right"><input type=submit value=" 提交 ">&nbsp;</td>
</tr>
</table>
</form>
<script language=JavaScript src=../js/js.js></script>
<script language=JavaScript>
<?php
echo "irows=[";
for($i=0;$i<$lens;$i++)echo$i?",
":"","[{$irows[$i]}]";
echo "]
";
if($lens){
echo"for(var i=0;i<$lens;i++) G('cdiv'+i).style.height=\"1px\"
";

$q="select * from tdict force index(typekey) where type=7 order by key1 asc";
$R=mysql_query($q) or die(f_e($q));
$i=0;
echo "itype=[";
while($row=mysql_fetch_object($R))echo($i++?",":""),"$row->key1,\"$row->info\"";
echo "]
";
mysql_free_result($R);

$q="select * from tdict force index(typekey) where type=8 order by key1 asc";
$R=mysql_query($q) or die(f_e($q));
$i=0;
echo "ideco=[";
while($row=mysql_fetch_object($R))echo($i++?",":""),"$row->key1,\"$row->info\"";
echo "]
";
mysql_free_result($R);

$q="select * from tmng force index(ind) where uid=$_S[seuserid] and type=5 order by num asc";
$R=mysql_query($q) or die(f_e($q));
$i=0;
echo "boxs=[";
while($row=mysql_fetch_object($R))echo($i++?",":""),"$row->num,$row->box,\"$row->comm\"";
echo "]
";
mysql_free_result($R);

$q="select t1.gid,t2.name from tspu as t1 force index(unind) left join tgup as t2 on t1.gid=t2.id where t1.uid=".$_S['seuserid'];
$R=mysql_query($q) or die(f_e($q));
$i=0;
echo "grps=[";
while($row=mysql_fetch_object($R))if($row->gid)echo($i++?",":""),"$row->gid,\"".substr($row->name,0,50),"\"";
echo "]
";
mysql_free_result($R);
}
?>
</script>
<script language="JavaScript" src="../js/mng/i.js"></script>