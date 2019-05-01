@ECHO OFF

setlocal

set MSG=i

if "%1"=="" (
set MSG=h
echo 命令缺少参数，使用 /? 获取帮助。
goto end
)

if "%1"=="/?" (
set MSG=h
echo 众言论坛安装程序。
echo copyright(C^) 2007-%date:~0,-4%
echo.
echo syntax : install Rootpath Alias DBHost DBPort DBName DBUser DBPass
echo.
echo paramatis:
echo   Rootpath : 论坛安装目录。需要完整路径。
echo   Alias    : 论坛别名。
echo   DBHost   : 数据库服务器地址。
echo   DBPort   : 数据库服务器端口号。通常是3306。
echo   DBName   : 数据库名，论坛数据库在mysql服务器中的数据库名称。
echo   DBUser   : 数据库用户，可以访问论坛数据库的用户名称。
echo   DBPass   : 数据库用户密码。
echo.
goto end
)

:paramatis

set rootpath=%1

if "%2"=="" (
set MSG=缺少论坛别名参数。
goto end
)else set alias=%2
if "%3"=="" (
set MSG=缺少数据库服务器地址参数。
goto end
)else set dbhost=%3
if "%4"=="" (
set MSG=缺少数据库服务器端口号参数。
goto end
)else set dbport=%4
if "%5"=="" (
set MSG=缺少数据库名参数。
goto end
)else set dbname=%5
if "%6"=="" (
set MSG=缺少数据库用户参数。
goto end
)else set dbuser=%6
if "%7"=="" (
set MSG=缺少数据库用户密码参数。
goto end
)else set dbpass=%7

set V=2014.1
set T=%date:~0,-4% %time:~0,-3%

echo.
echo 安装参数 :
echo   安装目录         : %rootpath%
echo   论坛别名         : %alias%
echo   数据库服务器地址 : %dbhost%
echo   数据库服务器端口 : %dbport%
echo   数据库名称       : %dbname%
echo   数据库用户       : %dbuser%
echo   数据库用户密码   : %dbpass%
echo.
cd forum

echo 设置论坛参数和数据库连接...
cd hefo
copy /Y ..\..\rpstring.exe >out.txt
del out.txt
rpstring /f dbb.php db.php RootPath %rootpath:\=\\%
rpstring db.php temp.php AliasName %alias%
move /Y temp.php db.php
rpstring db.php temp.php HostName %dbhost%
move /Y temp.php db.php
rpstring db.php temp.php HostPort %dbport%
move /Y temp.php db.php
rpstring db.php temp.php DatabaseUser %dbuser%
move /Y temp.php db.php
rpstring db.php temp.php UserPass %dbpass:\=\\%
move /Y temp.php db.php
rpstring db.php temp.php DatabaseName %dbname%
move /Y temp.php db.php
del rpstring.exe
cd ..\..
echo.

echo 设置Apache服务器数据...
cd data
echo #version %V%>forum.%V%.conf
echo #installdate %T%>>forum.%V%.conf
echo Alias /%alias% "%rootpath%">>forum.%V%.conf
echo ^<Directory "%rootpath%"^>>>forum.%V%.conf
echo   Options FollowSymLinks>>forum.%V%.conf
echo   AllowOverride All>>forum.%V%.conf
echo   Order allow,deny>>forum.%V%.conf
echo   Allow from all>>forum.%V%.conf
echo   Satisfy all>>forum.%V%.conf
echo   DirectoryIndex index.php>>forum.%V%.conf
echo   RewriteEngine On>>forum.%V%.conf
echo   RewriteBase /%alias%>>forum.%V%.conf
echo   RewriteRule ^^uploads/ pro/att.php>>forum.%V%.conf
echo ^</Directory^>>>forum.%V%.conf
echo.

echo 租用空间 Rewrite 设置...
echo [ISAPI_Rewrite]>httpd.ini
echo.>>httpd.ini
echo # 此规则属于众言论坛，请上传到网站根目录(即web文件夹下)>>httpd.ini
echo.>>httpd.ini
echo RewriteRule ^^/%alias%/uploads/.* /%alias%/pro/att\.php>>httpd.ini
cd ..
echo.

echo 设置数据库数据...
cd data
..\rpstring /f data forum.sql install_forum_dbname %dbname%
echo. >>forum.sql
echo UPDATE tdict SET info="%V%",ctime=now() WHERE type in(11,13) and ikey="version";>>forum.sql
echo UPDATE tdict SET info="%T%",ctime=now() WHERE type in(11,13) and ikey="datetime";>>forum.sql
cd ..
echo.

:end

if "%MSG%"=="i" (
echo.
echo 安装完成！
goto lastend
)

if "%MSG%"=="h" (
goto lastend
)

echo.
echo 安装失败！
echo.
echo   原因: %MSG%

:lastend

endlocal