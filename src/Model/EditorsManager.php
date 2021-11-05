<?php

namespace App\Model;

use PDO;

class EditorsManager extends AbstractManager
{
    public function selectAll()
    {
        $query = ('SELECT editor.id AS editor_id, editor.name AS editor_name FROM editor');
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
