<?php

require_once dirname(__FILE__).'/core/init.php';

$kategoria = 'dupa';
$pelnaNazwa = "Poznaj mnie!";

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
         <br><br>
  <p>Stworzyłem bardzo dużo stronek coś tutaj musze napisać danone ot naprawdę smaczny jogurt. Przedemną są nożyczki i nie wiem jakiej są fimry - oh są fimly finland. Diznwe przecież to kraj</p>
  <h4>Second level</h4>
  <p>Curabitur accumsan turpis pharetra <strong>augue tincidunt</strong> blandit. Quisque condimentum maximus mi, sit amet commodo arcu rutrum id. Proin pretium urna vel cursus venenatis. Suspendisse potenti. Etiam mattis sem rhoncus lacus dapibus facilisis. Donec at dignissim dui. Ut et neque nisl.</p>
  <ul>
    <li>In fermentum leo eu lectus mollis, quis dictum mi aliquet.</li>
    <li>Morbi eu nulla lobortis, lobortis est in, fringilla felis.</li>
    <li>Aliquam nec felis in sapien venenatis viverra fermentum nec lectus.</li>
    <li>Ut non enim metus.</li>
  </ul>
  <h4>Third level</h4>
  <p>Quisque ante lacus, skeletalsuada ac auctor vitae, congue <a href="#">non ante</a>. Phasellus lacus ex, semper ac tortor nec, fringilla condimentum orci. Fusce eu rutrum tellus.</p>
  <ol>
    <li>Donec blandit a lorem id convallis.</li>
    <li>Cras gravida arcu at diam gravida gravida.</li>
    <li>Integer in volutpat libero.</li>
    <li>Donec a diam tellus.</li>
    <li>Aenean nec tortor orci.</li>
    <li>Quisque aliquam cursus urna, non bibendum massa viverra eget.</li>
    <li>Vivamus maximus ultricies pulvinar.</li>
  </ol>
  <blockquote>Bobi tak to robi, że wszystko wychodzi</blockquote>
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

