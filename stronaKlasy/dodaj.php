
<?php 

require_once 'core/init.php';


if(Input::exists('post'))
{
	

	if (Token::check(Input::get('token'))) 
	{

		$validate = new Validate();
		$validation = $validate->check($_POST,[
			 'kategoria' => [
				 'required' => true,
				 'min' => 3
			 ],
			 'tytul' => [
			 	'required' => true,
			 	'min' => 3
			 ],
			 'krotki_tytul' => [
				'required' => true,
				'unique' => 'wpisy',
				'min' => 3
			 ],
			 'tresc' => [
				'required' => true,
				'min' => 3
			 ],
			 'slug' => [
				'required' => true,
				'unique' => 'wpisy',
				'min' => 3
			 ]
			]);

		if($validation->passed())
		{

			$wpis = new Wpis(Input::get('kategoria'));
	
			$id_dodajacego = $user->data()->id;
	

			$numer = DB::getInstance()->query('SELECT numer FROM wpisy WHERE kategoria = ? ORDER BY numer DESC',[$wpis->rodzaj()])->first()->numer;
		
			try 
			{
				$wpis->create([
						'id_dodajacego' => $id_dodajacego,
						'id_klasy' => 1,
						'kategoria' => Input::get('kategoria'),
						'tytul' => Input::get('tytul'),
						'krotki_tytul' => Input::get('krotki_tytul'),
						'tresc' => Input::get('tresc'),
						'data' =>  date('Y-m-d H:i:s'),
						'data_modyfikacji' =>  date('Y-m-d H:i:s'),
						'slug' => Input::get('slug'),
						'numer' => $numer +1
					]);
				Session::flash('przedmiot', 'Udało ci się stworzyć wpis', 'succes');
				
				Redirect::to('/'.$kategoria);
			} 
			catch (Exception $e) 
			{
				die($e->getMessage());	
			}
		}
		else
		{
			$bledy = '';
			foreach ($validation->errors() as $error) 
			{
				$bledy .= $error.'<br>';
			}

			Session::flash('dodaj', '<h1>Nie udało ci się stworzyć wpisu</h1><br>'.$bledy, 'error');
			
		}
	}
}



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
        <h1 class="title">
        Dodaj wpis
        </h1>
        <h2 class="subtitle">
       
          <!-- tutaj sie loguje -->
          <form action="" method="post">
			<div class="field">
				<br><label for="tztul">Tytul</label><br><br>
				<input class="input" type="text" name="tytul" id="tytul" value="<?php echo escape(Input::get('tytul')) ?>" autocomplete="off">
			</div>
			<div class="field">
				<br><label for="krotki_tytul">Krótki tytuł</label><br><br>
				<input class="input" type="text" name="krotki_tytul" id="krotki_tytul" value="<?php echo escape(Input::get('krotki_tytul')) ?>" autocomplete="off">
			</div>	
			<div class="field">
				<br><label for="slug">Slug</label><br><br>
				<input class="input" type="text" name="slug" id="slug" value="<?php echo escape(Input::get('slug')) ?>" autocomplete="off">
			</div>
			<div class="field">
				<br><label for="tresc">Treść</label><br><br>
				<textarea name="tresc" id="editor1" rows="10" cols="80"><?php echo escape(Input::get('tresc')) ?></textarea>
			</div>

			
			<input type="hidden" name="kategoria" value="<?php echo $kategoria ?>" id="kategoria" autocomplete="off">



			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>"><br><br>
			<button class="button" type="submit">Wstaw</button>
		</form>



		

          <!-- koniec tutaj sie loguje -->
        </h2>

      </div>
    </div>
  </section>
<!-- koniec zawartosc -->

<!-- Stopka -->
<?php 
require_once dirname(__FILE__).'includes/footer.php';
?>
<!-- Koniec Stopka -->

<script type="text/javascript">
	
	  CKEDITOR.replace( 'tresc',
      {
       skin : 'office2013'
      });

</script>
</body>

<?php 
if(Session::exists('dodaj'))
{
  echo '<script type="text/javascript">'.Session::flash('dodaj').' </script>';
}
 ?>

</html>

