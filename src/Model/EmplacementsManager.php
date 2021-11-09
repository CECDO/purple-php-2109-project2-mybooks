<?php

namespace App\Model;

class EmplacementsManager extends AbstractManager
{
    /* Get element about book to choose in form */
    public const TABLE = 'emplacement';

    /* Insert element aboot the book into bdd */
    public function addEmplacement(string $information): void
    {
        $information = ucwords(strtolower(trim($information)));
        $statement = $this->pdo->prepare("INSERT INTO emplacement (name) VALUES (:emplacement_name)");
        $statement->bindValue(":emplacement_name", $information, \PDO::PARAM_STR);
        $statement->execute();
    }
}
