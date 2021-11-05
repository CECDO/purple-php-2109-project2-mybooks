<?php

namespace App\Model;

class BooksManager extends AbstractManager
{
    /* Get element about book to choose in form */


    /* Insert element aboot the book into bdd */

    public function setBook(array $properties): void
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO book 
        (title, release_date, added_date, author_id, category_id, format_id, editor_id, emplacement_id, status_id)
        VALUES (:title, :release_date, NOW() ,:author, :category, :format, :editor, :emplacement, :status)");
        $statement->bindValue(':title', $properties[':title'], \PDO::PARAM_STR);
        $statement->bindValue(':release_date', $properties['release_date'], \PDO::PARAM_STR);
        $statement->bindValue(':author', $properties['author'], \PDO::PARAM_INT);
        $statement->bindValue(':category', $properties['category'], \PDO::PARAM_INT);
        $statement->bindValue(':format', $properties['format'], \PDO::PARAM_INT);
        $statement->bindValue(':editor', $properties['editor'], \PDO::PARAM_INT);
        $statement->bindValue(':emplacement', $properties['emplacement'], \PDO::PARAM_INT);
        $statement->bindValue(':status', $properties['status'], \PDO::PARAM_INT);
        $statement->execute();
    }

}

