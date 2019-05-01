<?php e_e();

// 重写 /w/av.js 支持视频网数据文件

$f="$_rootpath/w/av.js";
$z="$_rootpath/w/avi.js";
@unlink($f);
@unlink($z);
$h=@fopen($f,"w");
$y=@fopen($z,"w");
@fwrite ($h, "// 支持视频网数据文件 " . date("Y-m-d H:i:s",time()) . "
avs=[");
@fwrite ($y, "// 支持视频网数据文件 " . date("Y-m-d H:i:s",time()) . "
vid=\"");
$q="select * from tdict where type=17 order by key1";
$R=mysql_query($q) or die(f_e($q));
$i=0;
while($r=mysql_fetch_object($R)){
@fwrite($h,($i++?",":"")."\"$r->info2\"");
@fwrite($y,"<p><u>$r->info2</u>$r->info");
}
mysql_free_result($R);
@fwrite($h,"]");
@fclose($h);
@fwrite($y,"\"");
@fclose($y);
