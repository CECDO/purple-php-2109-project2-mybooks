<?php

namespace App\Model;

class EditorsManager extends AbstractManager
{
    /* Get element about book to choose in form */
    public function selectAll(): array
    {
        $statement = 'SELECT id AS editor_id, name AS editor_name FROM editor;';
        return $this->pdo->query($statement)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /* Insert element aboot the book into bdd */
    public function setEditor(array $information): void{
        $statement = $this->pdo->prepare("INSERT INTO editor (name) VALUES (:editor_name)");
        $statement->bindValue(":editor_name", $information['editor_name'], \PDO::PARAM_STR);
        $statement->execute();
    }
}

