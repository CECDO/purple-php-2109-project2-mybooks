<?php

namespace App\Model;

class StatusManager extends AbstractManager
{
    /* Get element about book to choose in form */
    public function selectAll(): array
    {
        $statement = 'SELECT id AS status_id, name AS status_name FROM status;';
        return $this->pdo->query($statement)->fetchAll(\PDO::FETCH_ASSOC);
    }
}

