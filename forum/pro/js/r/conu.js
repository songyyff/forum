/*
con1.php
*/

function issch(o){
var d=G("schdiv");
if(o.innerHTML=="[-]"){o.innerHTML="[+]";d.style.height="1px"}else{o.innerHTML="[-]";d.style.height=""}
}

function chkname(o){
o.value=trim(o.value)
if(o.value.length<1||!isusername(o.value)){alert("用户名只能是ASCII字符,数字和汉字,至少1字符。");o.focus();return 0}
return 1
}

function submits(){if(chkname(G("uname")))G("sform").submit()}