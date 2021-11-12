<?php

namespace App\Controller;

use App\Model\BookManager;
use App\Model\LocationManager;
use App\Model\AuthorManager;
use App\Model\EditorManager;
use App\Model\CategoryManager;
use App\Model\FormatManager;
use App\Model\StatusManager;
use App\Model\VerificationProcess;

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

        if (!empty($_POST)) {
            $verification  = new VerificationProcess();
            $book = $verification->TestInputVerification();
        }
        return $this->twig->render('Book/edit.html.twig', [
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
        return $this->twig->render('Book/index.html.twig', ['books' => $books]);
    }
}
