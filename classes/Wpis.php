<?php 
class Wpis
{
	private $_db,
			$_data,
			$_rodzaj,
			$_pelnaNazwa;



	public function __construct($rodzaj,$id = null)
	{
		$this->_db = DB::getInstance();

		//gromadzi rodzaj
		$this->_rodzaj = $rodzaj;

		if(!$this->istnieje())
		{
			Redirect::to('/');
		}

		if(is_numeric($id) && !$rodzaj)
		{
		
			$this->find($id);
			$rodzaj = $this->data()->first()->kategoria;
		}
		//gromadzi pelna nazwe
		$this->nazwa();
		

		$this->find($id);
	}
	

	public function update($fields = [], $id = null)
	{
		
		if (!$id) 
		{
			$id = $this->data()->id;	
		}
		if (!$this->_db->update('wpisy',$id,$fields)) 
		{
			throw new Exception('Wystąpił problem podczas akutalizowania wpisu');
		}
	
	}

	public function create($fields = [])
	{
		if(!$this->_db->insert('wpisy',$fields))
		{
			throw new Exception('Wystąpił problem podczas towrzenia wpisu');
		}
	}

	public function find($id = null)
	{
		if ($id) 
		{
			$field = (is_numeric($id)) ? 'id' : 'slug';

			$data = $this->_db->get('wpisy', ['id', '=', $id]);

			if($data->count())
			{
				$this->_data = $data;
				return true;
			}
		}
	}

	public function wszystkie($id = null)
	{
		if ($this->rodzaj()) 
		{
			$this->rodzaj();
			if ($id) {
				$where = 'id';
			}
			else
			{
				$id = $this->rodzaj();
				$where = 'kategoria';
			}
			//return $this->_db->get('wpisy', [$where, '=',$id])->results();
			return $this->_db->query("SELECT * FROM wpisy WHERE $where = ? ORDER BY numer ASC", [$id])->results();
		}
		return false;

	}



	public function exists()
	{
		return (!empty($this->_data)) ? true : false;
	}



	public function data()
	{
		return $this->_data;
	}

	public function rodzaj()
	{
		return $this->_rodzaj;
	}
	public function pelnaNazwa()
	{
		return $this->_pelnaNazwa;
	}

	public static function link($wpis)
	{
	
		return sprintf('<a href="/%s/%s-%s">%s</a>',escape($wpis->kategoria),escape($wpis->id),escape($wpis->slug),escape($wpis->tytul));
	}

	private function nazwa()
	{

		$this->_pelnaNazwa = $this->_db->action('SELECT nazwa', 'rodzaje', ['rodzaj','=',$this->rodzaj()])->first()->nazwa;
		
	}

	private function istnieje()
	{	
		
		return $this->_db->get('rodzaje',['rodzaj', '=', $this->rodzaj()])->count();
		
	}

	
}

 ?>