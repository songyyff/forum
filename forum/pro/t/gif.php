<?php e_e();
if($fh=fopen($f['tmp_name'],"r")){
$s=fread($fh,6);
if($s!="GIF89a"&&$s!="GIF87a")$z="application/unknow";
fclose($fh);
}