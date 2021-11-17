<?php

namespace App\Model;

class AuthorManager extends AbstractManager
{
    public const TABLE = 'author';

    /* Insert element aboot the book into bdd */
    public function addAuthor(string $information): void
    {
        $information = ucwords(strtolower(trim($information)));
        $statement = $this->pdo->prepare("INSERT INTO author (name) VALUES (:author_name)");
        $statement->bindValue(":author_name", $information, \PDO::PARAM_STR);
        $statement->execute();
    }
}
