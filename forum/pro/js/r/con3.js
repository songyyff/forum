/*

con3.php

*/


function im(o){
//O.src=o.src.replace(/\/([^\/]*)$/,"/b/$1")
s=o.src
o.className='b'
for(i=s.length-6;s.charAt(i--)!='/';);
o.src=s.substr(0,++i)+"/b"+s.substr(i,s.length)
}

function io(o){o.src=s}