<?php

namespace App\Controller;

use App\Model\BooksManager;
use App\Model\EmplacementsManager;
use App\Model\AuthorsManager;
use App\Model\EditorsManager;
use App\Model\CategoriesManager;
use App\Model\FormatsManager;

class BooksController extends AbstractController
{

    public function edit(int $id)
    {
        $booksManager = new BooksManager();
        $status = $booksManager->selectStatus();
        $books = $booksManager->selectOneById($id);

        $euthorsManager = new AuthorsManager();
        $authors = $euthorsManager->selectAll();

        $editorsManager = new EditorsManager();
        $editors = $editorsManager->selectAll();

        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectAll();

        $formatsManager = new FormatsManager();
        $formats = $formatsManager->selectAll();

        $emplacementsManager = new EmplacementsManager();
        $emplacements = $emplacementsManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book = array_map('trim', $_POST);
            $booksManager->update($book);
            header('Location: ../books/');
        }
        return $this->twig->render('Books/edit.html.twig', [
        'book' => $books,
        'authors' => $authors,
        'editors' => $editors,
        'categories' => $categories,
        'status' => $status,
        'formats' => $formats,
        'emplacements' => $emplacements,
        ]);
    }
    public function index()
    {
        $booksManager = new BooksManager();
        $book = $booksManager->selectAll();
        return $this->twig->render('Books/index.html.twig', ['book' => $book]);
    }
}
