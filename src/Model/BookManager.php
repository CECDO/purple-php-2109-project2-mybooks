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
    
            /* Insert element aboot the book into bdd */
    public function addBook(array $properties): void
    {
        $statement = $this->pdo->prepare("INSERT INTO book 
        (cover_page, title, release_date, added_date, author_id, category_id,
        format_id, editor_id, location_id, status_id)
        VALUES (:cover_page, :title, :release_date, NOW()
        ,:author, :category, :format, :editor, :location, :status)");
        $statement->bindValue(':cover_page', $properties['cover_page'], \PDO::PARAM_STR);
        $statement->bindValue(':title', $properties['title'], \PDO::PARAM_STR);
        $statement->bindValue(':release_date', $properties['release_date'], \PDO::PARAM_STR);
        $statement->bindValue(':author', $properties['author'], \PDO::PARAM_INT);
        $statement->bindValue(':category', $properties['category'], \PDO::PARAM_INT);
        $statement->bindValue(':format', $properties['format'], \PDO::PARAM_INT);
        $statement->bindValue(':editor', $properties['editor'], \PDO::PARAM_INT);
        $statement->bindValue(':location', $properties['location'], \PDO::PARAM_INT);
        $statement->bindValue(':status', $properties['status'], \PDO::PARAM_INT);
        $statement->execute();
    }
}

