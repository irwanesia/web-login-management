<?php 

// 06. membuat/setup koneksi ke database
namespace Codeir\BelajarPHPMvc\App\Config;

class Database
{
    private static ?\PDO $pdo = null;

    public static function getConnection(string $env = "test"): \PDO {
        if(self::$pdo == null){
            // create new PDO
            require_once __DIR__ . '/../../config/database.php';
            $config = getDatabaseConfig();
            self::PDO = new \PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password'],
            );
        }
        return self::$pdo;
    }
}