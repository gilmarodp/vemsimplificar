<?php

namespace App\Core;

class Model extends Database
{
	protected $pdo;

	public function __construct ()
	{
		$this->pdo = (new Database)->connect();
	}	
}
