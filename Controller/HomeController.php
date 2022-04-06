<?php

use App\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Redirected to home page
     */
    public function index()
    {
        $this->render('home/index');
    }
}