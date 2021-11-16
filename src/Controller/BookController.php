<?php

namespace App\Controller;

use App\Model\BookManager;

class BookController extends AbstractController
{
    public function book()
    {
        $bookManager = new BookManager();
        $booksId = $bookManager->selectAllBookId();

        if (array_search($_GET['id'], array_column($booksId, 'id'))) {
            $bookManager = new BookManager();
            $book = $bookManager->selectOneByIdWithForeignKeys($_GET['id']);
            return $this->twig->render('Book/book.html.twig', ['book' => $book]) ;
        } else {
            header('Location: /');
        }
    }
}
