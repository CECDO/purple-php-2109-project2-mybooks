<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */

namespace App\Model;

class FormProcessing
{
    /**
     * ! ADD THE COVER PAGE
     */
    public function coverPage(): string
    {
        $errors = [];
        $uploadDir = 'assets/cover_page/';
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $uploadFile = $uploadDir . uniqid("", false) . "." . $extension;

        $authorizedExtensions = ['jpg', 'png', 'gif', 'webp'];
        $maxFileSize = 1000000;

        if ((!in_array($extension, $authorizedExtensions))) {
            $errors = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
            return $errors;
        }

        if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
            $errors = "Votre fichier doit faire moins de 2M !";
            return $errors;
        }
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
        return $uploadFile;
    }

    /**
     * ! VERIFY IF $_POST IS EMPTY
     */
    public function verifyEmptyPost(): array
    {
        $errors = [];
        foreach ($_POST as $value) {
            if (empty(trim($value))) {
                $errors[] = 'Merci de remplir tous les champs';
            }
        }
        return $errors;
    }

    /**
     * ! ADD THE BOOK TO DB
     */
    public function addBooktoDB(string $path): void
    {
        $book = new BookManager();

        $items = [
            'cover_page' => $path,
            'title' => ucwords(strtolower(trim($_POST['title']))),
            'author' => $_POST['author'],
            'release_date' => $_POST['release_date'],
            'editor' => $_POST['editor'],
            'category' => $_POST['category'],
            'format' => $_POST['format'],
            'location' => $_POST['location'],
            'status' => $_POST['status'],
        ];

        $book->addBook($items);
        header('Location: /book/add');
    }

    /**
     * ! VERIFY AND ADD AUTHOR TO DB
     */
    public function verifyAndAddAuthor(): array
    {
        $authorsManager = new AuthorManager();
        $elements = $authorsManager->selectAll();

        $errors = [];
        $item = ucwords(strtolower(trim($_POST['author_name'])));
        foreach ($elements as $element) {
            if (in_array($item, $element)) {
                $errors[] = 'Cet auteur existe déjà';
            }
        }
        if (empty($errors)) {
            if (!empty($item)) {
                $authorsManager->addAuthor($item);
                header('Location: /book/add');
                return $errors;
            } else {
                $errors[0] = 'Veuillez remplir le champ auteur';
                return $errors;
            }
        } else {
            return $errors;
        }
    }

    /**
     * ! VERIFY AND ADD EDITOR TO DB
     */
    public function verifyAndAddEditor(): array
    {
        $editorsManager = new EditorManager();
        $elements = $editorsManager->selectAll();

        $errors = [];
        $item = ucwords(strtolower(trim($_POST['editor_name'])));
        foreach ($elements as $element) {
            if (in_array($item, $element)) {
                $errors[] = 'Cet éditeur existe déjà';
            }
        }
        if (empty($errors)) {
            if (!empty($item)) {
                $editorsManager->addEditor($item);
                header('Location: /book/add');
                return $errors;
            } else {
                $errors[0] = 'Veuillez remplir le champ editeur';
                return $errors;
            }
        } else {
            return $errors;
        }
    }

    /**
     * ! VERIFY AND ADD CATEGORY TO DB
     */
    public function verifyAndAddCategory(): array
    {
        $categoriesManager = new CategoryManager();
        $elements = $categoriesManager->selectAll();

        $errors = [];
        $item = ucwords(strtolower(trim($_POST['category_name'])));
        foreach ($elements as $element) {
            if (in_array($item, $element)) {
                $errors[] = 'Cet catégorie existe déjà';
            }
        }
        if (empty($errors)) {
            if (!empty($item)) {
                $categoriesManager->addCategory($item);
                header('Location: /book/add');
                return $errors;
            } else {
                $errors[0] = 'Veuillez remplir le champ catégorie';
                return $errors;
            }
        } else {
            return $errors;
        }
    }

    /**
     * ! VERIFY AND ADD LOCATION TO DB
     */
    public function verifyAndAddLocation(): array
    {
        $locationsManager = new LocationManager();
        $elements = $locationsManager->selectAll();

        $errors = [];
        $item = ucwords(strtolower(trim($_POST['location_name'])));
        foreach ($elements as $element) {
            if (in_array($item, $element)) {
                $errors[] = 'Cet emplacement existe déjà';
            }
        }
        if (empty($errors)) {
            if (!empty($item)) {
                $locationsManager->addLocation($item);
                header('Location: /book/add');
                return $errors;
            } else {
                $errors[0] = 'Veuillez remplir le champ emplacement';
                return $errors;
            }
        } else {
            return $errors;
        }
    }
}
