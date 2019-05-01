<?php include "../func/mustfunc.php"?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html charset=utf-8">
<?php echo"<link rel=stylesheet type=text/css href=../theme/$_S[sestyle]/msg.css>";?>
<base target="_top">
<script language=javascript>
MIW=parent.MIW
document.write("<style>#mpre{width:"+MIW+"}#mpre img{max-width:"+(MIW-10)+"px;behavior:url(../images/img.htc)}</style>")
</script>
</head>
<body onload=load()>
<?php

if(!$mid=(int)$_R['msgid'])$M="缺少消息ID.";
if(!$uid=$_S['seuserid'])$M="您未登陆.";

$q="select m.*,b.*,u.name
from msg as m
left join msgs as b on m.mid=b.bid
left join tuser as u on m.fid=u.id
where m.id=$mid";
$R=mysql_query($q) or die(f_e($q));
if(!$r=mysql_fetch_object($R))$M="消息 $mid 不存在.";
elseif($r->uid!=$uid)$M="<s>消息 $mid 不属于你,你无权查看.";

echo$M?$M:"<pre id=mpre>$r->body</pre>";

if(!$M&&!$r->rd){
$q="update msg set rd=1 where id=$mid";
mysql_query($q) or die(f_e($q));
if(!$r->type&&mysql_affected_rows()){
$q="update tuser set nmnu=nmnu-1 where id=$uid";
mysql_query($q) or die(f_e($q));
}
}
?><script language=javascript>O=parent.ifs[location.href.substr(location.href.lastIndexOf("=")+1)];function load(){O.style.height=document.body.scrollHeight;if(o=this)o.onload=null}
I=document.getElementsByTagName('img')
for(i=0;o=I[i++];)o.onload=load
</script></body></html>