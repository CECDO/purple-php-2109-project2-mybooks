<?php

namespace App\Model;

use PDO;

class StatusManager extends AbstractManager
{
    public function selectAll()
    {
        $query = ('SELECT status.id AS status_id, status.name AS status_name FROM status');
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
