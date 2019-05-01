
/*
help.php
*/

var helpmenustr="";
var linetree=new Array();
function buildhelpstr(t,i){
return "<div class=O>"+t+"帮助 "+(i==2?"<a class=goldlink href=\"?helpid=4\">用户帮助</a>":(i==1&&ism?"<a class=goldlink href=\"?helpid=44\">管理员帮助</a>":""))+"</div><div id=helpmenudiv class=help>"+helpmenustr+"</div>"
}

function buildmnghelp(){
	helpmenustr="";
	buildtree(n3,0);
	return buildhelpstr("管理员",2);
}
function builduserhelp(){
	helpmenustr="";
	buildtree(n2,0);
	return buildhelpstr("用户",1);
}
function buildguesthelp(){
	helpmenustr="";
	buildtree(n1,0);
	return buildhelpstr("游客",0);
}
function buildtree(pnode,level){
	var len=pnode.c.length;
	level++;
	for(var ni=0;ni<len;ni++){
		var pn=pnode.c[ni];
		helpmenustr += "<table cellpadding=0 cellspacing=0><tr>";
		for(var i=1;i<level;i++){
			helpmenustr+="<td width=13>"+(linetree[i]?"":"<img src=\"../images/tm.gif\" />")+"</td>";
		}
		helpmenustr+="<td width=13><img src=\"../images/t"+(len-1==ni?"l":"mm")+".gif\" /></td><td width=15>"+(pn.c.length?"<a href=\"javascript:clickmc("+pn.id+")\"><img id=img"+pn.id+" border=0 src=\"../images/tc.gif\" /></a>":"<img src=\"../images/th.gif\" />")+"</td><td><a href=\"?helpid="+pn.l+"\">"+pn.t+"</a></td></tr></table>";
		linetree[level]=len-1==ni;
		if(pn.c.length){
			helpmenustr+="<div id=md"+pn.id+">";
			buildtree(pn,level);
			helpmenustr+="</div>";
		}
	}
	return;
}
function clickmc(id){
	obj=G("md"+id);
	imgobj=G("img"+id);
	if(obj.style.height=="") {
		obj.style.height="1px";
		obj.style.position="absolute";
		obj.style.visibility="hidden";
		imgobj.src="../images/ts.gif";
	} else {
		obj.style.height="";
		obj.style.position="static";
		obj.style.visibility="visible";
		imgobj.src="../images/tc.gif";
	}
}