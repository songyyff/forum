@ECHO OFF

setlocal

set MSG=i

if "%1"=="" (
set MSG=h
echo ����ȱ�ٲ�����ʹ�� /? ��ȡ������
goto end
)

if "%1"=="/?" (
set MSG=h
echo ������̳��װ����
echo copyright(C^) 2007-%date:~0,-4%
echo.
echo syntax : install Rootpath Alias DBHost DBPort DBName DBUser DBPass
echo.
echo paramatis:
echo   Rootpath : ��̳��װĿ¼����Ҫ����·����
echo   Alias    : ��̳������
echo   DBHost   : ���ݿ��������ַ��
echo   DBPort   : ���ݿ�������˿ںš�ͨ����3306��
echo   DBName   : ���ݿ�������̳���ݿ���mysql�������е����ݿ����ơ�
echo   DBUser   : ���ݿ��û������Է�����̳���ݿ���û����ơ�
echo   DBPass   : ���ݿ��û����롣
echo.
goto end
)

:paramatis

set rootpath=%1

if "%2"=="" (
set MSG=ȱ����̳����������
goto end
)else set alias=%2
if "%3"=="" (
set MSG=ȱ�����ݿ��������ַ������
goto end
)else set dbhost=%3
if "%4"=="" (
set MSG=ȱ�����ݿ�������˿ںŲ�����
goto end
)else set dbport=%4
if "%5"=="" (
set MSG=ȱ�����ݿ���������
goto end
)else set dbname=%5
if "%6"=="" (
set MSG=ȱ�����ݿ��û�������
goto end
)else set dbuser=%6
if "%7"=="" (
set MSG=ȱ�����ݿ��û����������
goto end
)else set dbpass=%7

set V=2014.1
set T=%date:~0,-4% %time:~0,-3%

echo.
echo ��װ���� :
echo   ��װĿ¼         : %rootpath%
echo   ��̳����         : %alias%
echo   ���ݿ��������ַ : %dbhost%
echo   ���ݿ�������˿� : %dbport%
echo   ���ݿ�����       : %dbname%
echo   ���ݿ��û�       : %dbuser%
echo   ���ݿ��û�����   : %dbpass%
echo.
cd forum

echo ������̳���������ݿ�����...
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

echo ����Apache����������...
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

echo ���ÿռ� Rewrite ����...
echo [ISAPI_Rewrite]>httpd.ini
echo.>>httpd.ini
echo # �˹�������������̳�����ϴ�����վ��Ŀ¼(��web�ļ�����)>>httpd.ini
echo.>>httpd.ini
echo RewriteRule ^^/%alias%/uploads/.* /%alias%/pro/att\.php>>httpd.ini
cd ..
echo.

echo �������ݿ�����...
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
echo ��װ��ɣ�
goto lastend
)

if "%MSG%"=="h" (
goto lastend
)

echo.
echo ��װʧ�ܣ�
echo.
echo   ԭ��: %MSG%

:lastend

endlocal