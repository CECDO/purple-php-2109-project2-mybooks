<?php

namespace App\Model;

use App\Model\AuthorsManager;

class BooksManager extends AbstractManager
{
    public const TABLE = 'book';

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
