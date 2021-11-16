<?php

namespace App\Model;

use PDO;
use App\Model\AbstractManager;

class BookManager extends AbstractManager
{
    public const TABLE = 'book';

    public function selectOneByIdWithForeignKeys(int $id)
    {
        $statement = $this->pdo->prepare('SELECT book.id AS book_id,
        book.title AS book_title,
        book.release_date,
        editor.name AS editor_name,
        category.name AS category_name,
        format.name AS format_name,
        location.name AS location_name,
        author.name AS author_name,
        status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON book.format_id = format.id
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id
        WHERE book.id=:id');

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function selectAllBookId(): array
    {
        $statement = $this->pdo->prepare("SELECT id FROM " . static::TABLE);
        $statement->execute();

        return $statement->fetchAll();
    }
}
