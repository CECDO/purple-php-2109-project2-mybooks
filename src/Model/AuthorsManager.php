<?php

namespace App\Model;
use PDO;
class AuthorsManager extends AbstractManager
{
    public function selectAll(){
        $query = ('SELECT author.id AS author_id, author.name AS author_name FROM author');
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }



}
