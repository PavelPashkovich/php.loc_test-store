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

    public function addProductsForm() {
        render('addProductsForm.php');
    }

    public function saveProducts() {
        echo "<pre>";
        print_r($_SERVER['DOCUMENT_ROOT']);
        echo "</pre>";
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";

        $types_arr = ['image/bmp', 'image/cis-cod', 'image/gif', 'image/ief', 'image/jpeg',
            'image/pipeg', 'image/svg+xml', 'image/tiff', 'image/x-cmu-raster', 'image/x-cmx',
            'image/x-icon', 'image/x-portable-anymap', 'image/x-portable-bitmap',
            'image/x-portable-graymap', 'image/x-portable-pixmap', 'image/x-rgb', 'image/x-xbitmap',
            'image/x-xpixmap', 'image/x-xwindowdump'];

        $tmp_name = $_FILES['files_arr']['tmp_name'];
        $name = $_FILES['files_arr']['name'];
        $size = $_FILES['files_arr']['size'];
        $type = $_FILES['files_arr']['type'];

        for ($i = 0; $i < count($tmp_name); $i++) {
            if(in_array(mime_content_type($tmp_name[$i]), $types_arr)) {
                if($size[$i] <= 1024 * 1024 * 1) {
                    while(is_file($_SERVER['DOCUMENT_ROOT'].'/download/'.$name[$i])) {
                        echo "<pre>"; echo '!!!FILE '.$name[$i].' is already exists. Saved as '.'1'.$name[$i]; echo "</pre>";
                        $name[$i] = '1'.$name[$i];
                    }

                    if(str_contains($name[$i], '_')) {
                        $name[$i] = strtolower($name[$i]);
                        $exp_name = explode('_', $name[$i]);
                        $CamelName = [];
                        for ($j = 0; $j < count($exp_name); $j++) {
                            $CamelName[] = ucfirst($exp_name[$j]);
                        }
                        $name[$i] = implode('', $CamelName);
                        echo "<pre>"; echo $name[$i]; echo "</pre>";
                        while(is_file($_SERVER['DOCUMENT_ROOT'].'/download/'.$name[$i])) {
                            echo "<pre>"; echo '!!!FILE '.$name[$i].' is already exists. Saved as '.'1'.$name[$i]; echo "</pre>";
                            $name[$i] = '1'.$name[$i];
                        }
                    }
                    move_uploaded_file($tmp_name[$i], $_SERVER['DOCUMENT_ROOT'].'/download/'.$name[$i]);

                } else {
                    echo "<pre>"; echo '!!!FILE SIZE NO MORE THAN 1 MB - '.$name[$i].' ('.(round($size[$i]/1024/1024, 2)).' MB)'; echo "</pre>";
                }

            } else {
                echo "<pre>"; echo '!!!WRONG FILE TYPE - '.$type[$i].' ('.$name[$i].')'; echo "</pre>";
            }
        }
    }
}