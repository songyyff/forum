
delN=0
for(o=io;o=o.nextSibling;a.name="delmsg[]",a.onclick=function(){delN+=this.checked?1:-1})a=o.firstChild.firstChild

function deletemsg(){if(delN)if(PGI.T==2)if(!confirm("这将彻底删除被选消息，您确定删除吗？"))return;msgform.submit()}

ifs={}
function getmsg(o,i){
var d,r=o.parentNode.parentNode,t=r.parentNode,nr=r.nextSibling
if(o.r){t.removeChild(o.d)
o.r=0
}else{
if(o.d){t.insertBefore(o.d,nr);o.r=1}
else{t.insertBefore(r=C('tr'),nr)
A(d=r.insertCell(0),e=C('iframe'))
d.colSpan=4
e.allowTransparency=true
e.src="imsg.php?msgid="+i
ifs[i]=e
o.d=r
o.r=1}
}
return false}