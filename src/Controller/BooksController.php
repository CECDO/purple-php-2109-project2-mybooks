<?php

namespace App\Controller;

use App\Model\BooksManager;
use App\Model\EmplacementsManager;
use App\Model\AuthorsManager;
use App\Model\EditorsManager;
use App\Model\CategoriesManager;

class BooksController extends AbstractController
{
    public function edit(int $id)
    {
        $booksManager = new BooksManager();
        $books = $booksManager->selectOneById($id);
        $emplacementsManager = new EmplacementsManager();
        $emplacements = $emplacementsManager->selectAll();
        $euthorsManager = new AuthorsManager();
        $authors = $euthorsManager->selectAll();
        $editorsManager = new EditorsManager();
        $editors = $editorsManager->selectAll();
        $booksManager = new BooksManager();
        $status = $booksManager->selectStatus();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book = array_map('trim', $_POST);
            $booksManager->update($book);
            header('Location: ../books/');
        }
        return $this->twig->render('Books/edit.html.twig', ['book' => $books,
        'emplacements' => $emplacements,
        'authors' => $authors,
        'editors' => $editors,
        'status' => $status]);
    }
    public function index()
    {
        $booksManager = new BooksManager();
        $book = $booksManager->selectAll();
        return $this->twig->render('Books/index.html.twig', ['book' => $book]);
    }
}
