<?php e_e();
if($z&&substr($z->t,0,6)=="image/"){
header("Content-Type: image/gif");
header("Content-Length: ".filesize($f="../images/no".($i?"r":"").".gif"));
header("Cache-Control: max-age=9999999");
@readfile($f);
die;}
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=\"$adid.".date("Y-m-d H.i.s")." ".($i?"Have_not_permission_download_the_resource":"This_resource_not_exist").".TXT\"");
echo"\r
下载失败！\r
\r
原因：",$i?"没有权限下载":"资源不存在","\r
时间：",date("Y-m-d H:i:s"),"\r
\r
资源信息：\r
编号 $adid\r
名称 ",stripslashes($z->n),"\r
大小 $z->s\r
类型 $z->t\r
时间 $z->lt";
die;