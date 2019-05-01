<?php

e_e();

if(isset($_REQUEST['rdright']))include"r/s/myrt.php"; //有提交 

?>

<div class=O><a id=fr href="javascript:submitform()" class=whitelink>[ 提交 ]</a>我的权限</div>

<div id=o>新帖默认权限</div>

<div class=bp5>
<table width=100% cellpadding=5 cellspacing=0>
<tr>
<td width=120>阅读权限
<td width=100><input type=text id=rdnum name=rdright value="<?php echo $ur->irgt>>16 ?>"><td>(0 - 255)
<tr>
<td>是否显示
<td><input type=radio name=noteshow value=1<?php $c=" checked"; echo($is=$right_saved['usershow']&$ur->irgt)?$c:"";?>>显示 <input type=radio name=noteshow value=0<?php echo$is?"":$c;?>>不显示
<tr>
<td>可否回复
<td><input type=radio name=noterpy value=1<?php echo($is=$right_saved['userrpy']&$ur->irgt)?$c:""; ?>>可以 <input type=radio name=noterpy value=0<?php echo $is?"":$c;?>>不可
<tr>
<td>匿名用户浏览
<td><input type=radio name=notegview value=1<?php echo($is=$right_saved['guestview']&$ur->irgt)?$c:"";?>>可以 <input type=radio name=notegview value=0<?php echo $is?"":$c; ?>>不可
</table>
</div>

<div id=o>回复默认权限</div>

<div class=bp5>
<table width=100% cellpadding=5 cellspacing=0>
<tr>
<td width=120>是否显示
<td><input type=radio name=rpyshow value=1<?php echo ($is=$ur->rrgt&$right_saved['usershow'])?$c:""; ?>>显示 <input type=radio name=rpyshow value=0<?php echo $is?"":$c; ?>>不显示
<tr>
<td>匿名用户浏览
<td><input type=radio name=rpygview value=1<?php echo ($is=$ur->rrgt&$right_saved['guestview'])?$c:""; ?>>可以 <input type=radio name=rpygview value=0<?php echo $is?"":$c; ?>>不可以
</table>
</div>

<div id=o>拥有权限</div>

<div class=bp5>
<table width=100% cellpadding=5 cellspacing=0>
<tr><td width=120>用户等级
<td><?php 
$q="select info from tdict where type=5 and key1=$ur->level;";
$R=mysql_query($q) or die(f_e($q));
echo mysql_fetch_object($R)->info;
mysql_free_result($R);
?> 级</td></tr>
<tr><td>阅读权限<td><?php echo $ur->rdnum; ?>
<tr><td>普通用户浏览权<td><?php echo $ur->rigt&$right_saved['userview']?"<font class=lightfont>有</font>":"无"; ?>
<tr><td>普通用户发贴权<td><?php echo $ur->rigt&$right_saved['usernew']?"<font class=lightfont>有</font>":"无"; ?>
<tr><td>普通用户修改权<td><?php echo $ur->rigt&$right_saved['usermodify']?"<font class=lightfont>有</font>":"无"; ?>
<tr><td>普通用户回复权<td><?php echo $ur->rigt&$right_saved['userrpy']?"<font class=lightfont>有</font>":"无"; ?>
<tr><td>普通用户投票权<td><?php echo $ur->rigt&$right_saved['uservote']?"<font class=lightfont>有</font>":"无"; ?>
<tr><td>普通用户消息权<td><?php echo $ur->rigt&$right_saved['usermsg']?"<font class=lightfont>有</font>":"无"; ?>
<tr><td>普通用户被禁言<td><?php echo $ur->rigt&$right_saved['userstop']?"<font class=lightfont>未禁</font>":"被禁"; ?>
<tr><td>是否论坛管理员<td><?php echo $_SESSION['seismng']?"<font class=lightfont>是</font>":"不是"; ?>
</table>
</div>

<?php
$q="select t1.gid,t1.rigt as mright , t1.ctime, name,vnum,inum,rnum from tspu as t1 left join tgup as t2 on t1.gid=t2.id where t1.uid =".$_SESSION['seuserid']." order by ctime desc";
$R=mysql_query($q) or die(f_e($q));
if($l=mysql_num_rows($R)){
echo "<div id=o>管理的论坛</div>
<div class=bp5 style='border-bottom:0'>
<table width=100% id=mrt cellpadding=5 cellspacing=0>
<thead align=center><Th align=left>成为管理时间 论坛名 [帖子/回复/访问数]<th width=35>浏览<th width=35>发贴<th width=35>隐藏<th width=35>修改<th width=35>删除<th width=35>人事<tbody>";
for($i=0;$i<$l;$i++){
$r=mysql_fetch_object($R);
echo"<tr",$i&1?"":" class=tr"," align=center>
<td align=left>",f_date($r->ctime),
$r->gid?" <a class=goldlink href='list.php?groupid=$r->gid'>$r->name</a> [$r->inum/$r->rnum/$r->vnum]":" 根论坛",
"<td>",$r->mright&$right_saved['superview']?"V":"X",
"<td>",$r->mright&$right_saved['supernew']?"V":"X",
"<td>",$r->mright&$right_saved['superhidden']?"V":"X",
"<td>",$r->mright&$right_saved['supermodify']?"V":"X",
"<td>",$r->mright&$right_saved['superdel']?"V":"X",
"<td>",$r->mright&$right_saved['superother']?"V":"X";
}
echo"</table></div>";
}
mysql_free_result($R);
?>

<div class=O><a id=fr href="javascript:submitform()" class=whitelink>[ 提交 ]</a>我的权限</div>

<script language=JavaScript src="js/r/myrt.js"></script>