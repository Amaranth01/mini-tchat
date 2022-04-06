<?php

namespace App;

use App\Controller\AbstractController;

class ErrorController extends AbstractController
{
    /**
     * Control the error page.
     * @return void
     */
    public function error404()
    {
        $this->render('error/404');
    }
}