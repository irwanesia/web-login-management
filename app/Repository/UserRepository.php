<?php

namespace Codeir\BelajarPHPMvc\Repository;

use Codeir\BelajarPHPMvc\Domain\User;
use phpDocumentor\Reflection\Types\Void_;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user) : User
    {
        $statement = $this->connection->prepare("INSERT INTO users(id, name, password) VALUES(?,?,?)");
        $statement->execute([
            $user->id, $user->name, $user->password
        ]);
        return $user;
    }

    public function findById(string $id): ?User
    {   
        $statement = $this->connection->prepare("SELECT id, name, password FROM users WHERE id = ?");
        $statement->execute([$id]);

        // lakukan try finaly 
        // ketika selesai melakukan query jangan lupa closeCursor()
        try{
            if($row = $statement->fetch()){
                $user = new User();
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->password = $row['password'];
                return $user;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    function deleteAll(): void
    {
        $this->connection->exec('DELETE from users');
    }
}