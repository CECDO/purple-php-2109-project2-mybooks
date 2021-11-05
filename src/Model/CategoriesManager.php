<?php

namespace App\Model;
use PDO;
class CategoriesManager extends AbstractManager
{
    public function selectAll(){
        $query = ('SELECT category.name AS category_name FROM category');
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }



}
