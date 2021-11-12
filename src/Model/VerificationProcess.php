<?php

namespace App\Model;

use App\Model\BookManager;

class VerificationProcess extends AbstractManager
{
    public function testInputVerification()
    {
        $formverif = trim($_POST['title']) && $_POST['author'] && $_POST['editor']
        && $_POST['category'] && $_POST['format']
        && $_POST['release_date'] && $_POST['location'] && $_POST['status'];
        if (!empty($formverif)) {
            $bookManager = new BookManager();
            $book = array_map('trim', $_POST);
            $bookManager->update($book);
            header("Location: /");
        } else {
            echo 'Merci de remplir tout les champs';
            header("Location: /");
        }
    }
}
