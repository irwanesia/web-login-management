<?php

// 08 path variabel

namespace Codeir\BelajarPhpMvc;

use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    public function testRegex() 
    {
        $path = "/products/12345/categories/abcd";
    
        // awal dan akhir tidak menggunakan /, karena / banyak digunakan di URL
        // maka dr itu gunakan #, dan ^ untuk memulai regex dan $ untuk mengakhiri regex
        $pattern = "#^/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)$#";
    
        $result = preg_match($pattern, $path, $variables);
    
        self::assertEquals(1, $result);
    
        var_dump($variables);
        // dari variables diatas didapat 3 data
        // data asli di string pertama 
        // array(3) {
        //     [0]=>
        //     string(31) "/products/12345/categories/abcd"
        //     [1]=>
        //     string(5) "12345"
        //     [2]=>
        //     string(4) "abcd"
        //   }
        

        // data yg 2 yg akan di ambil 
        array_shift($variables);
        var_dump($variables);
        // sehingga di dapat data sbb;
        // array(2) {
        //     [0]=>
        //     string(5) "12345"
        //     [1]=>
        //     string(4) "abcd"
        //   }
           
    }
}