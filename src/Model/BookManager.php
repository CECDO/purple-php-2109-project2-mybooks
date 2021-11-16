<?php

namespace App\Model;

class BookManager extends AbstractManager
{
    public const TABLE = 'book';

    public function selectAllComplete(array $sort): array
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
        JOIN status ON book.status_id = status.id
        ORDER BY ' . $sort['field'] . ' ' . $sort['direction'] . '
        ;';
        return $this->pdo->query($statement)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function bookFilterAll(array $items, array $sort): array
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
        ORDER BY ' . $sort['field'] . ' ' . $sort['direction'] . '
        ;';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }


    public function selectByUnCompleteTitle(string $titlePart): array
    {
        $query = "SELECT 
        book.id AS book_id, 
        book.title AS book_title, 
        location.id AS location_id, 
        location.name AS location_name, 
        author.id AS author_id, 
        author.name AS author_name,
        status.id AS status_id, 
        status.name AS status_name
        FROM " . static::TABLE . "
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id 
        WHERE book.title LIKE CONCAT('%', :part, '%')
        ;";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':part', $titlePart, \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
