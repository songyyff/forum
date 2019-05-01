var waittingtime=11;
function userwitting(){
	if(waittingtime-- >0){
		G("wittingtimespan").innerHTML= waittingtime;
		setTimeout(userwitting,1000);
	} else history.go(-3);
}
function userreturn(){
	history.go(-3);
}
function f_onload(){
	userwitting();
}
