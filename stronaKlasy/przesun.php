
<?php 

require_once 'core/init.php';

if (!$zalogowany) {
	Redirect::to('index.php');
}

if(Input::exists('get'))
{
	
	//echo $kategoria, escape(Input::get('numer'));
	//die();
	if (Input::get('gdzie') == 'dol') 
	{
		if(Input::get('numer') < 1)
		{
			Redirect::to('przedmiot.php?przedmiot='.Input::get('przedmiot'));
		}
		$drugieee = DB::getInstance()->query('UPDATE wpisy SET numer=numer+1 WHERE kategoria = ? AND numer = ?', [$kategoria, escape(Input::get('numer'))-1]);
		$pierwsze = DB::getInstance()->query('UPDATE wpisy SET numer=numer-1 WHERE id = ?', [escape(Input::get('id'))]);
	}
	else if(Input::get('gdzie') == 'gora')
	{

		$drugieee = DB::getInstance()->query('UPDATE wpisy SET numer=numer-1 WHERE kategoria = ? AND numer = ?', [$kategoria, escape(Input::get('numer'))+1]);
		$pierwsze = DB::getInstance()->query('UPDATE wpisy SET numer=numer+1 WHERE id = ?', [escape(Input::get('id'))]);
	}
	
	if ($drugieee && $pierwsze) {

		Redirect::to('przedmiot.php?przedmiot='.Input::get('przedmiot'));
	}
	else
	{
		die('Wystąpił błąd podczas edycji wpisu');
	}
	
}

Redirect::to('index.php');
