<?php

namespace App\Model;

class EmplacementsManager extends AbstractManager
{
    /* Get element about book to choose in form */
    public function selectAll(): array
    {
        $statement = 'SELECT name AS emplacement_name FROM emplacement;';
        return $this->pdo->query($statement)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /* Insert element aboot the book into bdd */ 
    public function setEmplacement(array $information): void
    {
        $statement = $this->pdo->prepare("INSERT INTO emplacement (name) VALUES (:emplacement_name)");
        $statement->bindValue(":emplacement_name", $information['emplacement_name'], \PDO::PARAM_STR);
        $statement->execute();
    }
}

