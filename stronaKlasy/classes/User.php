<?php 
class User
{
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;



	public function __construct($user = null)
	{
		$this->_db = DB::getInstance();

		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');
	
		if(!$user)
		{
			if(Session::exists($this->_sessionName))
			{
				$user = Session::get($this->_sessionName);
				if($this->find($user))
				{
					$this->_isLoggedIn = true;
				}
				else
				{
					//prcess logout
				}
			}

		}
		else
		{
			$this->find($user);
		}
	}

	public function update($fields = [], $id = null)
	{
		if (!$id && $this->IsLoggedIn()) 
		{
			$id = $this->data()->id;	
		}
		if (!$this->_db->update('uczniowie',$id,$fields)) 
		{
			throw new Exception('Therer was a proble updating');
		}
	}

	public function create($fields = [])
	{
		if(!$this->_db->insert('uczniowie',$fields))
		{
			throw new Exception('There was a problem creating account');
		}
	}

	public function find($user = null)
	{
		if ($user) 
		{
			$field = (is_numeric($user)) ? 'id' : 'username';
			$data = $this->_db->get('uczniowie', [$field, '=', $user]);

			if($data->count())
			{
				$this->_data = $data->first();
				return true;
			}
		}
	}

	public function login($username = null, $password = null, $remember = false)
	{
		
		if (!$username && !$password && $this->exists()) 
		{
			Session::put($this->_sessionName, $this->data()->id);
		}
		else
		{
			$user = $this->find($username);
			
			if ($user) 
			{
				
				echo 'Hasło = '.$this->data()->password;
				echo '<br>';
				echo 'Wpisane hasło = '.$password;
				echo '<br>';
				echo 'Wpisany login = '.$username;
				echo '<br>';
				echo 'Salt = '.$this->data()->salt;
				echo '<br>';
				echo 'Wytworzony hash = '.Hash::make($password, $this->data()->salt);

				if($this->data()->password === Hash::make($password, $this->data()->salt))
				{
					Session::put($this->_sessionName, $this->data()->id);
				
					if($remember)
					{
						
						$hash = Hash::unique();

						$hashCheck = $this->_db->get('uczniowie_session', ['user_id','=',$this->data()->id]);
						if(!$hashCheck->count())
						{
							$this->_db->insert('uczniowie_session',[
								'user_id' => $this->data()->id,
								'hash' => $hash
								]);
						
						}
						else
						{
							$hash = $hashCheck->first()->hash;
						}
						
						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expire'));
					}

					return true;
				}	
			}
		}

		return false;
	}

	public function hasPermission($key)
	{
		

		$group = $this->_db->get('groups', ['id','=', $this->data()->group]);
		
		
		if($group->count())
		{
			
			$permissions = json_decode($group->first()->permission, true);

			if ($permissions[$key] == true) 
			{
				return true;
			}
		}
		return false;
	}

	public function exists()
	{
		return (!empty($this->_data)) ? true : false;
	}

	public function logout()
	{
		$this->_db->delete('uczniowie_session', ['user_id', '=', $this->data()->id]);

		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);

	}

	public function data()
	{
		return $this->_data;
	}

	public function IsLoggedIn()
	{
		return $this->_isLoggedIn;
	}
}

 ?>