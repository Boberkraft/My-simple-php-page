<section class="hero is-primary is-medium">
 <!--  menu z logiem -->
<div class="hero-head">
    <header class="nav">
      <div class="container">
        <div class="nav-left">
          <a href="/menu" class="nav-item">
            <!-- <img src="images/bulma-white.png" alt="Logo"> -->
            <?php echo $imie_nazwisko; ?>
          </a>
        </div>
        <span class="nav-toggle">
          <span></span>
          <span></span>
          <span></span>
        </span>
        <div class="nav-right nav-menu">
          <a href="/kontakt" class="nav-item is-active">
            Kontakt
          </a>
          <span class="nav-item">
          <?php 
          if(!$zalogowany)
          {
            echo '<a  href="/zaloguj" class="button is-primary is-inverted">
              <span>Zaloguj się</span>
            </a>';
          }
          else
          {
      
             echo '<a href="/wyloguj" class="button is-primary is-inverted">
              <span>Wyloguj się</span>
            </a>';
          }

           ?>
            
          </span>
        </div>
      </div>
    </header>
  </div>
  <!-- koniec menu z logiem -->

  <!-- Hero content: will be in the middle -->
  <div class="hero-body">
    <a href="/">
    <div class="container has-text-centered">
      <h1 class="title">
        Witamy na Bobkopedi!
      </h1>
      <h2 class="subtitle">
        Tutaj dowiesz się niezbędnych rzeczy 
      </h2>
    </div>
    </a>
  </div>

  <!-- Hero footer: will stick at the bottom -->
  <div class="hero-foot">
    <!--Początek zakładek-->
     <div class="container">
    <div class="tabs is-boxed is-medium bordo">
      <ul class="is-left">
      <?php 
      $zakladki = DB::getInstance()->get('rodzaje',['1', '=', '1']);
		foreach ($zakladki->results() as $zakladka) 
		{	

			$f_class =  "";
			$f_nazwa = $zakladka->rodzaj;
			$f_link = strtolower($f_nazwa);
			
			
			if (strtolower($kategoria) == strtolower($zakladka->rodzaj)) 
			{
				$f_class = 'class="is-active"';

			}
			if ($f_link == "home") 
			{
				$f_link = '';
			}
			

			echo "<li $f_class>
         			 <a href=\"/$f_link\">
         			 <span>$f_nazwa</span>
         			 </a>
       			 </li>";
			
		}
       ?>
       
      <!--   <li <?php if($kategoria == 'pele') echo 'class="is-active"' ?>>
          <a href="/pele">
          <span>Pele</span>
          </a>
        </li> -->
      </ul>
      
    </div>
    </div>
    <!--Koniec zakładek-->
  </div>
</section>


<!-- tekst pod zakładkami -->
<nav class="nav has-shadow">
  <div class="container">
    <div class="nav-left">
     <a class="nav-item no-hover"><?php echo $pelnaNazwa; ?></a>
    </div>
  </div>
</nav>
<!-- Koniec Tekst pod zakładkami -->