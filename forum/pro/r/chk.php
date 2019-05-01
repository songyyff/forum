<?php

e_e();

function r($r){
global $E,$in,$iq;
switch($r[0]){
case '<':if($in&&!$iq)$E=1;$in=1;break;
case '>':if(!$iq)$in=0;break;
case '\"':if($in)$iq=$iq?$iq&1?0:2:1;break;
case '\'':if($in)$iq=$iq?$iq&1?1:0:2;break;
default:
if($r[0][0]=='<')$E=1;
if($in&&!$iq)$E=1;
}
}

preg_replace_callback(
"'<(applet|iframe|object|embed|script)\b|<[^a-z]|[<>\"\']|\bon[a-z]+\s*='si",
'r',$s);

if($in)$E=1;