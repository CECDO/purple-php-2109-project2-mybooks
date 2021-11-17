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
use App\Model\FormProcessing;

class BookController extends AbstractController
{
    public function addBook(): string
    {
        /**
         * ! GET ELEMENT FOR LIST IN FORM
         */
        $authorsManager = new AuthorManager();
        $authors = $authorsManager->selectAll('name');

        $editorsManager = new EditorManager();
        $editors = $editorsManager->selectAll('name');

        $categoriesManager = new CategoryManager();
        $categories = $categoriesManager->selectAll('name');

        $formatsManager = new FormatManager();
        $formats = $formatsManager->selectAll('id');

        $locationsManager = new LocationManager();
        $locations = $locationsManager->selectAll('name');

        $statusManager = new StatusManager();
        $status = $statusManager->selectAll('id');

        /**
         * ! PUT THE BOOK IN DBB
         */
        $formProcessing = new FormProcessing();
        $errors = [];

        $errors = $formProcessing->verifyEmptyPost();

        if (empty($errors) && !empty($_FILES['avatar'])) {
            $path = $formProcessing->coverPage();
            $formProcessing->addBooktoDB($path);
        }

        return $this->twig->render('Books/addBook.html.twig', [
            'authors' => $authors, 'editors' => $editors, 'categories' => $categories, 'formats' => $formats,
            'locations' => $locations, 'status' => $status, 'errors' => $errors
        ]);
    }

    /**
     * ! ADD AUTHOR
     */
    public function addAuthor(): string
    {
        $errors = [];

        if (!empty($_POST['author_name'])) {
            $formProcessing = new FormProcessing();
            $errors = $formProcessing->verifyAndAddAuthor();
        }
        return $this->twig->render('Authors/addAuthor.html.twig', ['errors' => $errors]);
    }

    /**
     * ! ADD EDITOR
     */
    public function addEditor(): string
    {
        $errors = [];
        if (!empty($_POST['editor_name'])) {
            $formProcessing = new FormProcessing();
            $errors = $formProcessing->verifyAndAddEditor();
        }
        return $this->twig->render('Editors/addEditor.html.twig', ['errors' => $errors]);
    }

    /**
     * ! ADD CATEGORY
     */
    public function addCategory(): string
    {
        $errors = [];
        if (!empty($_POST['category_name'])) {
            $formProcessing = new FormProcessing();
            $errors = $formProcessing->verifyAndAddCategory();
        }
        return $this->twig->render('Categories/addCategory.html.twig', ['errors' => $errors]);
    }

    /**
     * ! ADD LOCATION
     */
    public function addLocation(): string
    {
        $errors = [];
        if (!empty($_POST['location_name'])) {
            $formProcessing = new FormProcessing();
            $errors = $formProcessing->verifyAndAddLocation();
        }
        return $this->twig->render('Locations/addLocation.html.twig', ['errors' => $errors]);
    }

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
        $errors = [];
        if (!empty($_POST)) {
            $verification  = new VerificationProcess();
            $errors = $verification->TestInputVerification();
        }
        return $this->twig->render('Book/edit.html.twig', [
            'errors' => $errors,
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
