<?php

namespace App\Controllers;

use App\Models\Product;
use mysqli;

class SiteController
{
    public function index()
    {
        $product = new Product();
        $product->id = 5;
        $product->name = 'axaxaxa';
        $product->description = 'oxoxoxox';
        $product->save();

        Product::findById(5);

//        render('main.php');
//        include __DIR__.'/../../views/main.php';
    }

    public function notFound()
    {
        render('404.php');
//        include __DIR__.'/../../views/404.php';
    }
}