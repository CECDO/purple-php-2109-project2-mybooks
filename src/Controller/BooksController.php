<?php

namespace App\Controller;

use App\Model\AddManager;
use App\Model\BooksManager;
use App\Model\AuthorsManager;
use App\Model\EditorsManager;
use App\Model\CategoriesManager;
use App\Model\FormatsManager;
use App\Model\EmplacementsManager;
use App\Model\StatusManager;


class BooksController extends AbstractController
{
    /**
     * List items
     */
    public function addBook(): string
    {
        $authors = new AuthorsManager;
        $authors = $authors->selectAll();

        $editors = new EditorsManager;
        $editors = $editors->selectAll();
        
        $categories = new CategoriesManager;
        $categories = $categories->selectAll();

        $formats = new FormatsManager;
        $formats = $formats->selectAll();

        $emplacements = new EmplacementsManager;
        $emplacements = $emplacements->selectAll();

        $status = new StatusManager;
        $status = $status->selectAll();

        var_dump($formats);


    
        return $this->twig->render('Books/addBook.html.twig', [ 'authors' => $authors, 'editors' => $editors, 'categories' => $categories, 'formats' => $formats, 'emplacements' => $emplacements, 'status' => $status]);

    }

    /* ADD Author, Editor, Category or Emplacement */
    /* public function addInformation(): string
    {
        $BookManager = new BookManager;

        $authors = $BookManager->getAuthor();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $informations = array_map('trim', $_POST);
            foreach($informations as $key => $information) {
                $informations[$key] = ucwords(strtolower($information));
            }
            $authors = $BookManager->getAuthor();
            var_dump($authors);

            foreach($authors as $author) {
                var_dump($author);
                if (in_array($informations['author_name'], $author)) {
                    $errors[] = 'Cet auteur existe déjà';
                }
            }

            if(empty($errors)) {
                $BookManager->setAuthor($informations);
            }
            
            var_dump($errors);
            
            if (!empty($informations['editor_name'])) {
                $BookManager->setEditor($informations);
            }
            if (!empty($informations['category_name'])) {
                $BookManager->setCategory($informations);
            }
            if (!empty($informations['emplacement_name'])) {
                $BookManager->setEmplacement($informations);
            }           
        } 
        return $this->twig->render('Books/addInformation.html.twig',);
    } */
}
