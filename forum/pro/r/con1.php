<?php

e_e();

function f_mtime(){list($u,$s)=explode(" ",microtime()); return ((float)$u+(float)$s);}
$q="select max(id) as num from tuser";
$R=mysql_query($q) or die(f_e($q));
$cnt=mysql_fetch_object($R)->num;
mysql_free_result($R);

if($S=isset($_R['uname'])){
$mysqli=new mysqli($_host,$_super,$_pass,$_db,$_port);
$mysqli->query("set names utf8");
if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());die;}
$stmt=$mysqli->prepare("select id from tuser use index(name) where name=?");
$stmt->bind_param('s',str_replace('<',"&lt;",$_R[uname]));
$stmt->execute();
$stmt->bind_result($u);
$stmt->fetch();
}


$q=$S?"select id,name,ctime,stat,inum,rnum,ltime from tuser force index(name) where id=$u"
:"select id,name,ctime,stat,inum,rnum,ltime from tuser force index(primary) where id>".($CP-1)*($Z=$_S['seitsize'])." limit $Z";

$starttime=f_mtime();
$R=mysql_query($q) or die(f_e($q));
$endtime=f_mtime();
$l=mysql_num_rows($R);
?>

<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 class=p5>论坛用户<td<?php echo$S?" class=p5 align=right>共 $l 条记录".($l==$Z?"，结果也许多过 $l 条记录":""):" id=ps1>";?></table>

<div id=o><tt id=fr>查询用时 <?php echo substr($endtime-$starttime,0,8); ?> 秒 <a class=whitelink href="javascript:;" onclick="return issch(this)">[+]</a></tt>搜索</div>

<div id=schdiv style="overflow:hidden;height:1px;width:100%;">
<form class=bp5 id=sform method="POST" action="?type=1">
用户名 <input type=text id=uname name=uname maxlength=20> <input type=button onclick="submits()" value="  提交  ">
</form>
</div>

<table width=100% id=E style='table-layout:fixed' cellpadding=5 cellspacing=0>
<tr><td style='border-top:0'><tt id=fr>最后活动时间 状态 在线否</tt>注册时间 用户名 (贴数/回复数)
<?php
if($l)for($i=0;$i<$l;$i++){
$r=mysql_fetch_object($R);
echo "
<tr",$i&1?"":" class=tr","><td><tt id=fr>",f_date($r->ltime)," ",$r->stat=='E'?"有效":"<tt class=lightfont>无效</tt>"," ",f_isonline($r->ltime)?"下线":"<tt class=lightfont>在线</tt>","</tt>",f_date($r->ctime),
" <a class=goldlink href=\"userinfo.php?userid=$r->id\">$r->name</a> ($r->inum/$r->rnum)";
}else echo"<tr height=100><td align=center>",$S?"------ 没有名为 [$_R[uname]] 的用户 ------ ":"--- 没有记录 ---";
mysql_free_result($R);
?>
</table>

<table width=100% class=tb cellpadding=1 cellspacing=0><tr><TD width=100 class=p5>论坛用户<td<?php echo$S?" class=p5 align=right>共 $l 条记录".($l==$Z?"，结果也许多过 $l 条记录":""):" id=ps2>";?></table>

<?php 
if(!isset($_R['uname']))echo"
<script language=JavaScript>
Pinfo={p:$CP,R:$cnt,z:$Z,w:10,u:'?type=$VT&page='}
</script>
<script language=JavaScript src='../js/pg.js'></script>
";
?>
<script language=JavaScript src="js/r/conu.js"></script>