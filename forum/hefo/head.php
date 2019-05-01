<?php e_e();
if(isset($_S["seuserid"])&&($_S["semsgt"]+60)<time())include"mst.php";
?>
<table width=100% cellspacing=0 cellpadding=0><TR><TD width=600><img id=imgtil><td id=titcom align=center></table>
<div class=menuc id=menutd><?php echo$_S['seuserid']?"<a href=../pro/userinfo.php?userid=$_S[seuserid]>$_S[seusername]</a>":"";?></div>
<script language=JavaScript><?php echo"uid=$_S[seuserid],msgs=\"$_S[semsgs]\",ismng=0$_S[seismng]";?></script><script language=JavaScript src=../hefo/h.js></script>