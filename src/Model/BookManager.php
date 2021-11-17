<?php

namespace App\Model;

class BookManager extends AbstractManager
{
    public const TABLE = "book";

    /* Insert element about the book into bdd */
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

    public function selectOneById(int $id)
    {
        $query = ('SELECT book.id AS book_id,
        book.title AS book_title, book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name, 
        category.id AS category_id, category.name AS category_name, 
        format.id AS format_id, format.name AS format_name, 
        location.id AS location_id, location.name AS location_name, 
        author.id AS author_id, author.name AS author_name, 
        status.id AS status_id, status.name AS status_name,
        cover_page
        FROM book 
        JOIN editor ON book.editor_id = editor.id 
        JOIN category ON book.category_id = category.id 
        JOIN format ON book.format_id = format.id
        JOIN location ON book.location_id = location.id 
        JOIN author ON book.author_id = author.id 
        JOIN status ON book.status_id = status.id
        WHERE book.id=:id');
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function update(array $items): void
    {
        $statement = $this->pdo->prepare('UPDATE book SET 
        `title` = :title,
        `author_id` = :author_id,
        `editor_id` = :editor_id,
        `category_id` = :category_id,
        `format_id` = :format_id,
        `release_date` = :release_date,
        `location_id` = :location_id,
        `status_id` = :status_id
        WHERE id=:id');
        $statement->bindValue(':id', $items['id'], \PDO::PARAM_INT);
        $statement->bindValue(':title', $items['title'], \PDO::PARAM_STR);
        $statement->bindValue(':author_id', $items['author'], \PDO::PARAM_STR);
        $statement->bindValue(':editor_id', $items['editor'], \PDO::PARAM_STR);
        $statement->bindValue(':category_id', $items['category'], \PDO::PARAM_STR);
        $statement->bindValue(':format_id', $items['format'], \PDO::PARAM_STR);
        $statement->bindValue(':release_date', $items['release_date'], \PDO::PARAM_STR);
        $statement->bindValue(':location_id', $items['location'], \PDO::PARAM_STR);
        $statement->bindValue(':status_id', $items['status'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectAllBookId(): array
    {
        $statement = $this->pdo->prepare("SELECT id FROM book");
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectOneByIdWithForeignKeys(int $id)
    {
        $statement = $this->pdo->prepare('SELECT book.id AS book_id,
        book.title AS book_title,
        book.release_date,
        book.cover_page,
        editor.name AS editor_name,
        category.name AS category_name,
        format.name AS format_name,
        location.name AS location_name,
        author.name AS author_name,
        status.name AS status_name
        FROM book
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

    public function selectAllCompleteOrdered(array $sort): array
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
