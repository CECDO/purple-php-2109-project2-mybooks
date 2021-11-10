<?php

namespace App\Controller;

use App\Model\BookManager;

class BookController extends AbstractController
{
    public function recap()
    {
        $searchManager = new BookManager();
        $search = $searchManager->selectAll();
        return $this->twig->render('Books/show.html.twig', ['search' => $search]);
    }
}
