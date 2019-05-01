
//string funcitons

function rtrim(s){return s.replace(/(\s*$)/g,"")}
function ltrim(s){return s.replace(/(^\s*)/g,"")}
function trim(s){return s.replace(/(^\s*)|(\s*$)/g,"")}
function isnumberstr(s){return /[^0-9,]/.test(s);}
function isnumber(s){return !/\D/.test(s);}
function haveillegalchar(s){return />|<|\s|"/.test(s);}
function rplessbiger(s){return s.replace(/<|>/g,function(s){return s=='>'?"&gt;":"&lt;";})}
function rpbigerless(s){return s.replace(/&lt;|&gt;/g,function(s){return s=="&lt;"?"<":">"})}
function rpspc(s){return s.replace(/&|<|>|"/g,function(s){return s=='&'?"&amp;":(s=='<'?"&lt;":(s=='>'?"&gt;":"&quot;"))})}
function fquot(s){return s.replace(/"/g,"&quot;")}

function isnum(s){
if(s.substr(0,1)=="-"){s=s.substr(1,s.length);if(s.length==0)return 0}
if(isnumber(s))return 1
return 0
}

function isnummm(str,max,min){
var n,r=1
if(isnum(str)){
n=parseInt(str,10)
if(n<min||n>max)r=0
}else r=0
return r
}

function isemail(s){
var r=/(@[^@]*@)|([\s\<\>]+)/.exec(s)
if(r)return 0
r=/(.+)@(.+)\.(.+)/.exec(s)
if(r)return 1
return 0
}

function isusername(s){
return !/[\s\~\!\@\#\$\%\^\&\*\(\)\+\|\\\=\-\`\,\/\;\'\[\]\{\}\"\:\?\>\<]/.test(s)
}

function isusernames(s){
return !/[\s\~\!\@\#\$\%\^\&\*\(\)\+\|\\\=\-\`\/\;\'\[\]\{\}\"\:\?\>\<]/.test(s)
}

function isdate(s){
s=trim(s)
if(s.length!=10)return 0
var y,m,d,v,x=/(\d{4})-(\d{2})-(\d{2})/.exec(s)
if(x){
var v=new Date(y=parseInt(x[1]),m=parseInt(x[2],10),d=parseInt(x[3],10))
if(v.getFullYear()==y&&v.getMonth()==m&&v.getDate()==d)return 1
}
return 0
}

function istime(a){
a=trim(a)
if(a.length!=8)return 0
var t=/(\d{2}):(\d{2}):(\d{2})/.exec(a),h=parseInt(t[1],10),m=parseInt(t[2],10),s=parseInt(t[3],10)
if(t)if(h>=0&&h<24&&m>=0&&m<60&&s>=0&&s<60)return 1
return 0
}

function isdatetime(s){
s=trim(s)
if(s.length!=19)return 0
var m=/(.*) (.*)/.exec(s)
if(m)if(isdate(m[1])&&istime(m[2]))return 1
return 0
}