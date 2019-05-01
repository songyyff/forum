<?php e_e();
if($fh=fopen($f['tmp_name'],"r")){
$s=fread($fh,8);
if($s!="\x89PNG\x0D\x0A\x1A\x0A")$z="application/unknow";
fclose($fh);
}