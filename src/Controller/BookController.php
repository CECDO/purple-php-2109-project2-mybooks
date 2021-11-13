<?php

namespace App\Controller;

use App\Model\BookManager;
use App\Model\AuthorManager;
use App\Model\EditorManager;
use App\Model\CategoryManager;
use App\Model\FormatManager;
use App\Model\LocationManager;
use App\Model\StatusManager;
use App\Model\FormProcessing;

class BookController extends AbstractController
{
    public function dashboard()
    {
        $bookManager = new BookManager();

        $authorManager = new authorManager();
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

        $form = new FormProcessing();
        $sort = $form->verifyGetToSort();


        if (!empty($_GET)) {
            
            $items = $form->verifyGetToFilter();
            $books = $bookManager->bookFilterAll($items, $sort);
        } else {
            var_dump($sort);
            $books = $bookManager->selectAllComplete($sort);
        }



        return $this->twig->render('Dashboard/index.html.twig', [
            'authors' => $authors,
            'editors' => $editors,
            'categories' => $categories,
            'formats' => $formats,
            'locations' => $locations,
            'status' => $status,
            'books' => $books,
        ]);
    }
}
