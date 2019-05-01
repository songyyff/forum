package  {
	
	import flash.display.MovieClip;
	
	import flash.net.FileReferenceList;
	import flash.net.FileReference;
	import flash.external.ExternalInterface;
	import flash.net.SharedObject;
	import flash.net.SharedObjectFlushStatus;
    

	public class upload3 extends MovieClip {

		var listener:Object = new Object();
		var files:Array=new Array();
		var listens:Array=new Array();
		var stats:Array=new Array();
		var cells:Array=new Array();
		var inWork:Array=new Array();
		var cI:Number=0;
		var cM:Number=0;
		var Num:Number;
		var workNum:Number=0;
		var sCookie:String;

		
		public function upload3() {
			// constructor code
		}
		ExternalInterface.call("flashload");


ExternalInterface.addCallback("ini", null, ini);
public function ini(n:Number,c:String){Num=n;sCookie=c;

var co:SharedObject;
co=SharedObject.getLocal("a");

ExternalInterface.call("alert",co.data.PHPSESSID);

}

//listener.onSelect = 
public function onS(fileRefList:FileReferenceList) {
    var list:Array = fileRefList.fileList;
    var item:FileReference;
	var d:Date;
	var fI:Number;
	if(Num+files.length+list.length-cI>100)ExternalInterface.call("alert","选取文件数量超过最多附件数量100个的限制。");
	else for(var i:Number = 0; i < list.length; i++){
		item=list[i];
		if(item.size>10000000)ExternalInterface.call("alert",
													 "选取文件 "+item.name+" 大小 "+
													 Math.ceil(item.size/1000000)+
													 "M 超过单个文件 10M 的限制。");
		else{
		files[fI=cI?cells[--cI]:cM++]=item;
		stats[fI]=listens[fI]=0;
		d=item.creationDate;
		ExternalInterface.call("upfileNew",fI,0,item.name,item.size,item.type,
							   d.getFullYear()+"-"+d.getMonth()+"-"+d.getDay()+" "+
							   d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
		}
    }
}

listener.onCancel = function(){
    
}

public function onCancel() {
	ExternalInterface.call("upfileCancel",this.id,0);
}

public function onOpen(file:FileReference){
	ExternalInterface.call("upfileOpen",this.id,0);
}

public function onProgress(file:FileReference, bytesLoaded:Number, bytesTotal:Number){
	ExternalInterface.call("upfileProgress",this.id,0,bytesLoaded,bytesTotal);
}

public function onComplete(file:FileReference){
	stats[this.id]=0;
    ExternalInterface.call("upfileComplete",this.id,0);
}

public function onUploadCompleteData(file:FileReference, data:String){
	ExternalInterface.call("upfileCompleteData",this.id,0,data);
	if(data.charAt(0)>'0'&&data.charAt(0)<':'){
	delete files[this.id];
	files[this.id]=0;
	cells[cP++]=this.id;
	}
	isWorkEnd()
	inWork[this.id]=0;
	Num++;
}

public function onHTTPError(file:FileReference, httpError:Number){
    ExternalInterface.call("upfileError",this.id,0,0,httpError);
	isWorkEnd()
	stats[this.id]=0;
	inWork[this.id]=0;
}

public function onIOError(file:FileReference){
    ExternalInterface.call("upfileError",this.id,0,1);
	isWorkEnd()
	stats[this.id]=0;
	inWork[this.id]=0;
}

public function onSecurityError(file:FileReference, errorString:String){
    ExternalInterface.call("upfileError",this.id,0,2,errorString);
	isWorkEnd()
	inWork[this.id]=0;
	stats[this.id]=0;
}

var fileRef:FileReferenceList = new FileReferenceList();
fileRef.addListener(listener);
myButton.onRelease=function(){
fileRef.browse();
}

ExternalInterface.addCallback("del", null, del);
public function del(i:Number){
	delete files[i];
	files[i]=0;
	cells[cI++]=i;
}

ExternalInterface.addCallback("upload", null, upload);
public function upload(typ:String,id:String,ups:String,n:Number){
	if(ups){delups(typ,id,ups,n);workNum++;}
	var i:Number;
	var s:String;
	for(i=0;i<files.length;i++)if(!inWork[i]&&files[i]){
		stats[i]=1;
		inWork[i]=1;
		workNum++;
		if(!listens[i]){
		var newlisten:Object = new Object();
		newlisten.id=i;
		newlisten.onSecurityError = onSecurityError;
		newlisten.onIOError = onIOError;
		newlisten.onHTTPError = onHTTPError;
		newlisten.onComplete = onComplete;
		newlisten.onProgress = onProgress;
		newlisten.onOpen = onOpen;
		newlisten.onCancel = onCancel;
		newlisten.onUploadCompleteData = onUploadCompleteData;
		files[i].addListener(newlisten);
		listens[i]=1;
		}
		//files[i].cancel(); PHPSESSID="+PHPSESSID+"&
		files[i].upload(s="../upload.php?type="+typ+"&id="+id+"&a"+sCookie);
	}
	if(workNum)setWorkstatus();
}

public function setWorkstatus(){
	//ExternalInterface.call("wins",0,workNum);
}
public function isWorkEnd(){
	if(!--workNum)setWorkstatus();
}

ExternalInterface.addCallback("cancelUp",null,function(i:Number){
							  if(stats[i]){
								  files[i].cancel();
								  stats[i]=0;
								  inWork[i]=0;
								  isWorkEnd();
							  }});

var myLoadVars:LoadVars = new LoadVars();
var delN:Number;
var httpN:Number;

myLoadVars.onHTTPStatus =  function(httpStatus:Number) {	
	httpN=httpStatus;
}

myLoadVars.onData =  function(s:String){
	ExternalInterface.call("delUps",httpN==200?s:"HTTP Status "+httpN);
	if(httpN==200&&!s)Num-=delN;
	isWorkEnd();
}

//ExternalInterface.addCallback("delups", null, 
public function delups(t:String,id:String,ups:String,n:Number){
	delN=n;
	httpN=0;
	var PHPSESSID:String=ExternalInterface.call("getPHPID").toString();
	myLoadVars.load("../delups.php?PHPSESSID="+PHPSESSID+"&type="+t+"&id="+id+"&ids="+ups.substr(1,ups.length));
}
//);
	
	}
	
}
