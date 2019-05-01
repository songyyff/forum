<?php include "../func/mustfunc.php";

//验证用户
$loginresult=0;
if(isset($_R["username"]))
if((strlen($_R["username"]))&&(strlen($_R["userpass"])>5)){
	include_once "../func/login.php";
	if($loginresult=f_login($_R["username"],$_R["userpass"],0)){
		//登陆成功
		switch($_R['loginexpire']){
			case "year": $realexpire=12*30*24;break;
			case "month": $realexpire=30*24;break;
			case "week": $realexpire=7*24;break;
			case "day": $realexpire=24;break;
			default: $realexpire=1;
		}
		$realexpire=time()+$realexpire*60*60;
		// set "cousername" must use $_R['username'']
		setcookie ("cousername",f_delsla($_R['username']),$realexpire, "/$_alias");
		setcookie ("couserpass", $pass, $realexpire, "/$_alias");
	}else $loginresult=2;
}else $loginresult=3;
?>
<html>
<head>
  <title>用户登陆</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="../theme/<?php echo $_SESSION['sestyle']; ?>/def.css">
</head>
<body leftmargin="0"  topmargin="0" onresize="return tmsize();">
<?php include "../hefo/head.php"; ?>
<div class=gud><a href="../index.php"><b>论坛</b></a>>>用户登陆</div>
<?php
include"../rag/".($loginresult==1?"lgnsuc.php":"login.php");
include"../hefo/foot.php";
?>
</body>
</html>