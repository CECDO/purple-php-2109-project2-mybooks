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

    public function verifyAndAddAuthor(): array
    {
        $authorsManager = new AuthorsManager();
        $elements = $authorsManager->selectAll();

        $errors = [];
        $item = ucwords(strtolower(trim($_POST['author_name'])));
        foreach ($elements as $element) {
            if (in_array($item, $element)) {
                $errors[] = 'Cet auteur existe déjà';
            }
        }
        if (empty($errors)) {
            $authorsManager->addAuthor($_POST['author_name']);
            header('Location: /books/add');
            return $errors;
        } else {
            return $errors;
        }
    }

    public function verifyAndAddEditor(): array
    {
        $editorsManager = new EditorsManager();
        $elements = $editorsManager->selectAll();

        $errors = [];
        $item = ucwords(strtolower(trim($_POST['editor_name'])));
        foreach ($elements as $element) {
            if (in_array($item, $element)) {
                $errors[] = 'Cet éditeur existe déjà';
            }
        }
        if (empty($errors)) {
            $editorsManager->addEditor($_POST['editor_name']);

            header('Location: /books/add');
            return $errors;
        } else {
            return $errors;
        }
    }

    public function verifyAndAddCategory(): array
    {
        $categoriesManager = new CategoriesManager();
        $elements = $categoriesManager->selectAll();

        $errors = [];
        $item = ucwords(strtolower(trim($_POST['category_name'])));
        foreach ($elements as $element) {
            if (in_array($item, $element)) {
                $errors[] = 'Cet catégorie existe déjà';
            }
        }
        if (empty($errors)) {
            $categoriesManager->addCategory($_POST['category_name']);
            header('Location: /books/add');
            return $errors;
        } else {
            return $errors;
        }
    }

    public function verifyAndAddLocation(): array
    {
        $locationsManager = new LocationsManager();
        $elements = $locationsManager->selectAll();

        $errors = [];
        $item = ucwords(strtolower(trim($_POST['location_name'])));
        foreach ($elements as $element) {
            if (in_array($item, $element)) {
                $errors[] = 'Cet emplacement existe déjà';
            }
        }
        if (empty($errors)) {
            $locationsManager->addLocation($_POST['location_name']);
            header('Location: /books/add');
            return $errors;
        } else {
            return $errors;
        }
    }

    public function verifyAndAddBook(string $path): void
    {
        $book = new BooksManager();

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
    }

    public function verifyEmptyPost(): array
    {
        $errors = [];
        foreach ($_POST as $value) {
            if (empty($value)) {
                $errors[] = 'empty';
            }
        }
        return $errors;
    }
}
