<?php

namespace App\Controller;

use App\Model\BooksManager;

class BooksController extends AbstractController
{
    public function books(int $id)
    {
        $booksManager = new BooksManager();
        $book = $booksManager->selectOneById($id);
        return $this->twig->render('Books/show.html.twig', ['book' => $book]);
    }
}
