
<?php 
require_once dirname(__FILE__).'/core/init.php';









if(!$kategoria) Redirect::to('/');




?>


<!DOCTYPE html>
<html>
<head>

  <!-- Nagłówki -->
  <?php
  require_once dirname(__FILE__).'/includes/head.php';
  ?>
  <!-- Koniec Nagłówki -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
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
        Wszystkie wpisy
        </h1>
        <h2 class="subtitle">
        <?php 
        if(!$numer_wpisu)
        {
          echo ' <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nazwa lekcji</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Nazwa lekcji</th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
                <tbody>';
          foreach($wpisy->wszystkie() as $wpis)
          {
            $tytul = Wpis::link($wpis);
            if ($zalogowany) 
            {

              $gora = sprintf('<span class="icon is-medium"><a href="/przesun.php?gdzie=dol&przedmiot=%s&numer=%s&id=%s" class="nounderline"><i class="fa fa-angle-up"></a></i></span>', $kategoria,$wpis->numer,$wpis->id);
              $dol = sprintf('<span class="icon is-medium"><a href="/przesun.php?gdzie=gora&przedmiot=%s&numer=%s&id=%s" class="nounderline"><i class="fa fa-angle-down"></a></i></span>', $kategoria,$wpis->numer,$wpis->id);

            }
            else
            {
              $gora = '';
              $dol = '';
            }
            echo "<tr>
              <td>{$wpis->numer}</td>
              <td>{$tytul}</td>
              <td>$gora</td>
              <td>$dol</td>
            </tr>";
          }
          echo '  </tbody>
                </table>';
        }
        else
        {
          echo '<div id="zawartosc">';

          $wpis = $wpisy->wszystkie()[0];


          //echo $wpis->tytul,'<br>';
          echo $wpis->data_modyfikacji,'<br><br>';
          echo '<div id="tresc">'.$wpis->tresc,'</div><br>';
         // echo $wpis->data_modyfikacji,'<br>';
        


        }

  ?>
          


   
          <!-- tylko dla zalogowanych -->
          <?php  
          if($zalogowany)
          {
            if(!$numer_wpisu) 
            {
              echo '<br>';
              echo '<p><a class="button is-primary" href="/dodaj.php?przedmiot='.$kategoria.'">Dodaj wpis</a></p>';
            }
            else if($numer_wpisu)
            {
                $form_tytul = $wpis->tytul;
                $form_id = $wpis->id;
                $form_slug = $wpis->slug;
                $form_data = $wpis->data;
                $form_data_modyfikacji = $wpis->data_modyfikacji;
                $form_krotki_tytul = $wpis->krotki_tytul;
                $get_usuniecie = 'id='.$form_id.'&token='.Token::generate().
              '&przedmiot='.$kategoria;
          

          echo<<<END
          <br>
         <div class="card is-fullwidth">
          <header class="card-header">
            <p class="card-header-title">
              Informacje
            </p>
            <a class="card-header-icon">
              <i class="fa fa-angle-down"></i>
            </a>
          </header>
          <div class="card-content">
            <div class="content has-text-centered">
              <p><span class="tag is-primary">Tytul</span><span id="form_tytul" class="tag">{$form_tytul}</span></p>
              <p><span class="tag is-primary">Krótki tytul</span><span id="form_krotki_tytul" class="tag">{$form_krotki_tytul}</span></p>
              <p><span class="tag is-primary">Slug</span><span id="form_slug" class="tag">{$form_slug}</span></p>
              <!--<p><span class="tag is-primary">Autor</span><span id="form_" class="tag"></span></p>-->
              <p><span class="tag is-primary">Data utworzenia</span><span class="tag">{$form_data}</span></p>
              <p><span class="tag is-primary">Data modyfikacji</span><span class="tag">{$form_data_modyfikacji}</span></p>
              
            </div>
          </div>
          <footer id="footer" class="card-footer">
            <a onclick="edit()" class="card-footer-item">Edytuj</a>
            <a onclick="usun('{$get_usuniecie}')" id="przycisk_usun" class="wiekszy_padding button">Usuń</a>
            
          </footer>
        </div>
END;
  echo '</div>'; //kończy div ZAWARTOSC
              }
          }
          ?>
          <!-- koniec tylko dla zalogowanych -->
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
<?php 
if($zalogowany && $numer_wpisu)
{
  $form_token = Token::generate();
  $form_tytul = $wpis->tytul;
  $form_id = $wpis->id;
  $form_kategoria = $wpis->kategoria;
  $form_slug = $wpis->slug;
  $form_krotki_tytul = $wpis->krotki_tytul;
  echo<<<END
  <script>
  var x = 1;
  function usun(link)
  {
   
    if(x == 1)
    {
      $('#przycisk_usun').addClass('is-warning');
    } 
    if(x == 2)
    {
      $('#przycisk_usun').removeClass('is-warning');
      $('#przycisk_usun').addClass('is-danger');
    }
    if(x > 2)
    {
      window.location.href = "/usun.php?"+link;
    }
    x++;
  }
  function edit()
  {

  
    var info = $("#tresc").html();
    
    $("#zawartosc").html('<form id="myForm" action="/edytuj.php" method="post"> <br>Jeżeli chcesz wyśrodkować obrazek dodaj do img klasę "wysrodkowany". Każdy img opleć w <figure class="image"></figure><ul><li>is-1by1</li> <li>is-4by3</li> <li>is-3by2</li> <li>is-16by9</li> <li>is-2by1</li></ul> <p><span class="tag is-primary">Tytul</span><span id="form_tytul" class="tag"><input class="input is-primary is-small" type="text" name="tytul" id="tytul" value="{$form_tytul}" autocomplete="off"></span></p><br> <p><span class="tag is-primary">Krótki tytuł</span><span id="form_tytul" class="tag"><input class="input is-primary is-small" type="text" name="krotki_tytul" id="krotki_tytul" value="$form_krotki_tytul" autocomplete="off"></span></p><br> <p><span class="tag is-primary">Slug</span><span id="form_tytul" class="tag"><input class="input is-primary is-small" type="text" name="slug" id="slug" value="{$form_slug}" autocomplete="off"></span></p><br> <p><span class="tag is-primary">Treść</span></p><br><textarea name="tresc" id="editor1" rows="50" cols="80"></textarea><input type="hidden" name="id" value="{$form_id}" id="id" autocomplete="off"><input type="hidden" name="token" value="{$form_token}"><input type="hidden" name="przedmiot" id="kategoria" value="{$form_kategoria}"><div class="card is-fullwidth"> <footer id="footer" class="card-footer"><br> <a onclick="document.getElementById(\'myForm\').submit();" class="card-footer-item">Zapisz</a> </footer> </div></form>');
    
    $("#editor1").val(info);
   
   
    CKEDITOR.replace( 'tresc',
      {
       skin : 'office2013'
      });

    
  }
  </script>
END;

}
  if(Session::exists('przedmiot'))
  {
    echo '<script type="text/javascript">'.Session::flash('przedmiot').' </script>';
  }



 ?>

</html>