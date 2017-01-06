<?php  


$user = new User();
if($user->isLoggedIn()) 
{
	$zalogowany = 1;

	$imie_nazwisko = escape($user->data()->imie).' '.escape($user->data()->nazwisko);

	//sprawdzanie uprawnien
	if($user->hasPermission('admin'))
	{
		//echo 'Jesteś administratorem';
	}
	else
	{
		//echo 'Nie jesteś administratorem';
	}


}
else
{
	$zalogowany = 0;
	$imie_nazwisko = '';
}

if(Input::exists('get'))
{
	$numer_wpisu = escape(Input::get('wpis'));
	$kategoria = escape(Input::get('przedmiot'));

	if ($kategoria || $numer_wpisu) 
	{
		$wpisy = new Wpis($kategoria,$numer_wpisu);
		
		$pelnaNazwa = escape($wpisy->pelnaNazwa());


	}

	//w przypadku gdy jest podany numer wpisu, a niez
	// if ($numer_wpisu && !$kategoria) 
	// {
	// 	$kategoria = $wpisy->data()->first()->kategoria;
	// }

}
else
{
	$pelnaNazwa = 'Strona główna';
	$kategoria = 'Home';
}



?>

<table class="table is-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Poniedziałek</th>
			<th>Wtorek</th>
			<th>Środa</th>
			<th>Czwartek</th>
			<th>Piątek</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>0</th>
			<td rowspan=2>P.tinf</td>
			<td></td>
			<td rowspan="3">PrTK</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th>1</th>
			
			<td>Zzw</td>
			
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th>2</th>
			<td>F roz</td>
			<td>PTK</td>
			
			<td>PP</td>
			<td rowspan="2">M roz</td>
		</tr>
		<tr>
			<th>3</th>
			<td>wf</td>
			<td>M roz</td>
			<td rowspan="2">JP</td>
			<td>F roz</td>

		</tr>
		<tr>
			<th>4</th>
			<td>WoS</td>
			<td>JN</td>

			<td>JA</td>
			<td>F roz</td>
		</tr>
		<tr>
			<th>5</th>
			<td rowspan="2">SK</td>
			<td>JA</td>
			<td>Rel</td>
			<td>JP</td>
			<td>UkAic</td>
		</tr>
		<tr>
			<th>6</th>
			
			<td>Ukaic</td>
			<td>JA</td>
			<td>Rel</td>
			<td rowspan="3">PrTinf</td>
		</tr>
		<tr>
			<th>7</th>
			<td>PSK</td>
			<td>wf</td>
			<td></td>
			<td>wf</td>

		</tr>
		<tr>
			<th>8</th>
			<td>PSK</td>
			<td></td>
			<td></td>
			<td>Infor</td>

		</tr>
		
	</tbody>
</table>