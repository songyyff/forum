
dels=alts=0
function clickdel(d){
dels+=d.checked?1:-1;
var a=d.parentNode.parentNode.childNodes[4].lastChild;
a.disabled=d.checked;
}

function clickalter(a){
alts+=a.checked?1:-1;
var d=a.parentNode.parentNode.firstChild.lastChild;
d.disabled=a.checked;
(d=a.parentNode.parentNode.childNodes[3])
if(a.checked){
d.d=i=d.firstChild
d.removeChild(i)
A(d,o=C('input'))
o.type="text"
o.className="inputclass"
o.name="comm[]"
o.value=i.data
o.maxLength=500
o.style.width=d.clientWidth-10
o.focus()
}else{d.innerHTML="";A(d,d.d)}
}

function submitform(){
if(!(alts|dels)){alert("没有任何需要提交的修改");return}
if(dels)if(!confirm("您选择了删除好友，确定要提交吗？"))return
o=G("mainform")
o.action="myself.php?type=1&page="+currentpage
o.submit()
}
