<?php 

// 10. Unit Test View Template

namespace Codeir\BelajarPHPMvc\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testRender()
    {
        View::render('Home/index', [
            "PHP Login Management"
        ]);

        // gunakan method phpunittest expectOutputRegex()
        // method ini digunakan untuk test output apa saja dari file kode html
        // contoh output yg diharuskan pada halaman index
        $this->expectOutputRegex('[PHP Login Management]');
        $this->expectOutputRegex('[html]');
        $this->expectOutputRegex('[body]');
        $this->expectOutputRegex('[Login Management]');
        $this->expectOutputRegex('[Login]');
        $this->expectOutputRegex('[Register]');
    }
}