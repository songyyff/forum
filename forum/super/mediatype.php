<?php

e_e();

if($T=(int)$_REQUEST[action])include "s/ordmedia.php";else $T=1;

echo "<div class=subhead><b>论坛支持媒体类别管理</b> ",date("Y-m-d H:i:s",time()),"<hr></div>",$msg||$inf?"<div class=bd1pd1>提交信息：<font color=red>$msg$inf</font></div>":"";
?>
<script language=javascript>
ts=[<?php
//论坛徽章图标
$q="select * from tdict use index(typekey) where type=17 order by key1";
$rs=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($rs))echo"[$r->key1,\"$r->info\",\"$r->info2\",$r->id,'$r->ctime'],";
mysql_free_result($rs);
echo "0];
actmode='$T";
?>';
ts.pop();
</script><div id=con class=pd1></div>
<div class=pd1>
<hr>
<form method=post onsubmit="return checkdata()" enctype="multipart/form-data" action="?type=<?php echo $vtype;?>">
<table cellspacing=0 cellpadding=5><tr><td width=60>
<td><input type=radio name=action onclick="doact(this)" value=1<?php echo $T==1?" checked":"","><td width=30>排序
<td><input type=radio name=action onclick=doact(this) value=2",$T==2?" checked":"","><td width=30>修改
<td><input type=radio name=action onclick=doact(this) value=3",$T==3?" checked":"","><td width=30>删除
<td><input type=radio name=action onclick=doact(this) value=4",$T==4?" checked":"";?>><td >添加<td>
</table>

<style>textarea{font-size:13px;}</style>

<div id=formdiv></div>

<table cellspacing=0 cellpadding=5 width=100%><tr height=43><td width=60></td><td><input type=submit value="  提交(S)  "></table>
</form>
</div>

<script src="../js/js.js" language=javascript></script>
<script src="js/media.js" language=javascript></script>