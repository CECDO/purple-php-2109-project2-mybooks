<?php

namespace App\Controller;

use App\Model\DeleteManager;

class DeleteController extends AbstractController
{
    public function delete()
    {
        $deletemanager = new DeleteManager();
        $id = $_GET['id'];
        $deletemanager->delete((int)$id);
        return $this->twig->render('Books/delete.html.twig');
    }
}
