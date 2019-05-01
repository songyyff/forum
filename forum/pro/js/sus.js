
/* 
build survey table
*/

function buildsurvey(){
var q,a=d=0,i,k,z,n,w=screen.width-500,l=suvdbs.length-1,s=[]
for(i=0;i<l;i++){
u=suvdbs[i];q=suvdbis[i];z=q.length-1;
if(u[5]>z/3)u[5]=z/3-1;
if(u[6]&&u[5]>u[6])u[6]=u[5];
s[s.length]="<p><b id=survey"+i+">"+(i+1)+" . 时间:"+u[8]+" -"+(u[5]?" Min:"+u[5]+";Max:"+(u[6]?u[6]:"~"):"")+" 投票人数:"+u[2]+" - 总票数:"+u[3]+"</b><pre>"+u[9]+"</pre><ul type=1>";
d|=u[1]&2;
k=0;
n=u[4]?w/u[4]:0;
if(u[1]&2)s[s.length]="<input type=hidden name=suvid[] value="+u[0]+">";
while(k<z){
s[s.length]="<li>"+(u[1]&1?"<div class=pdtb1><i style=padding-left:"+(q[k+2]*n)+"px>&nbsp;</i> "+(u[1]&1?" "+q[k+2]+" 票 ("+(u[3]?(q[k+2]/u[3]*100).toString().replace(/(\d)(\.\d{0,2})(\d*)/,"$1$2"):0)+"%) ":"")+"</div>":"")+(u[1]&2?"<input type="+(u[5]?"checkbox":"radio")+" name=suvi"+u[0]+"[] value="+q[k]+" onclick=\"selsuv("+a+",this)\">":"")+q[k+1]+"</li>";
k+=3;
}
a++;
u[2]=0; //重置为记票用
s[s.length]="</ul>";
}
return "<div class=suv><p style=border:0>"+(d?"<a href=javascript:; onclick=submitsurvey()>提交调查</a>":"")+"调查<form id=suvform method=POST><input type=hidden name=suv id=suv>"+s.join("")+"</ul></form>"+(d?"<p><a href=javascript:; onclick=submitsurvey()>提交调查</a>&nbsp;":"")+"</div>";
}

G('surveydiv').innerHTML=buildsurvey();

function selsuv(i,o){suvdbs[i][2]+=o.checked?1:-1;}
function scTo(o){for(var y=0;o;y+=o.offsetTop,o=o.offsetParent);scrollTo(0,y-20)}

function submitsurvey(){
if(!uid){alert("对不起，游客不能参与投票。");return}
var s,u,l=suvdbs.length-1;
for(i=0;i<l;i++){
u=suvdbs[i];
if(u[1]&2&&suvdbis[i].length>1){
if(u[5]){
if(u[2]<u[5]||(u[6]&&u[2]>u[6])){
s="至少选择 "+u[5]+" 项"+(u[6]?"，最多选择 "+u[6]+" 项":"")+"。\n\n当前选择了 "+u[2]+" 项。";break;}
}else if(!u[2]){s="还未选择。";break;}
}
}
if(i<l){
scTo(G('survey'+i));alert("[ "+(i+1)+" ] 号调查选择不正确!\n\n"+s);
}else{
G('suv').value=suvdbs[suvdbs.length-1];
G('suvform').submit();
}
}