<?php

namespace App\Model;

use App\Model\BookManager;

class VerificationProcess extends AbstractManager
{
    public function testInputVerification()
    {
        if (!empty($_POST)) {
            $items = [
                'id' => intval($_POST['id']),
                'title' => ucwords(trim($_POST['title'])),
                'author' => $_POST['author'],
                'editor' => $_POST['editor'],
                'category' => $_POST['category'],
                'format' => $_POST['format'],
                'release_date' => $_POST['release_date'],
                'location' => $_POST['location'],
                'status' => $_POST['status']
                ];
            $errors = [];
            foreach ($items as $item) {
                if (empty($item)) {
                    $errors[] = 'Empty value';
                }
            }
            if (empty($errors)) {
                $booksManager = new BookManager();
                $booksManager->update($items);
            } else {
                return $errors;
            }
        }
    }
}
