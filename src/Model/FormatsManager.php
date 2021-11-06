<?php

namespace App\Model;

use PDO;

class FormatsManager extends AbstractManager
{
    public function selectAll()
    {
        $query = ('SELECT format.id AS format_id, format.name AS format_name FROM format');
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
