<?php

namespace App\Model;

class EditorManager extends AbstractManager
{
    public const TABLE = 'editor';

    /* Insert element aboot the book into bdd */
    public function addEditor(string $information): void
    {
        $information = ucwords(strtolower(trim($information)));
        $statement = $this->pdo->prepare("INSERT INTO editor (name) VALUES (:editor_name)");
        $statement->bindValue(":editor_name", $information, \PDO::PARAM_STR);
        $statement->execute();
    }
}
