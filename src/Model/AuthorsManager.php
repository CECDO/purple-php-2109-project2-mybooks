<?php

namespace App\Model;

class AuthorsManager extends AbstractManager
{
    public const TABLE = 'author';
    /* Get element about book to choose in form */
    /* public function selectAll(): array
    {
        $statement = 'SELECT id AS author_id, name AS author_name FROM author;';
        return $this->pdo->query($statement)->fetchAll(\PDO::FETCH_ASSOC);
    } */

    /* Insert element aboot the book into bdd */
    public function addAuthor(string $information): void
    {
        $information = ucwords(strtolower(trim($information)));
        $statement = $this->pdo->prepare("INSERT INTO author (name) VALUES (:author_name)");
        $statement->bindValue(":author_name", $information, \PDO::PARAM_STR);
        $statement->execute();
    }
}
