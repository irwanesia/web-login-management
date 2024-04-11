<?php
// materi 07. Controller

namespace Codeir\BelajarPHPMvc\Controller;

use Codeir\BelajarPHPMvc\App\View;

class HomeController
{
    function index(): void
    {
        // 09.
        // MODEL
        $model = [
            "title" => 'Belajar PHP MVC',
            "content" => 'Halaman Home.'
        ];
        // echo "HomeController.index()";

        // 10.
        // VIEW
        // require __DIR__ . '/../View/Home/index.php';
        View::render('Home/index', $model);
    }

    function hello(): void
    {
        echo "HomeController.hello()";
    }

    function world(): void
    {
        echo "HomeController.world()";
    }

    function login(): void
    {
        $request = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ];

        $user = [
            
        ];

        $response = [
            'pesan' => "login sukses!",
        ];
        // kirimkan response ke view
    }
}