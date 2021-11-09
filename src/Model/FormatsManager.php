<?php

namespace App\Model;

class FormatsManager extends AbstractManager
{
    public const TABLE = 'format';

    /* Insert element aboot the book into bdd */
    public function setCategory(array $information): void
    {
        $statement = $this->pdo->prepare("INSERT INTO format (name) VALUES (:category_name)");
        $statement->bindValue(":category_name", $information['category_name'], \PDO::PARAM_STR);
        $statement->execute();
    }
}
