//外部变量---------------------
//isFireFox   pageStyle
//媒体数据---------------------
function tagNCls(a3,n3,c3){
this.a=a3;
this.n=n3;
this.c=c3;
}
var tagNodes=new Array();
//图象大小调整函数---------------------
function tagImgLoad(o,w){
with(o){var rw=width;
title="图片尺寸："+rw+","+height+(rw>w?"；显示尺寸："+(width=w)+","+height+"；缩放："+Math.floor(w*100/rw):"；缩放：100")+"%";}
o.onload=null;
}

function toplay(){}
//替换类和辅助函数----------------------
function tagcls(tname,vb,ve){
	this.name=tname;
	this.b=vb;
	this.l=ve;
	this.c=new Array();
}
function TagToStrCls(vMaxImgWidth,SavedTags){
this.maximgwidth=vMaxImgWidth;
this.savedtags=SavedTags;
this.clear=function(){ delete this.savedtags; this.resultstr="";}
this.isatag=function(tname){var i,tagn=tname.toLowerCase();for(i=0;i<this.savedtags.length;i++)if(tagn==this.savedtags[i])return true; return false;}
this.tagCount=0;
this.tagMaxCount=100;
this.type=0;
this.tagtotree=function(){
var tagstack=new Array(),
tname="",
tbegin=0,
begin=0,
intaged=false,
i,pn;
tagstack.push(new tagcls("",0,0));
for(i=0;i< this.restr.length;i++){
	switch(this.restr.charCodeAt(i)){
	case 91: //[ 还需要考虑转义非tag,显示时候也必须考虑
	if(i==0||this.restr.charAt(i-1)!='\\') {
		intaged=true;
		tbegin=i+1;
	}
	break;
	case 93: // ]
	if(intaged&&i-tbegin<10){ 
		tname=this.restr.substr(tbegin,i-tbegin);
		if(this.isatag(tname.charCodeAt(0)==47?tname.substr(1,tname.length):tname)){
			if(tname.charCodeAt(0)==47){
				if(tagstack[tagstack.length-1].name==tname.substr(1,tname.length).toLowerCase()){
					//成对出现
					if(i-tname.length-1>begin)with(tagstack[tagstack.length-1]){
						c.push(new tagcls("str",begin,i-tname.length-1));
						if(name!="rpc"&&name!="")this.tagCount++;
					}
					pn=tagstack.pop();
					tagstack[tagstack.length-1].c.push(pn);
					begin=i+1;
				}
			}else{
				if(i-tname.length-1>begin)with(tagstack[tagstack.length-1]){
				c.push(new tagcls("str",begin,i-tname.length-1));
				if(name!="rpc"&&name!="")this.tagCount++;
				}
				if(this.tagCount!=this.tagMaxCount){
				tagstack.push(new tagcls(tname.toLowerCase(),i,i));
				begin=i+1;
				}else begin=i-tname.length-1;
			}
			if(this.tagCount==this.tagMaxCount)i=this.restr.length;
		}
	}
	intaged=false; 
	break; 
	}
}
if(i>begin&&this.tagCount!=this.tagMaxCount)tagstack[tagstack.length-1].c.push(new tagcls("str",begin,i)); //alert(tagstack[tagstack.length-1].name+begin+":"+i);}
while(tagstack.length>1){
	pn=tagstack.pop();
	tagstack[tagstack.length-1].c.push(pn);
}
if(i>begin&&this.tagCount==this.tagMaxCount)tagstack[0].c.push(new tagcls("str",begin,i));
return tagstack.pop();
} //end func
this.resultstr="";
this.restr="";
this.syb="[";
this.sye="]";
this.tagStr="";	//当前tag内容字符串
this.rpccon=0;  //回复区计数器
this.surl=""; //地址转码结果
this.deurl=function(){
	var b=0,c;
	this.surl=""; 
	for(i=0;i<this.tagStr.length;i++){
		if((c=this.tagStr.charAt(i))=='*')if((c=this.tagStr.charAt(i+1))=='*'||c==',')i++;else{b=1;break;}else if(c==','){i++;break;}
		this.surl+=c;
	}
	if(b)if((b=this.tagStr.indexOf(",",0))==-1){this.surl=this.tagStr;i=this.surl.length;}else{this.surl=this.tagStr.substr(0,b);i=b+1;	}
	return i;
}

this.buildresult=function(Node){
var ts,pi=0,p1,p2,n1,n2;
switch(Node.name){
case "rpc":this.resultstr+=this.syb+(Node.rpcn=++this.rpccon)+" - &nbsp; ";break;
case "b":case "i":case "u":this.resultstr+="<"+Node.name+">";break;
case "p":ts="";with(Node.c[0])if(Node.c.length&&this.restr.charAt(b+1)==',')switch(this.restr.charAt(b)){case 'L':ts="left";b+=2;break;	case 'C':ts="center";b+=2;break;case 'R':ts="right";b+=2;break;	default:ts="left";	}
	this.resultstr+="<p align="+ts+">";break;
}
for(var i=0;i<Node.c.length;i++){
with(Node.c[i]){
//alert(name + ":" + b + ":" + l);
	if(name=="str"){
		switch(Node.name){
		case "url":
			this.tagStr=this.restr.substr(b,l-b);
			pi=this.deurl();
			if(this.isScript())this.resultstr+=this.syb+"连接地址不允许使用脚本："+this.tagStr+this.sye;else this.resultstr+=this.syb+"<a class=goldlink href=\""+encodeURI(this.surl)+"\">"+(pi<l-b?this.tagStr.substr(pi,this.tagStr.length):this.surl)+"</a>"+this.sye;
		break;
		case "img":
			this.tagStr=this.restr.substr(b,l-b);
			pi=this.deurl();
			if(this.isScript())this.resultstr+=this.syb+"图片地址不允许使用脚本："+this.tagStr+this.sye;else this.resultstr+="<img onload=\"tag"+(this.type?"A":"")+"ImgLoad(this,"+this.maximgwidth+")\" src=\""+encodeURI(this.surl)+"\" />"+(pi<l-b?"<br>"+this.syb+this.tagStr.substr(pi,this.tagStr.length)+this.sye:"");
			break;
		case "em":
			this.resultstr+="<img src=\"../icons/em/"+this.restr.substr(b,l-b)+"\" />";
			break;
		case "email":
			this.resultstr+=this.syb+"<a class=goldlink href=\"mailto:"+encodeURI(this.restr.substr(b,l-b))+"\">"+this.restr.substr(b,l-b)+"</a>"+this.sye;
			break;
		case "user":
			pi=this.restr.indexOf(",",b);
			if(pi<l&&pi!=-1)
			this.resultstr+=this.syb+"<a class=goldlink href=\"../pro/userinfo.php?userid="+this.restr.substr(b,pi-b)+"\">"+this.restr.substr(pi+1,l-pi-1)+"</a>"+this.sye;
			else this.resultstr+=this.syb+this.restr.substr(b,l-b)+this.sye;
			break;
		case "code":
			this.resultstr+="<table width=100% border=0 cellpadding=0 cellspacing=0><tr class=bar3><TD class=pdf>&nbsp;代码</TD></tr><TR><TD class=bd1><pre class=pd1>"+this.restr.substr(b,l-b)+"</pre></TD></TR></table>";
			break;
		case "mdi":
			p2=true;
		case "mp3":
			this.tagStr=this.restr.substr(b,l-b);
			pi=this.deurl();
			if(this.isScript()){this.resultstr+=this.syb+"媒体地址不允许使用脚本："+this.tagStr+this.sye;break;}
			n2=tagNodes.length;
			n1=new tagNCls("","","");
			tagNodes[n2]=n1;
			n1.a=encodeURI(this.surl);
			if(pi<l-b){
				p1=this.tagStr.indexOf("com=",pi);
				if(p1>0){
					n1.n=this.tagStr.substr(pi,p1-pi);
					n1.c=this.tagStr.substr(p1+4,this.tagStr.length);
				}else n1.n=this.tagStr.substr(pi,this.tagStr.length);
			}
			this.resultstr+=this.syb+"播放"+(p2?"媒体":"歌曲")+"：<a class=goldlink href=\"javascript:tag"+(p2?"PlayMedia":"SoundBox")+"("+n2+")\" title=\""+n1.a+"\">"+(n1.n.length>0?n1.n:n1.a)+"</a>"+this.sye+(n1.c.length>0?"<br>"+(p2?"说明":"歌词")+"：<br>"+n1.c:"");
			p2=false;
		break;
		case "atimg":
			p1=parseInt(this.restr.substr(b,l-b));
			this.delAttach(p1);
			this.resultstr+="<img onload=\"tagImgLoad(this,"+this.maximgwidth+")\" src=\"../pro/atimg.php?id="+p1+"\" />";
		break;
		case "atmda":
			p1=parseInt(this.restr.substr(b,l-b));
			this.delAttach(p1);
			this.resultstr+=this.syb+"<a class=goldlink href=\"javascript:openAudio("+p1+")\">播放音频附件</a> <a class=goldlink href=\"../pro/attach.php?id="+p1+"\">下载</a>"+this.sye;
		break;
		case "atmdv":
			p1=parseInt(this.restr.substr(b,l-b));
			this.delAttach(p1);
			this.resultstr+=this.syb+"<a class=goldlink href=\"javascript:openVideo("+p1+")\">播放视频附件</a> <a class=goldlink href=\"../pro/attach.php?id="+p1+"\">下载</a>"+this.sye;
		break;
		case "atnom":
			p1=parseInt(this.restr.substr(b,l-b));
			this.delAttach(p1);
			this.resultstr+=this.syb+"<a class=goldlink href=\"../pro/attach.php?id="+p1+"\">下载附件</a>"+this.sye;
		break;
		case "rps":
			p1=this.restr.indexOf(",",b);
			if(p1<l&&p1!=-1){
				p2=this.restr.indexOf(",",p1+1);
				if(p2<l&&p2!=-1){
					n1=this.restr.substr(b,p1-b);
					n2=this.restr.substr(p1+1,p2-p1-1);
					this.resultstr+=this.syb+"<a align=right class=goldlink href=\"userinfo.php?userid="+n2+"\">"+this.restr.substr(p2+1,l-p2-1)+"</a>"+this.sye+"<a align=right class=goldlink href=\"javascript:tosite("+n1+")\">说</a> ： ";
					break;
			}}
			this.resultstr+=this.syb+"回复位置不完整 ："+this.restr.substr(b,l-b)+this.sye;
		break;
		case "rpc":
		default:this.resultstr+=this.restr.substr(b,l-b);
		}
	}
	if(c.length>0) this.buildresult(Node.c[i]);
}//with
}//for
switch(Node.name){
case "rpc":
	this.resultstr+="<div> --- "+Node.rpcn+this.sye+"</div>";
case "b":case "i":case "u":case "p":
	this.resultstr+="</"+Node.name+">";
}
while(Node.c.length>0) { var n=Node.c.pop(); delete n; }
}//func
this.ats={n:0} //附件序列
this.delAttach=function(id){
var p2=this.ats,p2,n1;
while(p2.n){if(p2.n.c[0]==id){n1=p2.n;p2.n=n1.n;delete n1.c;delete n1;this.ats.z--;}else p2=p2.n;}
}

this.isScript=function(){var s,i;return (i=this.surl.indexOf(":",0))>0&&((s=this.surl.substr(0,i).replace(/(^\s*)|(\s*$)/g,"").toLowerCase())=="javascript"||s=="vbscript")}

this.msgtagtostr=function(str){
	this.resultstr="";
	this.restr=str;
	var n=this.tagtotree();
	this.buildresult(n);
	delete n;
}
this.notetagtostr=function(str){
	this.resultstr="";
	this.rpccon=0;
	this.restr=str;
	var n=this.tagtotree();
	this.buildresult(n);
	delete n;
}
this.anchortagtostr=function(str){
	this.resultstr="";
	this.restr=str;
	var n=this.tagtotree();
	this.buildresult(n);
	delete n;
}
this.emailtagtostr=function(str){
	this.resultstr="";
	this.restr=str;
	var n=this.tagtotree();
	this.buildresult(n);
	delete n;
	return this.resultstr;
}

} // end TagToStrCls

function getanchortagcls(W){var x=new TagToStrCls(W,new Array("img","url","user"));x.type=1;return x}
function getmsgtagcls(W){return new TagToStrCls(W,new Array("img","url","em","user"));}
function getemailtagcls(W){return new TagToStrCls(W,new Array("img","url","email"));}
function getnotetagcls(W){return new TagToStrCls(W,new Array("b","i","u","p","img","mdi","url","em","user","rps","rpc","code","atimg","atmda","atmdv","atnom","mp3","email"));}