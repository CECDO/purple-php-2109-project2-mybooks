<?php

namespace App\Model;

class AuthorsManager extends AbstractManager
{
    /* Get element about book to choose in form */
    public function selectAll(): array
    {
        $statement = 'SELECT id AS authors_id, name AS authors_name FROM author;';
        return $this->pdo->query($statement)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /* Insert element aboot the book into bdd */
    public function setAuthors(array $information): void
    {
        $statement = $this->pdo->prepare("INSERT INTO author (name) VALUES (:author_name)");
        $statement->bindValue(":author_name", $information['author_name'], \PDO::PARAM_STR);
        $statement->execute();
    }
}

