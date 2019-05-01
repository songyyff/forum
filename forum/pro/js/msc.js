var IE=navigator.appName.indexOf("Microsoft")!=-1,
iDebug=0,
mdiv,cdiv,mtable,stable,mstable,slen,sinput,pflash,
songs=[],
headSongp=endSongp=curSongp=null,
icurLoop=iselSong=-1,isongCount=iselInterval=iselDelay=0,iloopMode=1,
pageC="<div class=hfdiv id=W></div>\
<table cellpadding=0 cellspacing=0 width=100%>\
	<tr class=bar3><td align=center height=35><b>音 乐 盒</b>\
	<tr><td>\
<table>\
<tr>\
<td valign=top width=200>\
	<table cellpadding=0 cellspacing=0 width=100%>\
		<tr>\
			<td>曲目表</a>\
			<td align=right><a href=javascript:songDel()>删除</a>&nbsp;<a href=javascript:songLoop()>重复</a>&nbsp;<a href=javascript:songUp()>上</a>&nbsp;<a href=javascript:songDown()>下</a>&nbsp;&nbsp;\
	</table>\
	<div id=menudiv style=width:200px;height:400px;OVERFLOW: scroll>\
		<table cellpadding=0 cellspacing=0 id=menut width=100%>\
		<tr><td width=10>\
		<table cellpadding=2 cellspacing=0 width=100%><tbody id=sorts></tbody></table>\
		<td>\
		<table cellpadding=2 cellspacing=0 id=menus width=100%><tr><td align=center>没有曲目</table>\
		</table>\
	</div>\
<td valign=top width=300>\
<table width=100% cellpadding=0 cellspacing=0>\
	<tr><td>播放器<td align=right><a href=javascript:; onclick=changeMode(this)>连续</a>&nbsp;\
</table>\
<table cellpadding=0 cellspacing=0>\
	<tr><td height=90 align=center id=playertd>\
	<tr><td height=100%>\
		<div id=commdiv style=padding:3px;width:302px;height:308px;OVERFLOW:scroll></div>\
</table>\
</table>\
</table>"
with(document){
write("<html>\
<head>\
<title>音乐盒</title>\
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\
<link rel=stylesheet type=text/css href=../theme/"+pageStyle+"/def.css>\
</head><body onunload=pageStyle=0 style=visibility:hidden>")
if(!IE)write(pageC)
write("</body></html>")
}
function setPlayer(){
if(IE)document.body.innerHTML=pageC
G("playertd").innerHTML=IE?"<object id=playerflash classid=clsid:d27cdb6e-ae6d-11cf-96b8-444553540000 codebase=http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0 width=300 height=90 border=1 align=middle><param name=allowScriptAccess value=sameDomain /><param name=movie value=../images/sound.swf /><param name=quality value=high /><param name=bgColor value=#ffffff /></object>":
"<embed id=playerflash src=../images/sound.swf quality=high bgcolor=#ffffff width=300 height=90 border=1 name=sound align=middle allowScriptAccess=sameDomain \
	type=application/x-shockwave-flash pluginspage=http://www.macromedia.com/go/getflashplayer />"
document.body.style.visibility="visible"
}
setTimeout("setPlayer()",1000)

function G(i){return document.getElementById(i)}

function D(s){
	W.style.visibility="visible"
	W.innerHTML+=iDebug+++":"+s.replace(/</g,"&lt;")+"<br>"
}

function SongCls(a,r,n,c,p,item){
	this.add=a
	this.name=n
	this.loop=r
	this.comm=c
	this.p=p
	this.row=item
}

function SongPCls(k,p,n){
	this.i=k
	this.prev=p
	this.next=n
}

function changeMode(o){
	if(++iloopMode>2)iloopMode=0
	o.innerHTML=iloopMode>0?(iloopMode==1?"连续":"循环"):"单曲"
}

function songLoop(){
	if(canTEdit())return
	
	if(iselInterval!=0)iselDelay=30
	
	with(songs[iselSong]){
		loop=loop<5?++loop:0
		icurLoop=loop
		row.childNodes[0].innerHTML=loop==1?"":loop
	}
}

function canTEdit(){
	if(isongCount==0){
		alert("没有曲目可编辑  ")
		return true
	}
	if(iselSong<0){
		alert("您需要首先选取曲目  ")
		return true
	}
	return false
}

function songUp(){
	if(canTEdit())return

	if(iselInterval!=0)iselDelay=30

	if(iselSong==headSongp.i)alert("曲目已经位移到顶部了！  ")
	else{
		var p=songs[iselSong].p,pp=p.prev,
		pn=songs[pp.i].row
		pn.parentNode.insertBefore(songs[iselSong].row,pn)

		if(pp.prev!=null)pp.prev.next=p
		if(p.next!=null)p.next.prev=pp
		p.prev=pp.prev
		pp.prev=p
		pp.next=p.next
		p.next=pp
		if(p==endSongp)endSongp=pp
		if(pp==headSongp)headSongp=p
	}
}

function songDown(){
	if(canTEdit())return
	
	if(iselInterval!=0)iselDelay=30
	
	if(iselSong==endSongp.i)alert("曲目已经位移到底部了！  ")
	else{
		var p=songs[iselSong].p,pn=p.next,
		n=songs[iselSong].row
		with(songs[pn.i].row.parentNode){
			if(pn.next==null)appendChild(n);else insertBefore(n,songs[pn.next.i].row)
		}

		if(p.prev!=null)p.prev.next=pn
		if(pn.next!=null)pn.next.prev=p
		pn.prev=p.prev
		p.prev=pn
		p.next=pn.next
		pn.next=p
		if(pn==endSongp)endSongp=p
		if(p==headSongp)headSongp=pn
	}
}

function songDel(){
	if(canTEdit())return
	if(iselInterval!=0){
		clearInterval(iselInterval)
		iselInterval=0
		iselDelay=0
	}
	var o=songs[iselSong].row,
	p=songs[iselSong].p
	o.parentNode.removeChild(o)
	delete songs[iselSong]
	songs[iselSong]=null
	iselSong=-1
	
	if(p.prev==null)headSongp.next=p.next;else p.prev.next=p.next
	if(p.next==null)endSongp=p.prev;else p.next.prev=p.reve
	
	if(p==curSongp){
		curSongp=p.next
		switch(iloopMode){
		case 0:
		case 1:if(curSongp==null)break
		default:
			if(curSongp==null)curSongp=headSongp;  //this is end of list stop Play song or repeat
			if(curSongp!=null)PlaySong(curSongp.i)
		}
	}
	
	stable.removeChild(stable.lastChild)
	
	if(--isongCount==0){
		trnew = mstable.insertRow(-1)
		td1 = trnew.insertCell(-1)
		td1.style.width="100%"
		td1.align="center"
		td1.innerHTML="没有曲目"
	}
}

function showLoop(n,i){
	songs[n].row.childNodes[0].innerHTML=i==1?"":i
}
function PlaySong(n){
	if(curSongp!=null&&curSongp.i!=n){
		with(songs[curSongp.i]){ 
			if(icurLoop!=loop)showLoop(curSongp.i,loop)
			with(row.childNodes[0]){if(bgColor!="#0000bb")bgColor="";}
		}
	}
	icurLoop=songs[n].loop
	realPlaySong(n)
}
function realPlaySong(n){
	icurLoop=songs[n].loop
	with(songs[n]){
		row.childNodes[0].bgColor="#ff0000"
		curSongp=p
		cdiv.innerHTML=comm.replace(/</g,"&lt;")+"<br><br>标题: "+name.replace(/</g,"&lt;")+"<br>地址: "+add.replace(/</g,"&lt;")
		pflash.PlaySong(add)
	}
}

function javaNextSong(){
	switch(icurLoop){
		case 1:setTimeout("javaNext(false)",1000);break
		default:showLoop(curSongp.i,--icurLoop)
		case 0:pflash.rePlay()
	}
}

function javaNext(b){
	var p,c
	if(curSongp!=null){
		with(songs[curSongp.i]){
			if(icurLoop!=loop)showLoop(curSongp.i,loop)
			row.childNodes[0].bgColor=b?"#0000ff":""
		}
		switch(iloopMode){
		case 0:return
		case 1:if((p=curSongp.next)==null)return
			break
		default:
			if((p=curSongp.next)==null)p=headSongp
		}
		c=songs[p.i].row
		if(c.offsetHeight*2+c.offsetTop>mdiv.scrollTop+mdiv.offsetHeight||c.offsetTop<mdiv.scrollTop){
			mdiv.scrollTop=c.offsetTop-c.offsetHeight
			mdiv.scrollLeft=1
		}
		realPlaySong(p.i)
	}
}

function javaPlayFailed(){
	setTimeout("javaNext(true)",1000)
}

function clearColor(){
	if(iselSong>=0){
		if(iselDelay>0){
//			D(iselDelay)
			if(iselDelay--==1){
				clearInterval(iselInterval)
				iselInterval=0
				songs[iselSong].row.bgColor=""
			} 
		}
	}
}

function selectSong(n){
	if(iselSong>=0)songs[iselSong].row.bgColor=""
	iselSong=n
	songs[n].row.bgColor="#b0c4de"
	iselDelay=30
	if(iselInterval==0)iselInterval=setInterval("clearColor()",1000)
}

function newSong(a,r,n,c){
	var i=songs.length
	if(!isongCount)mstable.removeChild(mstable.childNodes[0])
	tempp=new SongPCls(i,endSongp,null)
	if(endSongp!=null)endSongp.next=tempp
	endSongp=tempp
	if(headSongp==null)headSongp=tempp
	if(curSongp==null)curSongp=tempp
	trnew = mstable.insertRow(-1)
	if(IE)trnew.attachEvent("onclick",new Function("selectSong("+i+")"))
	else trnew.setAttribute("onclick","selectSong("+i+")")
	songs[i]=new SongCls(a,r,n,c,tempp,trnew);//replaceRN(n),
	td1 = trnew.insertCell(-1)
	td1.style.width = 7
	td1.height=21
	td1.innerHTML="&nbsp;"
	//D(slen.scrollWidth)
	td1=trnew.insertCell(-1)
	if(IE)td1.style.whiteSpace="nowrap"
	else td1.setAttribute("NOWRAP","true")
	td1.innerHTML="<a href=\"javascript:PlaySong("+i+")\">"+songs[i].name.replace(/</g,"&lt;")+"</a>"
	trnew.title=a
	isongCount++
	trnew=stable.insertRow(-1)
	td1=trnew.insertCell(-1)
	td1.height=21
	td1.align="right"
	if(IE)td1.style.whiteSpace="nowrap"
	else td1.setAttribute("NOWRAP","true")
	td1.innerHTML=isongCount+"."
	//if(iloopMode==0)
	PlaySong(i)
}
function replaceRN(s){
var k=0,i,rest=""
for(i=0;i<s.length;i++){
	switch(s.charCodeAt(i)){
	case 9:
	case 10:
	case 32:
	case 13:rest+=s.substr(k,i-k)+"&nbsp;";k=i+1;break
	case 60:rest+=s.substr(k,i-k)+"&lt;";k=i+1;break
	case 62:rest+=s.substr(k,i-k)+"&gt;";k=i+1;break
	}
}
return k==0?s:rest+s.substr(k,i-k)
}

function flashMP3Ready(){
mdiv=G("menudiv")
cdiv=G("commdiv")
mtable=G("menut")
stable=G("sorts")
mstable=G("menus")
slen=G("slen1")
sinput=G("sinput1")
if(!IE)with(cdiv.style){height=304;width=295}
pflash=G('playerflash')
newS(window.opener.curSong)
PlaySong(0)
}

function newS(a){newSong(a.title,1,getText(a),"")}

function getText(o){
function g(o){var n,i,a;if((n=o.childNodes).length)for(i=0;a=n[i++];)if(a.nodeType==3)s+=a.data;else g(a)}
var s="",p=o.parentNode;if(p.parentNode.id=="attachs")s=p.childNodes[2].data;else g(o)
return (s?s:o.href).replace(/</g,"&lt;")}