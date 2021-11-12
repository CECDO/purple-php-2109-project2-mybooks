<?php

namespace App\Model;

use App\Model\BookManager;

class VerificationProcess extends AbstractManager
{
    public function testInputVerification(array $book)
    {
        $book = $_POST;
        $formverif = $book['title'] && $book['author'] && $book['editor']
        && $book['category'] && $book['format']
        && $book['release_date'] && $book['location'] && $book['status'];
        if (!empty($formverif)) {
            $bookManager = new BookManager();
            $bookManager->update($book);
            header("Location: /");
        } else {
            echo 'Merci de remplir tout les champs';
            header("Location: /");
        }
    }
}
