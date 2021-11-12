<?php

namespace App\Controller;

use App\Model\BookManager;

class BookController extends AbstractController
{
    public function book()
    {
        $bookManager = new BookManager();
        $book = $bookManager->selectOneByIdWithEditorCategoryFormatLocationAuthorAndStatus();
        return $this->twig->render('Book/book.html.twig', ['book' => $book]);
    }
}
