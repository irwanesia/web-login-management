<?php
// materi 07. Controller

namespace Codeir\BelajarPHPMvc\Controller;

use Codeir\BelajarPHPMvc\App\View;

class HomeController
{
    function index()
    {
        View::render('Home/index', [
            "title" => "PHP Login Management"
        ]);
    }

}