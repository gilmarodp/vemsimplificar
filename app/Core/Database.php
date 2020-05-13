<?php

namespace App\Core;

class Database
{
	private $type;
	private $host;
	private $name;
	private $user;
	private $pass;

	public function __construct()
	{
		$this->type = DB['TYPE'];
		$this->host = DB['HOST'];
		$this->name = DB['NAME'];
		$this->user = DB['USER'];
		$this->pass = DB['PASS'];
	}

	protected function connect ()
	{
		$pdoDetails = "{$this->type}:host={$this->host};";
		$pdoDetails .= "dbname={$this->name}";

		try {
			return new \PDO($pdoDetails, $this->user, $this->pass);
		} catch (Exception $e) {
			return 'Erro: ' . $e->getMessage();
		}
	}
}
