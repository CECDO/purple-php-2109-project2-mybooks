<?php

namespace App\Controller;

use App\Model\BookManager;

class BookController extends AbstractController
{
    public function recap()
    {
        $booksManager = new BookManager();
        $book = $booksManager->selectAll();
        return $this->twig->render('Books/show.html.twig', ['book' => $book]);
    }
}
