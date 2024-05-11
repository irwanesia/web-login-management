<?php
// 12. unit test user registrasi
namespace Codeir\BelajarPHPMvc\Repository;

use PHPUnit\Framework\TestCase;
use Codeir\BelajarPHPMvc\Config\Database;
use Codeir\BelajarPHPMvc\Domain\User;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;
    public function setUp(): void 
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $user = new User();
        $user->id = "1";
        $user->name = "irwan";
        $user->password = "123";

        $this->userRepository->save($user);

        $result = $this->userRepository->findById($user->id);

        self::assertEquals($user->id, $result->id);
        self::assertEquals($user->name, $result->name);
        self::assertEquals($user->password, $result->password);
    }

    public function testFindByIdNotFound()
    {
        # code...
        $user = $this->userRepository->findById("notfound");
        self::assertNull($user);
    }
}