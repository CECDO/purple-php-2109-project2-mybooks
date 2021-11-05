<?php

namespace App\Model;

class BooksManager extends AbstractManager
{
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
        JOIN format ON book.format_id = format.id
        JOIN emplacement ON book.emplacement_id = emplacement.id 
        JOIN author ON book.author_id = author.id 
        JOIN status ON book.status_id = status.id
        WHERE book.id=:id');
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
}
