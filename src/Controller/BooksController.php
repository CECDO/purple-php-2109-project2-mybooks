<?php

namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\Services;
use App\Model\StatusManager;
use App\Model\AuthorsManager;
use App\Model\EditorsManager;
use App\Model\FormatsManager;
use App\Model\CategoriesManager;
use App\Model\EmplacementsManager;

class BooksController extends AbstractController
{

    public function addBook(): string
    {
        /**
         * ! GET ELEMENT FOR LIST IN FORM
         */
        $authorsManager = new AuthorsManager();
        $authors = $authorsManager->selectAll('name');

        $editorsManager = new EditorsManager();
        $editors = $editorsManager->selectAll('name');

        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectAll('name');

        $formatsManager = new FormatsManager();
        $formats = $formatsManager->selectAll('name');

        $emplacementsManager = new EmplacementsManager();
        $emplacements = $emplacementsManager->selectAll('name');

        $statusManager = new StatusManager();
        $status = $statusManager->selectAll('name');


        /**
         * ! PUT THE BOOK IN DBB
         */


        $service = new Services();

        $incompletForm = "";
        $errors = $service->verifyEmptyPost();
        if (empty($errors) && !empty($_FILES['avatar'])) {
            $path = $service->coverPage();
            $service->verifyAndAddBook($path);
        } else {
            $incompletForm = "Merci de remplir le formulaire";
        }

        return $this->twig->render('Books/addBook.html.twig', [
            'authors' => $authors,
            'editors' => $editors, 'categories' => $categories, 'formats' => $formats,
            'emplacements' => $emplacements, 'status' => $status, 'incompletForm' => $incompletForm
        ]);
    }

    /**
     * ! ADD AUTHOR
     */
    public function addAuthor(): string
    {

        $errors = [];
        if (!empty($_POST['author_name'])) {
            $service = new Services();
            $errors = $service->verifyAndAddAuthor();
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
            $service = new Services();
            $errors = $service->verifyAndAddEditor();
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
            $service = new Services();
            $errors = $service->verifyAndAddCategory();
        }
        return $this->twig->render('Categories/addCategory.html.twig', ['errors' => $errors]);
    }

    /**
     * ! ADD EMPLACEMENT
     */
    public function addEmplacement(): string
    {

        $errors = [];
        if (!empty($_POST['emplacement_name'])) {
            $service = new Services();
            $errors = $service->verifyAndAddEmplacement();
        }
        return $this->twig->render('Emplacements/addEmplacement.html.twig', ['errors' => $errors]);
    }
}
