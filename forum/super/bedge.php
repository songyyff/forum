<?php

e_e();

if($T=(int)$_REQUEST[action])include "s/ordbg.php";else $T=1;

echo "<div class=subhead><b>论坛徽章管理</b> ",date("Y-m-d H:i:s",time()),"<hr></div>",$msg||$inf?"<div class=bd1pd1>提交信息：<font color=red>$msg$inf</font></div>":"";
?>
<script language=javascript>
bgs=[<?php
//论坛徽章图标
$q="select * from bgs where uid=0 order by s";
$rs=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($rs))echo"[$r->s,\"$r->bg\",\"$r->n\",\"$r->q\",$r->r],";
mysql_free_result($rs);
echo "0];
actmode='$T";
?>';
bgs.pop();
</script><div id=con class=pd1></div>
<div class=pd1>
<hr>
<form method=post onsubmit="return checkdata()" enctype="multipart/form-data" action="?type=<?php echo $vtype;?>">
<table cellspacing=0 cellpadding=5><tr><td width=60></td>
<td><input type=radio name=action onclick="doact(this)" value=1<?php echo $T==1?" checked":"","></td><td width=30>排序</td>
<td><input type=radio name=action onclick=doact(this) value=2",$T==2?" checked":"","></td><td width=30>修改</td>
<td><input type=radio name=action onclick=doact(this) value=3",$T==3?" checked":"","></td><td width=30>删除</td>
<td><input type=radio name=action onclick=doact(this) value=4",$T==4?" checked":"";?>></td><td >添加</td><td></td></tr>
</table>

<style>textarea{font-size:13px;}</style>

<div id=formdiv></div>

<table cellspacing=0 cellpadding=5 width=100%><tr height=43><td width=60></td><td><input type=submit value="  提交(S)  "></table>
</form>
</div>

<script src="../js/js.js" language=javascript></script>
<script src="js/bg.js" language=javascript></script>