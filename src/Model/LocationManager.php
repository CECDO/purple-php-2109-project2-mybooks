<?php

namespace App\Model;

class LocationManager extends AbstractManager
{
    /* Get element about book to choose in form */
    public const TABLE = 'location';

    /* Insert element aboot the book into bdd */
    public function addLocation(string $information): void
    {
        $information = ucwords(strtolower(trim($information)));
        $statement = $this->pdo->prepare("INSERT INTO location (name) VALUES (:location_name)");
        $statement->bindValue(":location_name", $information, \PDO::PARAM_STR);
        $statement->execute();
    }
}
