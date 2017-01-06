<?php 

require_once 'core/init.php';

if (!$zalogowany) {
	Redirect::to('/');
}

if(Input::exists('post'))
{

	if (Token::check(Input::get('token'))) 
	{

		$validate = new Validate();
		$validation = $validate->check($_POST,[
			 'id' => [
				 'required' => true,
			 ],
			 'tytul' => [
			 	'required' => true,
			 	'min' => 3
			 ],
			 'krotki_tytul' => [
				'required' => true,
				'min' => 3
			 ],
			 'tresc' => [
				'required' => true,
				'min' => 3
			 ],
			 'slug' => [
				'required' => true,
				'min' => 3
			 ]
			]);

		if($validation->passed())
		{

	
				$dodane = DB::getInstance()->update('wpisy', Input::get('id'), [
							'tytul' => Input::get('tytul'),
							'krotki_tytul' => Input::get('krotki_tytul'),
							'tresc' => Input::get('tresc'),
							'data_modyfikacji' =>  date('Y-m-d H:i:s'),
							'slug' => Input::get('slug'),
						]);
			if ($dodane) {
				Session::flash('przedmiot', 'Udało ci się zedytować wpis', 'succes');
				
				Redirect::to('/'.Input::get('przedmiot').'/'.Input::get('id').'-'.Input::get('slug'));
			}
			else
			{
				die('Wystąpił błąd podczas edycji wpisu');
			}
			die();
				
		
		}
		else
		{
			$bledy = '';
			foreach ($validation->errors() as $error) 
			{
				$bledy .= $error.'<br>';
			}

			Session::flash('przedmiot', '<h1>Nie udało ci się zalogować</h1><br>'.$bledy, 'error');
		}
	}
}

Redirect::to('/'.Input::get('przedmiot').'/'.Input::get('id').'-'.Input::get('slug'));
