




<?php

require_once dirname(__FILE__).'/core/init.php';

if(Input::exists())
{
	if (Token::check(Input::get('token'))) 
	{
		$validate = new Validate();
		$validation = $validate->check($_POST,[
			'username' => [
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'uczniowie'
			],
			'password' => [
				'required' => true,
				'min' => 6,
				'max' => 20
				],
			'password_again' => [
				'required' => true,
				'matches' => 'password',
			],
			'name' => [
				'required' => true,
				'min' => 2,
				'max' => 50
				]
			]);

		if($validation->passed())
		{
			$user = new User();

			$salt = Hash::salt(32);
			$salt = utf8_encode($salt);
			//$salt = "gej";


			try 
			{
				$user->create([
						'username' => Input::get('username'),
						'password' => Hash::make(Input::get('password'), $salt),
						'salt' => $salt,
						'name' => Input::get('name'),
						'joined' => date('Y-m-d H:i:s'),
						'group' => 1
					]);
				Session::flash('home', 'Udało się! Teraz pozostało jedynie się zalogować.', 'success');

				Redirect::to('/');
			} 
			catch (Exception $e) 
			{
				die($e->getMessage());	
			}
		}
		else
		{
			foreach($validation->errors() as $error)
			{
				echo $error.'<br>';
			}
			
		}
	}
}



$kategoria = 'dupa';
$pelnaNazwa = "Zarejestruj się!";

 ?>
<!DOCTYPE html>
<html>
<head>

  
  <?php
  /* Nagłownki*/
  require_once dirname(__FILE__).'/includes/head.php';
  ?>

<head>
<body>


  <!--  menu z logiem -->
    <?php 
    require_once dirname(__FILE__).'/includes/nav.php';
    ?>
  <!-- koniec menu z logiem -->


<!-- zawartosc -->
 <section class="section">
    <div class="container">
      <div class="heading">
        <h1 class="title is-large">
        <div class="content">
        Witamy jestem Bobi
        </h1>
        </div>
        <h2 class="subtitle">
       
          <!-- tutaj jest zawartosc -->
          <div class="content">
          <form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')) ?>" autocomplete="off">
	</div>

	<div class="field">
		<label for="password">Chose a password</label>
		<input type="password" name="password" id="password">
	</div>
	<div class="field">
		<label for="password_again">Enter your password again</label>
		<input type="password" name="password_again" id="password_again">
	</div>

	<div class="field"> 
		<label for="name">Your name</label>
		<input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')) ?>">
	</div>
	<input type="hidden" name="token" value=<?php echo Token::generate() ?>	>
	<button type="submit">Register!</button>
</form>

    

          </div>
          <!-- koniec jest zawartosc -->
        </h2>

      </div>
    </div>
  </section>
<!-- koniec zawartosc -->


<!-- Stopka -->
<?php 
require_once dirname(__FILE__).'/includes/footer.php';
?>
<!-- Koniec Stopka -->


</body>

</html>

