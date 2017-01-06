<?php 

require_once 'core/init.php';

if (!$zalogowany) {
	Redirect::to('/');
}

if(Input::exists('get'))
{

	if (Token::check(Input::get('token'))) 
	{

		if(DB::getInstance()->delete('wpisy',['id','=',Input::get('id')]))
		{
			Session::flash('przedmiot', 'Udało ci się usunąć wpis', 'success');
		}
		else
		{
			Session::flash('przedmiot', 'Nie udało ci się usunąć wpisu', 'error');
		}
		
	}
}

Redirect::to('/'.$kategoria);
