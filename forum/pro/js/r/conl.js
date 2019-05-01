
ifs={}
function getmsg(o,i){
var d,r=o.parentNode.parentNode,t=r.parentNode,nr=r.nextSibling
if(o.r){t.removeChild(o.d)
o.r=0
}else{
if(o.d){t.insertBefore(o.d,nr);o.r=1}
else{t.insertBefore(r=C('tr'),nr)
A(r.insertCell(0),e=C('iframe'))
e.allowTransparency=true
e.src="imsg.php?msgid="+i
ifs[i]=e
o.d=r
o.r=1}
}
return false}