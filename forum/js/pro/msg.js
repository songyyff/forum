function clickallfriend(){
	var ischecked=G("allfriend").checked;
	for(i=0; i<countfriendnum; i++)G("fird"+i).checked=ischecked;
}
function clickfriend(num){
	if(!G("fird"+num).checked)G("allfriend").checked=false;
}
function f_onload(){
}
