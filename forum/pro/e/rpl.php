<?php e_e();?>

<html>

<head>
<title><?php echo"回复错 - $sid";?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="../theme/<?php echo$_S[sestyle]; ?>/def.css">
</head>

<body>
<?php 
echo"<br><br><pre class=bp5>
<br>
<font color=red><b>回复错误!</b></font>
<br>
<hr>帖子id:$sid
<hr>标题：",f_rpspc($_R[til]),"
<hr>内容：$_R[con]<hr>
<b>目前系统过于繁忙，无法处理您的回复请求。稍后请用鼠标点击浏览器 “刷新” 按钮 ( 或按下键盘<font color=red>F5</font>键 ) ，再次尝试提交回复。</b>

时间：",date("Y-m-d H:i:s"),"
";
?></body>
</html>