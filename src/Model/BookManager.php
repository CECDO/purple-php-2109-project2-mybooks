<?php

namespace App\Model;

use PDO;

class BookManager extends AbstractManager
{
    public const TABLE = 'book';

    public function selectAllComplete(): array
    {
        $statement = 'SELECT 
        book.id AS book_id, 
        book.title AS book_title, 
        book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name,
        category.id AS category_id, category.name AS category_name, 
        format.id AS format_id, format.name AS format_name, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name,
        status.id AS status_id, status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON Book.format_id = format.id
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id';
        return $this->pdo->query($statement)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filterEditorId(int $id)
    {
        $query = 'SELECT
        book.id AS book_id, 
        book.title AS book_title, 
        book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name,
        category.id AS category_id, category.name AS category_name, 
        format.id AS format_id, format.name AS format_name, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name,
        status.id AS status_id, status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON Book.format_id = format.id
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id WHERE editor.id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function filterAuthorId(int $id)
    {
        $query = 'SELECT
        book.id AS book_id, 
        book.title AS book_title, 
        book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name,
        category.id AS category_id, category.name AS category_name, 
        format.id AS format_id, format.name AS format_name, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name,
        status.id AS status_id, status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON Book.format_id = format.id
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id WHERE author.id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function filterCategoryId(int $id)
    {
        $query = 'SELECT
        book.id AS book_id, 
        book.title AS book_title, 
        book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name,
        category.id AS category_id, category.name AS category_name, 
        format.id AS format_id, format.name AS format_name, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name,
        status.id AS status_id, status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON Book.format_id = format.id
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id WHERE category.id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function filterFormatId(int $id)
    {
        $query = 'SELECT
        book.id AS book_id, 
        book.title AS book_title, 
        book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name,
        category.id AS category_id, category.name AS category_name, 
        format.id AS format_id, format.name AS format_name, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name,
        status.id AS status_id, status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON Book.format_id = format.id
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id WHERE format.id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function filterLocationId(int $id)
    {
        $query = 'SELECT
        book.id AS book_id, 
        book.title AS book_title, 
        book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name,
        category.id AS category_id, category.name AS category_name, 
        format.id AS format_id, format.name AS format_name, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name,
        status.id AS status_id, status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON Book.format_id = format.id
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id WHERE location.id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function filterStatusId(int $id)
    {
        $query = 'SELECT
        book.id AS book_id, 
        book.title AS book_title, 
        book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name,
        category.id AS category_id, category.name AS category_name, 
        format.id AS format_id, format.name AS format_name, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name,
        status.id AS status_id, status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON Book.format_id = format.id
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id WHERE status.id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}
