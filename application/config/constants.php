<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/* End of file constants.php */
/* Location: ./application/config/constants.php */

if(ENVIRONMENT == "development"){
	//개발 환경 설정
	define('WEB_ROOT',				'http://localhost/');
	define('FILE_ROOT',				'C:\\workspace\\WALK\\public_html\\');	
}else if(ENVIRONMENT == "stage"){
	//운영 환경 설정
	define('WEB_ROOT',				'http://devwk.focus.kr/');
	define('FILE_ROOT',				'/FILE/SERVICE/public_html/walk/public_html/');
}else if(ENVIRONMENT == "production"){
	define('WEB_ROOT',				'http://walk.focus.kr/');
	define('FILE_ROOT',				'/FILE/SERVICE/public_html/walk/public_html/');
}else if(ENVIRONMENT == "mig"){
	define('WEB_ROOT',				'http://1.227.58.11:1990/');
	define('FILE_ROOT',				'/FILE/SERVICE/public_html/walk/public_html/');
}
//공통
define('ACTIVITY_PATH', WEB_ROOT.'activity/');					//Migration Root 경로
define('IMG_PATH',	 	WEB_ROOT.'mnt/walk/activity/');			//Migration IMG Root 경로
define('ADMIN_PATH', 	WEB_ROOT.'admst/');						//리소스 Roo 경로

define('경로_공통이미지',	'/mnt/walk/images/');
define('경로_이벤트',		'/mnt/walk/event/');
define('경로_매거진',		'/mnt/walk/magazine/');
define('경로_핫스팟',		'/mnt/walk/hotspot/');
define('경로_사용자',		'/mnt/walk/user/');
define('경로_걷기대회',		'/mnt/walk/master/');
define('경로_메시지',		'/mnt/walk/message/');
define('경로_경품',		'/mnt/walk/prize/');
define('경로_기념품',		'/mnt/walk/gift/');
