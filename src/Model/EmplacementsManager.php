<?php

namespace App\Model;
use PDO;
class EmplacementsManager extends AbstractManager
{
    public function selectAll(){
        $query = ('SELECT emplacement.id AS emplacement_id, emplacement.name AS emplacement_name FROM emplacement');
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
     }



}
