<?php e_e();

$F=0;

if(isset($_R['msgid'])){

$q="select m.*,b.* from msg as m left join msgs as b on m.mid=b.bid where m.id=".(int)$_R['msgid'];
$R=mysql_query($q) or die(f_e($q));
if($R)$mr=mysql_fetch_object($R);
mysql_free_result($R);
if($mr)
if($mr->uid==$_S['seuserid'])$F=$mr->fid;else f_toerror("notyourmsg"); 

}else if(isset($_R['userid']))$F=(int)$_R['userid']; //else f_toerror("urlneedvar");

if($F==$_S['seuserid'])f_toerror("msgtoself");

if($F){
$q="select * from tuser where id=$F";
$R=mysql_query($q) or die(f_e($q));
if(!$fr=mysql_fetch_object($R))f_toerror("nouser");
}