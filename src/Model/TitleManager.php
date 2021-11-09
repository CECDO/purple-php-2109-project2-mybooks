<?php

namespace App\Model;

class TitleManager extends AbstractManager
{

    /* Insert element aboot the book into bdd */

    public function setTitle(array $information): void
    {
        $statement = $this->pdo->prepare("INSERT INTO Book (name) VALUES (:title)");
        $statement->bindValue(":title", $information, \PDO::PARAM_STR);
        $statement->execute();
    }
}
