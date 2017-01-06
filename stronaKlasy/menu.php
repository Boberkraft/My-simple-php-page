<?php

require_once dirname(__FILE__).'/core/init.php';


if (!$zalogowany) {
  Redirect::to('/');
}

$kategoria = 'Config';
$pelnaNazwa = "Panel Administratora";


if(Input::exists('post'))
{


  if (Token::check(Input::get('token'))) 
  {
    
    if (Input::get('x_akcja') == "dodaj") 
    {
   
      $validate = new Validate();
      $validation = $validate->check($_POST,[
         'x_skrot' => [
           'required' => true,
           'min' => 3
         ],
         'x_pelnaNazwa' => [
          'required' => true,
          'min' => 3
         ]
        ]);

      if($validation->passed())
      {

        try 
        {
         DB::getInstance()->insert('rodzaje', [
              'rodzaj' => Input::get('x_skrot'),
              'nazwa' => Input::get('x_pelnaNazwa'),
            ]);
          Session::flash('menu', 'Udało ci się dodać przedmiot', 'succes');
          
         
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

        Session::flash('menu', '<h1>Nie udało ci się dodać przedmiotu</h1><br>'.$bledy, 'error');
        
      }
      
    } 
    else if (Input::get('x_akcja') == "edytuj") 
   {
    
      $validate = new Validate();
      $validation = $validate->check($_POST,[
         'x_skrot' => [
           'required' => true,
           'min' => 3
         ],
         'x_id' => [
           'required' => true
         ],
         'x_pelnaNazwa' => [
          'required' => true,
          'min' => 3
         ]
        ]);

      if($validation->passed())
      {

        try 
        {
         DB::getInstance()->update('rodzaje',Input::get('x_id'), [
              'rodzaj' => Input::get('x_skrot'),
              'nazwa' => Input::get('x_pelnaNazwa'),
            ]);
          Session::flash('menu', 'Wpis usunięty', 'succes');
          
        
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

        Session::flash('menu', '<h1>Nie udało ci się usunąć wpisu/h1><br>'.$bledy, 'error');
        
      }
      
    } 
    else if (Input::get('x_akcja') == "usun") 
    { 
       $validate = new Validate();
      $validation = $validate->check($_POST,[
         'x_id' => [
           'required' => true
         ]
        ]);

      if($validation->passed())
      {

        try 
        {
         DB::getInstance()->delete('rodzaje',['id', '=', Input::get('x_id')]);
          Session::flash('menu', 'Udało ci się zedytować przedmiot', 'succes');
          
       
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

        Session::flash('menu', '<h1>Nie udało ci się zedytować przedmiotu</h1><br>'.$bledy, 'error');
        
      }
      
    }
    
  }
}

$r_token = Token::generate();
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
        Ustawienia i konfiguracje!
        </h1>
        </div>
        <h2 class="subtitle">
       
          <!-- tutaj jest zawartosc -->
          <div class="content">
            <div class="columns">
            <!-- tabelka z rodzajami -->
              <div class="column">
                <br><br>
                <table class="table is-narrow">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Skrót</th>
                      <th>Pełna nazwa</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                    <form method="post" action="">
                      <td><input type="hidden" name="x_akcja"  value="dodaj">x</td>
                      <td><input type="text" name="x_skrot" class="input" value=""></td>
                      <td><input type="text" name="x_pelnaNazwa" class="input" value=""><input type="hidden" name="token" value="<?php echo $r_token ?>"></td>
                      <td colspan="2" class="has-text-centered"><button class="button">Dodaj przedmiot</button></td>
                    </form>
                    </tr>

                  <?php 
                  $rodzaje = DB::getInstance()->get('rodzaje',['1','=','1']);

                  foreach($rodzaje->results() as $rodzaj)
                  {
                    $r_id = $rodzaj->id;
                    $r_skrot = $rodzaj->rodzaj;
                    $r_pelnaNazwa = $rodzaj->nazwa;
                    echo "
                    <tr>
                      <td id=\"r_id-$r_id\">$r_id</td>
                      <td id=\"r_skrot-$r_id\">$r_skrot</td>
                      <td id=\"r_pelnaNazwa-$r_id\">$r_pelnaNazwa</td>
                      <td><a  id=\"r_przycisk-$r_id\" onclick=\"edytujBeforeSwal($r_id)\" class=\"button \">Edytuj</a></td>
                      <td><a onclick=\"usunSwal($r_id)\" class=\"button is-danger\">Usuń</a></td>
                    </tr>";
                  }
                   ?>
                   

                  </tbody>

                </table>
                <form method="post" id="zmienKategorie" action="">

                  <input type="hidden" name="x_id" id="x_id" >
                  <input type="hidden" name="x_akcja" id="x_akcja" >
                  <input type="hidden" name="x_skrot" id="x_skrot" >
                  <input type="hidden" name="x_pelnaNazwa" id="x_pelnaNazwa" >
                  <input type="hidden" name="token" value="<?php echo $r_token; ?>">
                  
                </form>
              </div>
            <!-- koniectabelka z rodzajami -->
            </div>


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

<script type="text/javascript">

function usunSwal(id)
{
  swal({
  title: 'Na pewno?',
  text: "Nie będziesz w stanie tego odwrócić!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#1fc8db',
  cancelButtonColor: '#e84135',
  confirmButtonText: 'Tak, usuń to!',
  cancelButtonText: 'Nie usuwaj'
}).then(function() {
  usun(id)
})
}



function edytujBeforeSwal(id)
{
  var r_id = $("#r_id-"+id).html();
  var r_skrot = $("#r_skrot-"+id).html();
  var r_pelnaNazwa = $("#r_pelnaNazwa-"+id).html();


  $("#r_skrot-"+id).html('<input type="text" class="input" value="'+r_skrot+'">');
  $("#r_pelnaNazwa-"+id).html('<input type="text" class="input" value="'+r_pelnaNazwa+'">');
  $("#r_przycisk-"+id).attr("onclick","edytujSwal("+id+")");
  $("#r_przycisk-"+id).addClass("is-warning");




}
function edytujSwal(id)
{
  swal({
  title: 'Na pewno?',
  text: "Nie będziesz w stanie tego odwrócić!>",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#1fc8db',
  cancelButtonColor: '#e84135',
  confirmButtonText: 'Tak, zmień to!',
  cancelButtonText: 'Nie zmieniaj'
}).then(function() {
  edytuj(id)
})
}

function usun(id)
{
  $("#x_akcja").val('usun');
  $("#x_id").val(id);

  $("#zmienKategorie").submit();

}

function edytuj(id)
{
  $("#x_akcja").val('edytuj');

  $("#x_id").val(id);
  $("#x_skrot").val($("#r_skrot-"+id+" > input").val());
  $("#x_pelnaNazwa").val($("#r_pelnaNazwa-"+id+" > input").val());


  $("#zmienKategorie").submit();
 

}

</script>

<?php 
 if(Session::exists('przedmiot'))
  {
    echo '<script type="text/javascript">'.Session::flash('przedmiot').' </script>';
  }

 ?>
</body>

</html>

