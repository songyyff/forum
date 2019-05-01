function ckren(o){
	var n,v=o.value,t=G('ntd'+v);
	if(o.checked){
		n=(v>>4==2?t.childNodes[0].innerHTML:t.innerHTML).replace(/&lt;|&gt;/g,function(s){return s=="&lt;"?"<":">"});
		t.innerHTML="<input type=text id=nm"+v+" name=nm"+v+">";
		t=G('nm'+v);
		t.value=n;
		t.focus();
	}else{
		n=G('nm'+v).value.replace(/<|>/g,function(s){return s=='>'?"&gt;":"&lt;";});
		t.innerHTML=(v>>4==2?"<font class=\"warningc\">"+n+"</font>":n);
	}
}
function ckdel(o){
var s=o.checked,v=o.value,n=G('rn'+v);
G('rc'+v).disabled=s;
G('cek'+v).disabled=s;
n.disabled=s;
if(n.checked)G('nm'+v).disabled=s;
}
function submitform(){
	return true;
}
