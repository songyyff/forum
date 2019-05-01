<?php e_e();
if($fh=fopen($f['tmp_name'],"r")){
$s=fread($fh,2);
if($s!="\xff\xd8")$z="application/unknow";
fclose($fh);
}