//<script language=javascript>
var savedtags=new Array("img","url","em");
function getamsgtagcls(){return new TagToStrCls(new Array("img","url","em","user"));}
function tagcls(tname,str){
	this.name=tname;
	this.s=str;
	this.c=new Array();
}
function TagToStrCls(SavedTags){
this.savedtags=SavedTags;
this.isatag=function(tname,savedtags){for(var i=0;i<savedtags.length;i++) if(tname.toLowerCase()==savedtags[i])return true; return false;}
this.tagtotree=function(str){
	var tagstack=new Array();
	var tname="";
	var strsub="";
	var intaged=false;
	tagstack.push(new tagcls("root",""));
	for(var i=0;i<str.length;i++){
		switch(str.charCodeAt(i)){
			case 91: // [ 还需要考虑转义非tag,显示时候也必须考虑
				if(i==0||str.substr(i-1,1)!="\\") {
					if(intaged) strsub+="["+tname;
					intaged=true;
					tname="";
				} else if(intaged) tname+="["; else strsub+="[";
			break;
			case 93: // ]
				if(intaged){ 
					if(this.isatag(tname.charCodeAt(0)==47?tname.substr(1,tname.length):tname,this.savedtags)){
						if(tname.charCodeAt(0)==47){
							if(tagstack[tagstack.length-1].name==tname.substr(1,tname.length).toLowerCase()){
								//成对出现
								if(strsub.length>0) { 
									with(tagstack[tagstack.length-1]) c[c.length]=new tagcls("str",strsub);
									strsub="";
								}
								var pn=tagstack.pop();
								with(tagstack[tagstack.length-1]) c[c.length]=pn;
							}else{ //不是个成对tag,当字符处理
								strsub+="["+tname+"]";
							}
						}else { 
							if(strsub.length>0) { 
								with(tagstack[tagstack.length-1]) c[c.length]=new tagcls("str",strsub);
								strsub="";
							}
							tagstack.push(new tagcls(tname.toLowerCase(),"")); 	
						}
					}else strsub+="["+tname+"]";
					intaged=false; 
				} else strsub+=str.substr(i,1);
			break; 
			default: 
				if(intaged) tname+=str.substr(i,1);
				else strsub+=str.substr(i,1);
		}
	}
	if(strsub.length>0) with(tagstack[tagstack.length-1]) c[c.length]=new tagcls("str",strsub);
	while(tagstack.length>1){
		var pn=tagstack.pop();
		with(tagstack[tagstack.length-1]) c[c.length]=pn;
	}
	return tagstack.pop();
}
this.resultstr="";
this.buildresult=function(Node){
	var pi=0;
	for(var i=0;i<Node.c.length;i++){
		if(Node.c[i].name=="str"){
			switch(Node.name){
			case "url":
				pi=Node.c[i].s.search(",");
				if(pi>=0)
				this.resultstr+="<a class=goldlink href=\""+Node.c[i].s.substr(0,pi)+"\">"+Node.c[i].s.substr(pi+1,Node.c[i].s.length)+"</a>";
				else this.resultstr+="<a class=goldlink href=\""+Node.c[i].s+"\">"+Node.c[i].s+"</a>";
			break;
			case "img":
				this.resultstr+="<img border=0 src=\""+Node.c[i].s+"\" />";
			break;
			case "em":
				this.resultstr+="<img src=\"../icons/em/"+Node.c[i].s+"\" />";
			break;
			case "user":
				pi=Node.c[i].s.search(",");
				if(pi>=0)
				this.resultstr+="[ <a class=goldlink href=\"../pro/userinfo.php?userid="+Node.c[i].s.substr(0,pi)+"\">"+Node.c[i].s.substr(pi+1,Node.c[i].s.length)+"</a> ]";
				else this.resultstr+="[ "+Node.c[i].s+" ]";
			break;
			default:
				this.resultstr+=this.rpchar(Node.c[i].s);
			}
		}
		if(Node.c[i].c.length>0) this.buildresult(Node.c[i]);
	}
}
this.rpchar=function(str){
	var rest="";
	for(var i=0;i<str.length;i++){
		switch(str.charCodeAt(i)){
			case 32: rest+="&nbsp;";	break;
			case 10: rest+="<br>";		break; //	\n
			case 13: /*rest+="";*/		break; //	\r
			case 60: rest+="&lt;";		break;
			case 62: rest+="&gt;";		break;
			default: rest+=str.substr(i,1);
		}
	}
	return rest;
}
this.tagtostr=function(str){
	this.resultstr="";
	this.buildresult(this.tagtotree(str));
	return this.resultstr;
}
} // end TagToStrCls
//</script>