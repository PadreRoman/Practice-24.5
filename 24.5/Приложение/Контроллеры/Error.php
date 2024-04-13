<?php

namespace App\controllers;
use App\core\Controller;

class Error extends Controller
{
    public function index()
    {
        //echo 'error from controllers';
        $this->view->render('error.phtml', 'template.phtml');
    }
}

?>