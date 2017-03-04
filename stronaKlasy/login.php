<?php 


require_once dirname(__FILE__).'/core/init.php';



if(Input::exists())
{

	if (Token::check(Input::get('token'))) 
	{
    
		$validate = new Validate();
		$validation = $validate->check($_POST,[
			'username' => ['required' => true],
			'password' => ['required' => true]
			]);
		if($validation->passed())
		{
			$user = new User();

			$remember = (Input::get("remember") == 'on') ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($login)
			{
				Redirect::to('/');
			}
			else
			{
				Session::flash('login', 'Nie udało ci się zalogować', 'error');
			}
		}
		else
		{
			$bledy = '';
			foreach ($validation->errors() as $error) 
			{
				$bledy .= $error.'<br>';
			}

			Session::flash('login', '<h1>Nie udało ci się zalogować</h1><br><br>'.var_dump($response).$bledy, 'error');
		}

	}
}

$kategoria = 'Login';
$pelnaNazwa = "Zaloguj się";

 ?>


<!DOCTYPE html>
<html>
<head>

  
  <!-- Nagłówki -->
  <?php
  require_once dirname(__FILE__).'/includes/head.php';
  ?>
  <!-- Koniec Nagłówki -->

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
        <h1 class="title">
        Zaloguj się
        </h1>
        <h2 class="subtitle">
       
          <!-- tutaj sie loguje -->
          <div class="columns">
          	<div class="column"></div>
          	<div class="column"></div>
          	<div class="column"></div>
          	<div class="column"></div>
          	<div class="column">
          	<form action="" method="post">
				<div class="field">
					<label for="username">Nazwa urzytkownika</label>
					<input class="input" type="text" name="username" id="username" autocomplete="off">
				</div><br>
				<div class="field">
					<label for="password">Hasło</label>
					<input class="input" type="password" name="password" id="password" autocomplete="off">
				</div><br>

        <div class="g-recaptcha" data-sitekey="6LeVIRQTAAAAALeBxJJsX2_9GBXANcIIVkcZGTkn"></div><br>

				<div class="field">
					<label for="remember">
					<input class="checkbox" type="checkbox" name="remember" id="remember"> Zapamiętaj mnie
					</label>
				</div><br>

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<button class="button is-primary" type="submit">Zaloguj się!</button>
			</form>

          	</div>
          	<div class="column"></div>
          	<div class="column"></div>
          	<div class="column"></div>
          	<div class="column"></div>
          </div>


		

          <!-- koniec tutaj sie loguje -->
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
  <script src='https://www.google.com/recaptcha/api.js'></script>
</body>
<?php 
if(Session::exists('login'))
{
  echo '<script type="text/javascript">'.Session::flash('login').' </script>';
}
 ?>


</html>

