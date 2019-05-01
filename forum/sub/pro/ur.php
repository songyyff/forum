<?php
function f_newfile($path,$extname){
	do{$filename=time().rand(0,10000).$extname;
	}while(file_exists($path.$filename));
	return $filename;
}
e_e();
$query="select id from tuser where name=\"".f_rpspc($_REQUEST['username'])."\"";
$result=mysql_query($query) or die(f_e($query));
if(mysql_num_rows($result)>0)$userexist=1; //已注册
else $userexist=2;
mysql_free_result($result);
if($userexist!=1){
	$upedfile=0;
	if($_POST['facetype']){
		if($_FILES['userselfhead']['error']==0){
			if($_FILES['userselfhead']['size']<1024*150){
				preg_match("/\.[^\.]*$/",$_FILES['userselfhead']['name'],$extn);
				$fileext=strtolower($e_=$extn[0]);
				if($fileext==".gif"||$fileext==".jpg"||$fileext==".jpeg"){
					$uf=date("yW")."/";
					$pp="$_rootpath/faces/$uf";
					if(!file_exists($pp))mkdir($pp,0777);
					do{$n_=base_convert(mt_rand(100,2000000000),10,36);$fn="$pp$n_$e_";}while(!$h_=@fopen($fn,"x"));fclose($h_);
					if(@move_uploaded_file($_FILES['userselfhead']['tmp_name'],$fn))$pic=$uf.$n_.$e_;
					else $resultmsg.="创建上传头像文件 $fn 错误。";
				}else $resultmsg.="上传头像文件 ".f_rpspc($_FILES['userselfhead']['name'])." 类型错误，必须是 .gif .jpg .jpeg 文件。<br>";
			}else $resultmsg.="上传头像文件错误，".f_rpspc($_FILES['userselfhead']['name'])." 文件大小为".number_format($_FILES['userselfhead']['size'])."字节,上传最大尺寸为".number_format(1024*150)."字节。<br>";
		}else $resultmsg.="上传头像文件错误，错误码: ".$_FILES['userselfhead']['error']." .<br>";
            if(!$pic)$pic="sys/3.jpg";
	}else $pic=isset($_POST['userheadpic'])?f_rpspc($_POST['userheadpic']):"sys/3.jpg";
	include "../func/login.php";
	f_encode(f_delsla($_POST['userpass']));
	$query="insert into tuser(ctime,ltime,name,pass,pkey,sex,email,bhday,phon,qq,msn,yahoo,ww,http,sign,info,newt,rsize,isize,face,gptm) values(now(),now(),\"".f_rpspc($_POST['username'])."\",\"$v_enstr\",\"$v_enkey\",".(int)$_POST['sex'].",\"".f_rpspc(trim($_POST['email']))."\",\"".trim($_POST['birthday'])."\",\"".f_rpspc(trim($_POST['phone']))."\",\"".((int)$_POST['QQ']+0)."\",\"".f_rpspc(trim($_POST['msn']))."\",\"".f_rpspc(trim($_POST['yahoo']))."\",\"".f_rpspc(trim($_POST['ww']))."\",\"".f_rpspc(trim($_POST['homepage']))."\",\"".f_rpspc(trim($_POST['signature']))."\",\"".f_rpspc(trim($_POST['selfinfo']))."\",\"".(int)$_POST['newtime']."\",\"".(int)$_POST['replaysize']."\",\"".(int)$_POST['itemsize']."\",\"$pic\",now());";

	$result=mysql_query($query) or die(f_e($query));

	//提取用户信息
	$query="select * from tuser where id=".mysql_insert_id();
	$result=mysql_query($query) or die(f_e($query));
	if($result)$ur=mysql_fetch_object($result); else {$_SESSION["seerrorid"]="nouser";f_toerror();}
	mysql_free_result($result);

	$query="insert tmsg(uid,fid,fname,stime,title,msg)values($ur->id,0,\"系统(system)\",now(),\"祝贺您成功注册论坛\",\"尊敬的 $ur->name ：\n\n    欢迎您来到本论坛。\n\n\n祝您愉快 !\n\n日期/时间:".date("Y-m-d/H:i:s")."\")";
	$result=mysql_query($query) or die(f_e($query));

	$realexpire=time()+60*60;
	// set "cousername" must use $_POST['username'']
	setcookie ("cousername", f_delsla($_POST['username']), $realexpire, "/$_alias");
	setcookie ("couserpass", $v_enstr, $realexpire, "/$_alias");
	
//	echo $ur->name;

	f_login($_POST['username'],$v_enstr,1);
	$constep=2;
}
?>