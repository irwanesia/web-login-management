<?php

namespace Codeir\BelajarPHPMvc\Controller;

class ProductController
{
    function categories(string $productId, string $categoryId): void
    {
        echo "PRODUCT ID $productId, CATEGORY ID $categoryId";
    }
}