<?php

namespace App\Model;

use App\Model\AbstractManager;

class BookManager extends AbstractManager
{
    public const TABLE = "book";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
