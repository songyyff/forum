<div id=helpmenudiv style="width:200px;">
</div>
<script language="JavaScript" src="../mjs/<?php echo $tt==2&&!$eid?"mm":"um"; ?>.js"></script>
<script language="JavaScript" src="../js/helptree.js"></script>
<script language="JavaScript">
G("helpmenudiv").innerHTML=ism&&wm==2?buildmnghelp():builduserhelp();
</script>