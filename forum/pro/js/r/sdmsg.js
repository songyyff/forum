
_em.set()

function clickallfriend(){
	var ischecked=G("allfriend").checked;
	for(i=0; i<countfriendnum; i++)G("fird"+i).checked=ischecked;
}
function clickfriend(num){
	if(!G("fird"+num).checked)G("allfriend").checked=false;
}

//调整回复
o=G("replaycontent")
o.style.width=screen.width-(IE?507:522)
o.style.height=220;
ot=G("replaytitle")
ot.style.width=screen.width-(IE?507:522)

function smsg_sendmsg(){
if(!(ot.value=trim(ot.value)).length){alert("标题不能为空！");ot.focus();return}
G("msgform").submit()
}
