<?php e_e();
function f_mtime(){list($u,$s)=explode(" ",microtime()); return ((float)$u+(float)$s);}
$pbid=isset($_R['boxid'])?(int)$_R['boxid']:2;
$iss1=!(!$pbid&&!isset($_R['stype']));
$stt=f_mtime();
$msgs="";
if((isset($_R['comms'])||isset($_R['mscomms'])||isset($_R['mngs']))&&!isset($_R['isserpage'])){
	include "u/usub.php";//执行提交
}
if(!$pbid){
	if(isset($_R['stype']))include "u/uuss.php";//有查找
}else{
$q="select t1.num,t1.box,t1.ctime as mctime,t1.ltime as mltime,t1.comm,
t2.*,
t3.name as mname,
(select GROUP_CONCAT(m.ltime,\" <a href=../pro/userinfo.php?userid=\",uid,\">\",u.name,\"</a>:\\\n\",m.comm SEPARATOR \"\\\n\")
from tmng as m use index(tn) left join tuser as u on m.uid=u.id where m.type=11 and m.num=t1.num group by m.type) as mc 
from tmng as t1 force index(ind)
left join tuser as t2 force index(primary) on t2.id=t1.num
left join tuser as t3 force index(primary) on t3.id=t2.lmng
where t1.uid=".$_S['seuserid']." and t1.type=2".($pbid>1?" and t1.box=$pbid":"")." order by t1.ctime desc limit ".($cpage-1)*$ps.",".$ps;
}
//echo $q;
if($iss1){
	$serrs=mysql_query($q) or die(f_e($q));
	$edt=f_mtime();
	$lens=mysql_num_rows($serrs);
}

$q="select * from tmng force index(ind) where uid=$uid and type=7 order by num";
$r1=mysql_query($q) or die(f_e($q));
if($l1=mysql_num_rows($r1))for($i=0;$i<$l1;$i++){
		$row=mysql_fetch_object($r1);
		$boxsel.="<option value=$row->num".($row->num==$pbid?" $d":"").">$row->comm ($row->box)</option>";
		if($row->num==$pbid) $rowcnt=$row->box;
		if(!$pbid) $boxs.=($i?",":"").$row->num.",".$row->box.",\"".$row->comm."\"";
		$cn+=$row->box;
}
mysql_free_result($r1);
$boxsel.="<option value=1".($pbid==1?$d:"").">所有用户 ($cn)</option>";
$boxsel.="<option value=0".($pbid?"":$d).">搜索</option>";
include "../func/pgnum.php";
f_getpagestr($cpage,$pbid?($pbid>1?$rowcnt:$cn):($iss1?($lens<$ps?($cpage-1)*$ps+($lens?$lens:1):($cpage+3)*$ps):0),$ps,10,"?type=$vartype&boxid=$pbid",0,0,isset($_R['stype']));
?>
<form id=mainform enctype="multipart/form-data" method="POST" action="?type=<?php echo "$vartype&page=$cpage"; ?>" onsubmit="return submitform()">
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;用户管理</td>
<td class="pdtb1p"><select id=glist name=boxid onchange="changebox(this.value)">
<?php echo $boxsel; ?>
</select></td>
<td width="100" align=right><input type=submit value=" 提交 ">&nbsp;</td>
</tr>
</table>
<?php
if(!$pbid)include "u/uus.php";
if($iss1)echo "<table width=100% class=bdb1 border=1 cellpadding=0 cellspacing=0><tr height=23 class=darkbar><TD width=120>&nbsp;翻页</td>$v_pgstr<td width=150 align=right>查询用时 ".substr($edt-$stt,0,8)." 秒&nbsp;</td></tr></table>\n";
if($sml=count($_R['mngs'])){
	echo "<table width=100% border=1 cellpadding=0 cellspacing=0><tr height=23 class=darkbar><TD width=120>&nbsp;提交结果</td><td>共有 [ $sml ] 个修改提交</td><td width=100 align=right><a id=expmsg class=goldlink href=\"javascript:expmsg()\">[-]</a>&nbsp;</td></tr></table>\n".
	"<div id=rsmsg class=msgdiv><table width=100% class=bd1 border=1 cellpadding=0 cellspacing=0><tr><td class=pd1>";
	$rl=count($msgs);
	for($k=0;$k<$rl;$k++)echo $msgs[$k][0]=="["?"<br><font class=warningc>".$msgs[$k]."</font>":"<br>".$msgs[$k]; 
	echo "<br>&nbsp;</td></tr></table></div>";
}
if($lens){
	$rds0=$right_saved['userview'];
	$rds1=$right_saved['usernew'];
	$rds2=$right_saved['userrpy'];
	$rds3=$right_saved['usermodify'];
	$rds4=$right_saved['uservote'];
	$rds5=$right_saved['usermsg'];
	$rds6=$right_saved['userstop'];
	echo "<table width=100% class=bdb1 border=1 cellpadding=0 cellspacing=0><tr height=23 class=darkbar><TD width=120>&nbsp;加入时间</td><td width=172>编号.用户名</td><td>注册时间 性别 [阅读权限] (贴有/无效数) (回复有/无效数) 删贴/回复数</td><td width=60 align=right><a id=eprs class=goldlink href=\"javascript:exprows()\">[+]</a>&nbsp;</td></tr>".
	"<tr height=23 class=darkbar><TD width=120 class=bdt1>&nbsp;快照</td><td colspan=3 class=bdt1>金钱,朋友数,订阅数,在线分钟数,最后[活动时间,登录IP],短信(收到,发送,删除)数,界面风格,徽章数</td></tr></table>\n";
	$irows=Array($lens);
	$bgs=Array($lens);
	for($i=0;$i<$lens;$i++){
		$row=mysql_fetch_object($serrs);
		echo "<table width=100%  border=1 cellpadding=0 cellspacing=0>".
			"<tr height=23 class=darkbar><TD width=120>&nbsp;".f_date($row->mctime)."</td><td class=pdtb1p width=172>".
			"$row->num.<a class=goldlink href=\"../pro/userinfo.php?userid=$row->num\" target=u$row->num>$row->name</a></td><td>$row->ctime ",$row->sex?"男":"女"," [$row->rdnum] ($row->inum/$row->dnum) ($row->rnum/$row->drnu) $row->deli/$row->delr</td>".
			"<td width=60 align=right><font class=darkfont12>#".sprintf("%02d",$i)."</font> <a id=li$i class=goldlink href=\"javascript:exprow($i)\">[+]</a>&nbsp;</td></tr></table>\n";
		//内容
		echo "<div id=cdiv$i class=hdiv><p>$row->money,$row->fnum,$row->sbnu,$row->ontime,[$row->ltime,$row->ip],($row->rmnu,$row->smnu,$row->dmnu),$row->styl,<a class=goldlink href=bgs.php?userid=$row->num>$row->bgs</a></p><p>$row->comm </p><pre>$row->mc </pre>",$row->lmng?"<a href=../pro/userinfo.php?userid=$row->lmng>$row->mname</a>":"","</div>\n";
		$r=$row->rigt;
		$rs=($r&$rds0?1:0)|($r&$rds1?2:0)|($r&$rds2?4:0)|($r&$rds3?8:0)|($r&$rds4?16:0)|($r&$rds5?32:0)|($r&$rds6?64:0);
		$bgs[$i]=$row->bgs;
		$irows[$i]="$row->num,'$row->stat',$row->level,'$row->ontime',$rs,$row->rdnum,$row->box,0,0,\"$row->lmtm\",'$row->money','$row->inte','$row->maxr','$row->maxs','$row->maxd','$row->maxsb','$row->maxf',\"$row->email\",'$row->gmnu'";
	}
} else if($iss1)echo "<table width=100% class=bd1><tr height=100><td align=center>--- 没有记录 ---</td></tr></table>";
if($iss1)mysql_free_result($serrs);
?>
<table width="100%" class="bar2b" border=1 cellpadding=0 cellspacing=0>
<tr height=23>
<TD width="119">&nbsp;用户管理</td><?php echo $v_pgstr; ?>
<td width="100" align="right"><input type=submit value=" 提交 ">&nbsp;</td>
</tr>
</table>
</form>
<script language="JavaScript" src="../js/js.js"></script>
<script language="JavaScript" src="../js/tag.js"></script>
<script language="JavaScript" src="../theme/<?php echo $_SESSION['sestyle']; ?>/js.js"></script>
<script language="JavaScript">
<?php
echo "var irows=[";
for($i=0;$i<$lens;$i++) echo ($i?",":""),"[",$irows[$i],"]";
echo "],\nbgs=[";
for($i=0;$i<$lens;$i++) echo "$bgs[$i],";
echo "0]\n";
if($lens){
echo "for(var i=0;i<$lens;i++) G('cdiv'+i).style.height=\"1px\";\n";

$q="select * from tdict force index(typekey) where type=5 order by key1 asc";
$R=mysql_query($q) or die(f_e($q));
$i=0;
echo "ulevels=[";
while($row=mysql_fetch_object($R)) echo ($i++?",":"").$row->key1.",\"".$row->info."\"";
echo "];\n";
mysql_free_result($R);

$q="select * from tmng force index(ind) where uid=".$_SESSION['seuserid']." and type=7 order by num asc";
$R=mysql_query($q) or die(f_e($q));
$i=0;
echo "boxs=[";
while($row=mysql_fetch_object($R)) echo ($i++?",":"").$row->num.",".$row->box.",\"".$row->comm."\"";
echo "];\n";
mysql_free_result($R);
}
?>
</script>
<script language="JavaScript" src="../js/mng/u.js"></script>