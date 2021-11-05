<?php

namespace App\Model;

use PDO;
use PDOException;

class DeleteManager extends AbstractManager
{
    public function delete(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM book WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        return $statement->execute();
    }
}
