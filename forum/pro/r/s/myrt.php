<?php e_e();
$IR=((int)$_R['rdright']<<16)|($_R['noteshow']?$right_saved['usershow']:0)|($_R['noterpy']?$right_saved['userrpy']:0)|($_R['notegview']?$right_saved['guestview']:0);
$ur->irgt=$IR;
$RR=($_R['rpyshow']?$right_saved['usershow']:0)|($_R['rpygview']?$right_saved['guestview']:0);
$ur->rrgt=$RR;
$q="update tuser set irgt=$IR,rrgt=$RR where id=$ur->id";
mysql_query($q) or die(f_e($q));