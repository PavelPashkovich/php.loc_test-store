<?php

namespace App\Controllers;

use App\Models\Product;
use mysqli;

class SiteController
{
    public function index()
    {
        Product::findById(2);

        render('main.php');
//        include __DIR__.'/../../views/main.php';
    }

    public function notFound()
    {
        render('404.php');
//        include __DIR__.'/../../views/404.php';
    }
}