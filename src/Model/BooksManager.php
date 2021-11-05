<?php
//SELECT Book.id, Book.title, Book.release_date, Book.added_date, Book.cover_page, Editor.name AS editor_name, Emplacement.name AS emplacement_name, Status.name AS status_name FROM Book JOIN Editor ON Book.Editor_id = Editor.id JOIN Emplacement ON Book.Emplacement_id = Emplacement.id JOIN Status ON Book.Status_id = Status.id;

namespace App\Model;
use PDO;

class BooksManager extends AbstractManager
{
    public function selectAll(): array
    {
        $statement = 'SELECT book.id AS book_id, book.title
        AS book_title, book.release_date, editor.name
        AS editor_name, category.name
        AS category_name, format.name
        AS format_name, emplacement.name
        AS emplacement_name, author.name
        AS author_name, status.name
        AS status_name
        FROM book
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON Book.format_id = format.id
        JOIN emplacement ON book.emplacement_id = emplacement.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id';
        return $this->pdo->query($statement)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectOneById(int $id)
    {
        $query = ('SELECT book.id AS book_id, 
        book.title AS book_title, book.release_date, 
        editor.id AS editor_id, editor.name AS editor_name, 
        category.name AS category_name, 
        format.name AS format_name, 
        emplacement.name AS emplacement_name, author.name AS author_name, status.name AS status_name
        FROM book 
        JOIN editor ON book.editor_id = editor.id 
        JOIN category ON book.category_id = category.id 
        JOIN format ON Book.format_id = format.id
        JOIN emplacement ON book.emplacement_id = emplacement.id 
        JOIN author ON book.author_id = author.id 
        JOIN status ON book.status_id = status.id
        WHERE book.id=:id');
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
    public function selectStatus()
    {
        $query = ('SELECT status.name AS status_name FROM status');
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(array $book): bool
    {
        $statement = $this->pdo->prepare('UPDATE Book SET `title` = :title, `editor_id` = :editor_id, `release_date` = :release_date WHERE id=:id');
        $statement->bindValue('id', $book['id'], \PDO::PARAM_INT);
        $statement->bindValue(':title', $book['title'], \PDO::PARAM_STR);
        $statement->bindValue(':editor_id', $book['editor'], \PDO::PARAM_STR);
        $statement->bindValue(':release_date', $book['release_date'], \PDO::PARAM_STR);

        
        return $statement->execute();
    }

    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


}