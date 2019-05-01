<?php

e_e();

$psize=20;
$q="select * from tdict force index(typekey) where type=4 order by key1 asc limit ".($CP-1)*$psize.",$psize";
$R=mysql_query($q) or die(f_e($q));
$l=mysql_num_rows($R);
?>


<div class=O><a id=fr href="javascript:submitform()" class="whitelink">[ 提交 ]</a>选择主题</div>

<style>
#c td{text-align:center;}
</style>
<form class=blr id=tform method=POST action="?type=2">
<?php
if($l){
echo "
<table width=100% id=c cellpadding=10 cellspacing=0>
";
for($i=0;$i<$l;$i++){
$r=mysql_fetch_object($R);
echo $i&1?"":"<tr>","<td>
<div>
<img src='../images/theme/$r->info.jpg'><br>
<input type=radio name=theme value=$r->key1".($_SESSION['sestyle']==$r->info?" checked":"").">$r->info2
</div>
</td>";
}
echo "
</table>
";
}
mysql_free_result($R);
?>
</form>

<div class=O><a id=fr href="javascript:submitform()" class="whitelink">[ 提交 ]</a>选择主题</div>

<script language=JavaScript>
function S(v){return document.styleSheets.item(0).rules[v].style;}
if(window.navigator.userAgent.search("Firefox")<0)for(i=0;i<6;i++)S(i).paddingBottom="0px";
function submitform(){
	obj=G("tform");
	obj.submit();
}
</script>