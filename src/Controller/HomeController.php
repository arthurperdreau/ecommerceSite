<?php

namespace App\Controller;

use Core\Attributes\Route;
use Core\Controller\Controller;

class HomeController extends Controller
{

    #[Route('/doc', routeName: 'home')]
    public function index()
    {
       return $this->render('home/documentation', []);
    }
}