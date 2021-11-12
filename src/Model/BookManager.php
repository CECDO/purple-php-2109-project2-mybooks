<?php

namespace App\Model;

class BookManager extends AbstractManager
{
    public const TABLE = 'book';

    public function selectAllComplete(): array
    {
        $statement = 'SELECT 
        book.id AS book_id, 
        book.title AS book_title, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name,
        status.id AS status_id, status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id';
        return $this->pdo->query($statement)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function bookFilterAll(array $items): array
    {
        $query = 'SELECT
        book.id AS book_id, 
        book.title AS book_title, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name,
        status.id AS status_id, status.name AS status_name
        FROM ' . static::TABLE . '
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id
        WHERE author_id' . $items['author_id'] . '
        AND editor_id' . $items['editor_id'] . '
        AND category_id' . $items['category_id'] . '
        AND format_id' . $items['format_id'] . '
        AND location_id' . $items['location_id'] . '
        AND status_id' . $items['status_id'] . '
        ;';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}
