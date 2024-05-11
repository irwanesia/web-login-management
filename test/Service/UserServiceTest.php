<?php 

namespace Codeir\BelajarPHPMvc\Test;

// use CodeIgniter\Debug\Toolbar\Collectors\Database;
use Codeir\BelajarPHPMvc\Model\UserRegisterRequest;
use Codeir\BelajarPHPMvc\Model\UserRegisterResponse;
use Endroid\QrCode\Exception\ValidationException;
use phpDocumentor\Reflection\Types\Void_;
use PHPUnit\Framework\TestCase;
use Codeir\BelajarPHPMvc\Config\Database;
use Codeir\BelajarPHPMvc\Service\UserService;
use Codeir\BelajarPHPMvc\Domain\User;
use Codeir\BelajarPHPMvc\Repository\UserRepository;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserRepository $userRepository;

    protected function setUp():Void
    {
        $connection = Database::getConnection();
        $this->userRepository = new UserRepository($connection);
        $this->userService = new UserService($this->userRepository);

        $this->userRepository->deleteAll();
    }

    public function testRegistrasiSuccess()
    {
        $request = new UserRegisterRequest();
        $request->id = "1";
        $request->name = "irwan";
        $request->password = "rahasia";

        $response = $this->userService->register($request);

        self::assertEquals($request->id, $response->user->id);
        self::assertEquals($request->name, $response->user->name);
        self::assertNotEquals($request->password, $response->user->password);

        self::assertTrue(password_verify($request->password, $response->user->password));

    }

    public function testRegisterFailed()
    {
        $this->expectException(ValidationException::class);

        $request = new UserRegisterRequest();
        $request->id = "";
        $request->name = "";
        $request->password = "";

        $this->userService->register($request);
    }

    public function testRegisterDuplicate()
    {
        // simpan dulu data ke database lalu lakukan test data yg duplicate
        // 1. input data user ke db
        $user = new User();
        $user->id = "1";
        $user->name = "irwan";
        $user->password = "1234";

        $this->userRepository->save($user);

        $this->expectException(ValidationException::class);
        
        // input register untuk cek apakah data duplicate
        $request = new UserRegisterRequest();
        $request->id = "1";
        $request->name = "irwan";
        $request->password = "1234";

        $this->userService->register($request);        

    }
}