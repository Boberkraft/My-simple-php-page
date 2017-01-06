<?php 

require_once dirname(__FILE__).'/core/init.php';
$kategoria = 'home';


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
        <h1 class="title is-large">
        <div class="content">
        Witamy
        </h1>
        </div>
        <h2 class="subtitle">
       
          <!-- tutaj jest zawartosc -->
          <div class="content">
         <br><br>
         
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan, metus ultrices eleifend gravida, nulla nunc varius lectus, nec rutrum justo nibh eu lectus. Ut vulputate semper dui. Fusce erat odio, sollicitudin vel erat vel, interdum mattis neque.</p>
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
  <blockquote>Ut venenatis, nisl scelerisque sollicitudin fermentum, quam libero hendrerit ipsum, ut blandit est tellus sit amet turpis.</blockquote>
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


<?php 

if(Session::exists('home'))
{
  echo '<script type="text/javascript">'.Session::flash('home').' </script>';
}

 ?>
</body>

</html>

