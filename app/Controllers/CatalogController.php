<?php

namespace App\Controllers;

use App\Models\Product;

class CatalogController
{
    public function index()
    {
        render('store.php');
//        include __DIR__ . '/../../views/store.php';
    }

    public function showProduct()
    {
        $id = (int) $_GET['id'];
        $allProducts = Product::selectAll();
        $product = Product::findById($id);
        render('product.php', [
            'product' => $product,
            'productsList' => $allProducts
        ]);

//        include __DIR__ . '/../../views/product.php';
    }

    public  function showForm() {
        render('addProductForm.php');
    }

    public function saveProduct() {
//        print_r($_FILES['img']); // отобразит информацию о файле, который пришел через форму
//        print_r(mime_content_type(__DIR__.'/2.png')); // отобразит тип файла, независимо от его расширения
//        copy($_FILES['img']['tmp_name'], __DIR__.'/2.png');
        $path = $_SERVER['DOCUMENT_ROOT'].'/'.$_FILES['img']['name']; // путь, куда мы сохраняем файл
        move_uploaded_file($_FILES['img']['tmp_name'], $path);
//        $sql = // $path - сохраняем в базе данных путь к файлу
//        print_r($_POST); // отображает то, что пришло из формы
        // сохраняем загруженные картинки в папку public, иначе будут недоступн
    }

}