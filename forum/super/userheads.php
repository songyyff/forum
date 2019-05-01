<?php

e_e();

if($T=(int)$_REQUEST[action])include "s/orduh.php";else $T=1;

echo "<div class=subhead><b>论坛用户系统头像设置</b> ",date("Y-m-d H:i:s",time()),"<hr></div>",$msg||$inf?"<div class=bd1pd1>提交信息：<font color=red>$msg$inf</font></div>":"";
?>
<script language=javascript>
var uhs=[<?php
//论坛表情图标
$q="select * from tdict where type=1 order by key1";
$rs=mysql_query($q) or die(f_e($q));
while($r=mysql_fetch_object($rs))echo "[$r->key1,\"$r->info\",\"$r->info2\"],";
mysql_free_result($rs);
echo "1],
actmode='$T";
?>';
uhs.pop();
function G(o){return document.getElementById(o)}
</script>
<div id=con class=pd1></div>
<form method=post onsubmit="return checkdata()" enctype="multipart/form-data" action="?type=<?php echo $vtype;?>">
<table cellspacing=0 cellpadding=5><tr><td width=60></td>
<td><input type=radio name=action onclick="doact(this)" value=1<?php echo $T==1?" checked":"","></td><td width=30>排序</td>
<td><input type=radio name=action onclick=\"doact(this)\" value=2",$T==2?" checked":"","></td><td width=30>修改</td>
<td><input type=radio name=action onclick=\"doact(this)\" value=3",$T==3?" checked":"","></td><td width=30>删除</td>
<td><input type=radio name=action onclick=\"doact(this)\" value=4",$T==4?" checked":"";?>></td><td >添加</td><td></td></tr>
</table>
<div id=formdiv></div>
<table cellspacing=0 cellpadding=5 width=100%>
<tr height=43><td width=60></td><td><input type=submit value="  提交(S)  "></td></tr></table>
</form>
<div class=pd1>
<hr>
<div class=bd1pd1>--- 实现效果 ---</div>
<div class=pd1 id=uh_plain></div>
</div>
<script src="../js/js.js" language=javascript></script>
<script language=javascript>uh_head="";</script>
<script src="../w/uh.js" language=javascript></script>
<script src="../mjs/uh.js" language=javascript></script>
<script src="js/uh.js" language=javascript></script>