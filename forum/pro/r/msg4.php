<?php e_e();

if($_R[subm])if($right_saved['usermsg']&$su->rigt){
if(!isset($_R[Del])||$_R[justFri]){
$su->msgt=$_R[justFri]?0:1;
$q="update tuser set msgt=$su->msgt where id=$su->id";
mysql_query($q) or die(f_e($q));
}else{
if(strlen($U=&$_R[userID])&&ctype_digit($U)){
if($su->numf<$su->maxf){
$q=$_R[Del]?"delete from tfrid where uid=$su->id and type=1 and fid=$U":"insert into tfrid(uid,type,fid)values($su->id,1,$U)";
mysql_query($q)or$N=mysql_errno();
if($N&&$N!=1062)die(f_e($q));
else{
$q="update tuser set numf=numf".($_R[Del]?"-":"+")."1 where id=$su->id";
mysql_query($q) or die(f_e($q));
}
}else$MSG="您最多可以拒绝 $su->maxf 个消息对象,当前已有 $su->numf个;操作失败.";
}else$MSG="提交参数有错误,操作失败.";
}
}else$MSG="您没有消息权限,操作失败.";

?>

<div class=O><?php $Z=$su->msgt?"拒绝":"接受";echo$Z?>消息人</div>
<style>
#nomsg{padding:10 5;line-height:30px;}
#nomsg b{color:red}
</style>
<div class=blrp5 style='width:100%'>

<div id=nomsg>
<?php
if($MSG)echo"<b>提交结果</b> $MSG<br>";
$q="select f.fid,u.name from tfrid as f left join tuser as u on f.fid=u.id where f.uid=$su->id and f.type=$su->msgt";
$R=mysql_query($q) or die(f_e($q));
for($i=1;$r=mysql_fetch_object($R);$i++)echo"<b>$r->fid</b>.",$r->fid?"$r->name ":"所有 ";
?>
</div>
<input type=hidden name=subm value=1>
<?php
echo"<input type=checkbox id=justFri name=justFri value=1",$su->msgt?"":" checked",">只接受朋友消息<br>";
if($su->msgt)echo"<input type=radio name=Del value=0",$_R[Del]?"":" checked",">添加拒绝用户编号 <input type=radio name=Del value=1",$_R[Del]?" checked":"",">消除拒绝用户编号 <input type=text id=userid name=userID maxlength=20><br>"
?>
<input type="button" style="margin:5 0" onclick=smit() value="   提交   ">
<br>
<?php
echo$su->msgt?"您只接受您的朋友向您发送的消息，其它任何人无法向您发送消息。":"您将拒绝这些人向您发送任何消息；添加编号为 0 的用户将拒接除了管理员以外任何人的消息。","
</div>

<div class=O>$Z"?>消息人</div>

<script language=JavaScript>
T=G('justFri').checked
function smit(){
if(!T&&!G('justFri').checked){o=userid;if(!o.value.length||/\D/.test(o.value)){alert("用户ID只能是个数字.");o.focus();return}}
msgform.submit()}
</script>