var havetime=6;
function myclock(){
var re,nowtime;
if(havetime==0){
	window.history.go(-2);
}else{
	havetime--;
	G("wittingtimespan").innerHTML=havetime;
	setTimeout('myclock()',1000);
}
} 
function userreturn(){
	history.go(-2);
}
myclock();