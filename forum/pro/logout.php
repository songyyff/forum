<?php include "../func/mustfunc.php";

while(count($_SESSION))array_pop($_SESSION);
foreach($_COOKIE as $key=>$val)setcookie($key,"",0,"/$_alias");
?>
<script language=JavaScript>history.go(-1);</script>