<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Book/index.html.twig');
    }
}
