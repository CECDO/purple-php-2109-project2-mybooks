<?php

namespace App\Controller;

use App\Model\BookManager;

class BookController extends AbstractController
{
    public function delete(int $id)
    {
        $deleteManager = new BookManager();
        $deleteManager->delete($id);
        return $this->twig->render('Books/delete.html.twig');
    }
}
