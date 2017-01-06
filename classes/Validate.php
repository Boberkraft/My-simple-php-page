<?php

class Validate
{
	private $_passed = false,
			$_errors = [],
			$_db = null;

	public function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = [])
	{
		foreach($items as $item => $rules)
		{
			foreach($rules as $rule => $rule_value)
			{
				$value = trim($source[$item]);

				if($rule === 'required' && empty($value))
				{
					$this->addError("Nie wpisałeś $item"); //zmienic
				}
				else if(!empty($value))
				{
					switch($rule)
					{
						case 'min':
							if(strlen($value) < $rule_value)
							{
								$this->addError("$item musi mieć powyżej $rule_value znaków");
							}

						break;
						case 'max':
							if(strlen($value) > $rule_value)
								{
									$this->addError("$item musi mieć powyżej $rule_value znaków");
								}

						break;
						case 'matches':
							if($value != $source[$rule_value])
							{
								$this->addError("$rule_value musi być identyczne jak $item");
							}
						break;
						case 'unique':
							$check = $this->_db->get($rule_value,[$item, '=', $value]);
							if($check->count())
							{
								$this->addError("$item już istnieje.");
							}
						break;
					}

				}
			}
		}

		if(empty($this->errors())) //mozna zmienic na _errors
		{
			$this->_passed = true;
		}
		return $this;
	}

	private function addError($error)
	{
		$this->_errors[] = $error;
	}

	public function errors()
	{
		return $this->_errors;
	}

	public function passed()
	{
		return $this->_passed;
	}
}
?>



