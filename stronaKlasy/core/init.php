<?php 
session_start();

$GLOBALS['config'] = [
	'mysql' =>[
		'host' => '',
		'username' => '',
		'password' => '',
		'db' => ''
	],
	'remember' => [
		'cookie_name' => 'hash',
		'cookie_expire' => 604800
	],
	'session' => [
		'session_name' => 'user',
		'token_name' => 'token'
	],
	'recaptcha' =>
	[
		'secret' => '6LeVIRQTAAAAAMzbSYTVRridrVysKj4f97LJ60D_'
	]

];

spl_autoload_register(function($class){
	require_once 'classes/'.$class.'.php';
});

require_once 'funcions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name')))
{

	$hash = Cookie::get(Config::get('remember/cookie_name'));

	$hashCheck = DB::getInstance()->get('users_session', ['hash','=', $hash]);

	$hashCheck->count();

	if($hashCheck->count())
	{
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}

}

//sdfs

require_once 'includes/weryfikacja.php';

?>


