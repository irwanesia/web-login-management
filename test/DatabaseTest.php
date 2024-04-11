<?php

namespace Codeir\BelajarPHPMvc\App\Config;
use PHPUnit\Framework\TestCase;


// 07. membuat unit test untuk database connection


class DatabaseTest extends TestCase
{
    // #1. test koneksi tidak null
    public function testGetConnection()
    {
        $connection = Database::getConnection();
        self::assertNotNull($connection);
    }
    
    // #2. test koneksi tidak null
    public function testGetConnectionSingleton()
    {
        $connection1 = Database::getConnection();
        $connection2 = Database::getConnection();
        self::assertSame($connection1, $connection2);
    }
}