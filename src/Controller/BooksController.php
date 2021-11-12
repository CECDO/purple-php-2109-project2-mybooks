<?php

namespace App\Controller;

use App\Model\BooksManager;

class BooksController extends AbstractController
{
    public function book()
    {
        $bookManager = new BooksManager();
        $book = $bookManager->selectOneByIdWithEditorCategoryFormatLocationAuthorAndStatus();
        return $this->twig->render('Book/book.html.twig', ['book' => $book]);
    }
}
