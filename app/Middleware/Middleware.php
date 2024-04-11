<?php

// 11.
// MIDDLEWARE

namespace Codeir\BelajarPHPMvc\Middleware;

interface Middleware
{
    function before(): void;
}