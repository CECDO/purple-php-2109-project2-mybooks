<?php

namespace App\Controller;

use App\Model\BookManager;
use App\Model\AuthorManager;
use App\Model\EditorManager;
use App\Model\CategoryManager;
use App\Model\FormatManager;
use App\Model\LocationManager;
use App\Model\StatusManager;

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

        if (!empty($_GET['author_id'])) {
            $id = $_GET['author_id'];
            $books = $bookManager->filterAuthorId($id);
        } elseif (!empty($_GET['editor_id'])) {
            $id = $_GET['editor_id'];
            $books = $bookManager->filterEditorId($id);
        } elseif (!empty($_GET['category_id'])) {
            $id = $_GET['category_id'];
            $books = $bookManager->filterCategoryId($id);
        } elseif ((!empty($_GET['format_id']))) {
            $id = $_GET['format_id'];
            $books = $bookManager->filterFormatId($id);
        } elseif ((!empty($_GET['location_id']))) {
            $id = $_GET['location_id'];
            $books = $bookManager->filterLocationId($id);
        } elseif ((!empty($_GET['status_id']))) {
            $id = $_GET['status_id'];
            $books = $bookManager->filterStatusId($id);
        } else {
            $books = $bookManager->selectAllComplete();
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
