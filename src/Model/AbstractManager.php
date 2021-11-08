<?php

namespace App\Model;

use App\Model\Connection;
use PDO;

abstract class AbstractManager
{
    protected PDO $pdo;

    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getPdoConnection();
    }
}
