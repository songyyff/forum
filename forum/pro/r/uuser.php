<?php e_e();?>

<script language=JavaScript src=js/r/uuser.js></script>

<div class=O><?php echo $_R['userid']==$_S['seuserid']?"<a class=whitelink id=fr href=\"myself.php?type=5\">[修改]</a>":"";?>用户资料</div>

<style>table{empty-cells:show;}</style>

<table width=100% id=H cellpadding=5 cellspacing=0>
<?php
echo "
<tr><TD width=150>用户编号<td>$U->id
<tr><TD>用户名<td>$U->name
<tr><TD>性别<td>",$U->sex?"男":"女","
<tr><TD>生日<td>$U->bhday
";

if($U->bgs)include"userbgs.php";

echo"<tr><TD class=bdt1>联系电话<td class=bdt1>$U->phon&nbsp;
<tr><TD>QQ号<td>$U->qq
<tr><TD>电子邮件<td>$U->email
<tr><TD class=bdb1>个人主页地址<td class=bdb1>$U->http&nbsp;
<tr><TD>阅读权限<td>$U->rdnum
<tr><TD>积分<td>$U->inte
<tr><TD>等级<td>lv$U->level $U->ulvl
<tr><TD>帖子数量<td>$U->inum
<tr><TD>回复数量<td>$U->rnum
<tr><TD>在线总时间<td>",(int)($U->ontime/60),"小时 ",$U->ontime%60,"分钟
<tr><TD>注册时间<td>$U->ctime
<tr><TD>最后活动时间<td>$U->ltime
<tr><TD>状态<td>",f_isonline($U->ltime)?"不在线":"在线 <img src='../images/on.gif'>","
<tr><TD class=bdt1>签名<td class=bdt1><pre id=spre>$U->sign
<tr><TD class=bdt1>个人介绍<td class=bdt1><pre id=spre>$U->info
<tr><TD class=bdt1>最新帖子时限<td class=bdt1>$U->newt 小时
<tr><TD>回复页面尺寸<td>$U->rsize 行
<tr><TD>论坛帖子页面尺寸<td>$U->isize 行";s
?>
</table>

<div class=O>用户资料</div>