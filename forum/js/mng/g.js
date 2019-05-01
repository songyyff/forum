
function mngi(s){
G('gcomm').disabled=s;
G('gname').disabled=s;
G('gmxtp').disabled=s;
G('gicon').disabled=s;
}

function mngr(s){
//G('gstat').disabled=s;
//G('glevel').disabled=s;
G('gview').disabled=s;
G('uview').disabled=s;
G('unew').disabled=s;
G('urpy').disabled=s;
G('umodify').disabled=s;
}

function mngsu(s){
var obj,od,om;
for(var i=0;i<superus.length;i++) {
	if(superus[i]){
		od=G('sudel'+superus[i]);
		om=G('suum'+superus[i]);
		od.disabled=s;
	}
	if(s){
		if(superus[i]) om.disabled=s;
		setsustat(superus[i],s);
	}else if(superus[i])cksudel(od); else setsustat(0,s);
}
setsustat(0,s);
}

function cksudel(m){
var obj=G('suum'+m.value);
if(m.checked)setsustat(m.value,true);else cksum(obj);
obj.disabled=m.checked;
}

function cksum(m){
setsustat(m.value,!m.checked);
}

function setsustat(i,s){
if(G('suv'+i)==null)return
G('suv'+i).disabled=s;
G('sun'+i).disabled=s;
G('sum'+i).disabled=s;
G('suh'+i).disabled=s;
G('sud'+i).disabled=s;
G('suo'+i).disabled=s;
G('sumu'+i).disabled=s;
G('sudu'+i).disabled=s;
if(!i)G('newsu').disabled=s;
}

function setobjs(){
var objwidth=window.screen.width-30-10-200-100-50;
var obj=G('gcomm');
obj.style.width=objwidth;
obj.style.height=100;
G('gname').style.width=objwidth;
mngi(true);
mngr(true);
mngsu(true);
}
setobjs();

function selgrp(v){
	window.location.href="?type=0&gid="+v;
}

function submitform(){
	obj=G("mainform");
	obj.action="?type=0";
	return true;
}