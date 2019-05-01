/*
mytake.php
*/

DS=AS=0

function del(o){o.nextSibling.disabled=o.checked;DS+=o.checked?1:-1}

function memo(o){
o.previousSibling.disabled=o.checked
AS+=o.checked?1:-1
p=o.parentNode
if(o.checked){
p.appendChild(C('hr'))
p.appendChild(i=C('input'))
i.name='comm[]'
i.maxLength=500
i.style.width=p.clientWidth-20
i.focus()
}else{
p.removeChild(p.lastChild)
p.removeChild(p.lastChild)
}
}

function submitform(){
if(DS&&!confirm("您选择了取消订阅帖子，确定吗？"))return
if(AS||DS){
o=G("mainform")
o.action="?type=0&page="+PGI.p;
o.submit()
}
}