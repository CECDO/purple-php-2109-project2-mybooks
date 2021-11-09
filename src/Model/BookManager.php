<?php

namespace App\Model;

use PDO;

class BookManager extends AbstractManager
{

    public function selectOneById(int $id)
    {
        $query = ('SELECT book.id AS book_id,
        book.title AS book_title, book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name, 
        category.id AS category_id, category.name AS category_name, 
        format.id AS format_id, format.name AS format_name, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name, 
        status.id AS status_id, status.name AS status_name
        FROM book 
        JOIN editor ON book.editor_id = editor.id 
        JOIN category ON book.category_id = category.id 
        JOIN format ON Book.format_id = format.id
        JOIN location ON book.location_id = location.id 
        JOIN author ON book.author_id = author.id 
        JOIN status ON book.status_id = status.id
        WHERE book.id=:id');
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function update(array $book): bool
    {
        $statement = $this->pdo->prepare('UPDATE Book SET 
        `title` = :title,
        `author_id` = :author_id,
        `editor_id` = :editor_id,
        `category_id` = :category_id,
        `format_id` = :format_id,
        `release_date` = :release_date,
        `location_id` = :location_id,
        `status_id` = :status_id
        WHERE id=:id');
        $statement->bindValue('id', $book['id'], \PDO::PARAM_INT);
        $statement->bindValue(':title', $book['title'], \PDO::PARAM_STR);
        $statement->bindValue(':author_id', $book['author'], \PDO::PARAM_STR);
        $statement->bindValue(':editor_id', $book['editor'], \PDO::PARAM_STR);
        $statement->bindValue(':category_id', $book['category'], \PDO::PARAM_STR);
        $statement->bindValue(':format_id', $book['format'], \PDO::PARAM_STR);
        $statement->bindValue(':release_date', $book['release_date'], \PDO::PARAM_STR);
        $statement->bindValue(':location_id', $book['location'], \PDO::PARAM_STR);
        $statement->bindValue(':status_id', $book['status'], \PDO::PARAM_STR);
        return $statement->execute();
    }

    public function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
