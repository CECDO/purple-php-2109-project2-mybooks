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
        $BooksManager = new BooksManager();
        $books = $BooksManager->selectOneById($id);
        $EmplacementsManager = new EmplacementsManager();
        $emplacements = $EmplacementsManager->selectAll();
        $AuthorsManager = new AuthorsManager();
        $authors = $AuthorsManager->selectAll();
        $EditorsManager = new EditorsManager();
        $editors = $EditorsManager->selectAll();
        $BooksManager = new BooksManager();
        $status = $BooksManager->selectStatus();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book = array_map('trim', $_POST);
            $BooksManager->update($book);
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
        $BooksManager = new BooksManager();
        $book = $BooksManager->selectAll();
        return $this->twig->render('Books/index.html.twig', ['book' => $book]);
    }

}