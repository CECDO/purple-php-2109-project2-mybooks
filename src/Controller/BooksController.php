<?php

namespace App\Controller;

use App\Model\BooksManager;

class BooksController extends AbstractController
{
    public function show(int $id)
    {
        $booksManager = new BooksManager();
        $show = $booksManager->selectOneById($id);
        return $this->twig->render('Books/show.html.twig', ['show' => $show]);
    }
}
