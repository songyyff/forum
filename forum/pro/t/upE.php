<?php e_e();
$E=[0,"上传的文件超过了upload_max_filesize=".ini_get('upload_max_filesize')."限制的值。",
"上传文件的大小超过了HTML表单中MAX_FILE_SIZE=".$_R["MAX_FILE_SIZE"]." 选项指定的值。",
"文件只有部分被上传。",
"没有文件被上传。",
"找不到临时文件夹。",
"文件写入失败。",
"File upload stopped by extension."];
e("upload file error: ".$E[$i]);