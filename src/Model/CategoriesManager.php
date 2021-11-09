<?php

namespace App\Model;

class CategoriesManager extends AbstractManager
{
    public const TABLE = 'category';

    /* Insert element aboot the book into bdd */
    public function addCategory(string $information): void
    {
        $information = ucwords(strtolower(trim($information)));
        $statement = $this->pdo->prepare("INSERT INTO category (name) VALUES (:category_name)");
        $statement->bindValue(":category_name", $information, \PDO::PARAM_STR);
        $statement->execute();
    }
}
