<?php

namespace App\Model;

use PDO;

class BooksManager extends AbstractManager
{
    public function selectOneByIdWithEditorCategoryFormatLocationAuthorAndStatus()
    {
        $statement = 'SELECT book.id AS book_id, book.title
        AS book_title, book.release_date, editor.name
        AS editor_name, category.name
        AS category_name, format.name
        AS format_name, location.name
        AS location_name, author.name
        AS author_name, status.name
        AS status_name
        FROM book
        JOIN editor ON book.editor_id = editor.id
        JOIN category ON book.category_id = category.id
        JOIN format ON Book.format_id = format.id
        JOIN location ON book.location_id = location.id
        JOIN author ON book.author_id = author.id
        JOIN status ON book.status_id = status.id';
        return $this->pdo->query($statement)->fetchAll(PDO::FETCH_ASSOC);
    }
}
