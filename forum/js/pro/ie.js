var subdivcontent=new Array();
function mainclick(mainnum){
	var sbobj=G("subdiv"+mainnum);
	var spobj=G("expandspan"+mainnum);
	if(sbobj.innerHTML==""){
		sbobj.innerHTML=subdivcontent[mainnum];
		spobj.innerHTML="-"
	} else {
		if(subdivcontent[mainnum]==null) subdivcontent[mainnum]=sbobj.innerHTML;
		sbobj.innerHTML="";
		spobj.innerHTML="+";
	}
}
var savedbgcolor='';
function changebgcolor(thisobj){
	if(savedbgcolor=='') {
		savedbgcolor=thisobj.style.backgroundColor;
		thisobj.style.backgroundColor='#f7f7f7';
	}
}