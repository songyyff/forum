flststr="";
linetree=new Array();
fsize=7;

function getsitebyid(id){
var i,len=flist.length/fsize;
for(i=0;i<len;i++)if(id==flist[i*fsize+2])return i;
return 0;
}

cursite=T?getsitebyid(T):0

function getsitebypid(pid,ref){
var i,len=flist.length/fsize;
for(i=0;i<len;i++)if(pid==flist[i*fsize])return i;
return -1;
}
function buildtree(site,level){
var pid,i;
if(flist.length>0&&site>=0){
	level++;
	pid=flist[site*fsize];
	do{
		isend=pid!=flist[(site+1)*fsize]
		flststr+="<table border=0 cellpadding=0 cellspacing=0><tr height=21 align=right>";
		for(i=1;i<level;i++){
			flststr+="<td width=17>"+(linetree[i]?"":"<img src=\"../images/tm.gif\" />")+"</td>";
		}
		flststr+="<td width=17><img src=\"../images/t"+(isend?"l":"mm")+".gif\" /></td><td width=1fsize><input type=radio name=selfn value="+flist[site*fsize+2]+" onclick=\"ckforum(this)\""+(cursite<0&&site==0?" checked":flist[site*fsize+2]==flist[cursite*fsize+2]?" checked":"")+"></td><td>"+(flist[site*fsize+6]=='E'?flist[site*fsize+6]:"<font color=red><b>"+flist[site*fsize+6]+"</b></font> ")+" <b>"+flist[site*fsize+5]+"</b> "+flist[site*fsize+3]+" "+flist[site*fsize+4]+"</td></tr></table>";
		csite=getsitebypid(flist[site*fsize+2],site);
		linetree[level]=isend;
		buildtree(csite,level);
		site++;
	}while(pid==flist[site*fsize])
}
}
function ishavechild(site){return getsitebypid(flist[site*fsize+2],0)>=0}
function istop(site){return flist[site*fsize]!=flist[(site-1)*fsize]}
function isbottom(site){return flist[site*fsize]!=flist[(site+1)*fsize]}
function ishaveparent(site){return flist[site*fsize]!=0}
function G(v){return document.getElementById(v);}
buildtree(0,0);
obj=G('fmlistdiv')
obj.style.height="270"
obj.innerHTML="&nbsp;根论坛<br>"+flststr

function ckforum(o){
cursite=getsitebyid(o.value);
if(cursite>=0){
G('fname').value=flist[cursite*fsize+3];
G('fcom').value=G('gc'+flist[cursite*fsize+2]).innerHTML;
G('fid').value=flist[cursite*fsize+2];
G('stat').value=flist[cursite*fsize+6];
G('level').value=flist[cursite*fsize+5];
}
}
function movesite(v){
if(cursite>=0)switch(v){
case 0:if(!istop(cursite))goto(v);else alert("已经在顶部，不可移动");break;
case 1:if(ishaveparent(cursite))goto(v);else alert("没有父接点，不可移动");break;
case 2:if(!isbottom(cursite))goto(v);else alert("已经在最下部，不可移动");break;
case 3:if(!istop(cursite)){
	goto(v);
	}else alert("必须处于兄弟论坛第二位以下，不可移动");
	break;
}else alert("必须选择一个论坛");
}
function goto(v){document.location.href="?type="+vtype+"&move="+v+"&idm="+G('fid').value}
function BT(){location.href="?type="+vtype+"&BT=1"}

if(flist.length){
//if(cursite<0)cursite=0;
with(G('fname')){
value=flist[cursite*fsize+3]
style.width=screen.width-530
}
with(G('fcom')){
innerHTML=G('gc'+flist[cursite*fsize+2]).innerHTML
style.width=screen.width-530
}
G('stat').value=flist[cursite*fsize+6];
G('level').value=flist[cursite*fsize+5];
G('fid').value=flist[cursite*fsize+2];
}