<?php

date_default_timezone_set("PRC");

$_rootpath="RootPath";
$_alias="AliasName";
$_host="HostName";
$_port=HostPort;
$_db="forum";
$_super="DatabaseUser";
$_pass="UserPass";

function e_e(){}

$uploaddir="$_rootpath/uploads/";//上传附件目录

function f_e($q){
//$q="Sql语句隐藏"; //注释掉这句就可以显示Sql语句
echo "MySql 数据库错误：<br>Sql语句：$q<br>MySql 错误消息：".mysql_error()."<br>";
}
if(!$link=@mysql_connect("$_host:$_port",$_super,$_pass)) die(f_e($q));
mysql_query($q="set names utf8") or die(f_e($q));
mysql_select_db($_db) or die(f_e("使用数据库"));