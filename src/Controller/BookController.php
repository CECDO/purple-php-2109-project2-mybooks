<?php

namespace App\Controller;

use App\Model\BookManager;
use App\Model\LocationManager;
use App\Model\AuthorManager;
use App\Model\EditorManager;
use App\Model\CategoryManager;
use App\Model\FormatManager;
use App\Model\StatusManager;

class BookController extends AbstractController
{

    public function edit(int $id)
    {
        $bookManager = new BookManager();

        $book = $bookManager->selectOneById($id);

        $authorManager = new AuthorManager();
        $authors = $authorManager->selectAll();

        $editorManager = new EditorManager();
        $editors = $editorManager->selectAll();

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAll();

        $formatManager = new FormatManager();
        $formats = $formatManager->selectAll();

        $locationManager = new LocationManager();
        $locations = $locationManager->selectAll();

        $statusManager = new StatusManager();
        $status = $statusManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book = array_map('trim', $_POST);
            $bookManager->update($book);
            header('Location: /');
        }
        return $this->twig->render('Books/edit.html.twig', [
        'book' => $book,
        'authors' => $authors,
        'editors' => $editors,
        'categories' => $categories,
        'formats' => $formats,
        'locations' => $locations,
        'status' => $status
        ]);
    }
    public function index()
    {
        $bookManager = new BookManager();
        $books = $bookManager->selectAllComplete();
        return $this->twig->render('Books/index.html.twig', ['books' => $books]);
    }
}
