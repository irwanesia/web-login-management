<?php 

// buat namespace lagi untuk mengatasi unit test yg error 
// Cannot modify header information - headers already sent by (output started at
// C:\xampp\htdocs\web-login-management\vendor\phpunit\phpunit\src\Util\Printer.php:104)
namespace Codeir\BelajarPHPMvc\App {
    // buat header sendiri 
    // mengatasi unit test testPostRegisterSuccess()
    function header(string $value)
    {
        echo $value;
    }
}

namespace Codeir\BelajarPHPMvc\Controller {
    
    use Codeir\BelajarPHPMvc\Config\Database;
    use Codeir\BelajarPHPMvc\Domain\User;
    use Codeir\BelajarPHPMvc\Repository\UserRepository;
    use PHPUnit\Framework\TestCase;

    class UserControllerTest extends TestCase
    {
        private UserController $userController;
        private UserRepository $userRepository;

        protected function setUp(): void
        {
            $this->userController = new UserController();

            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();

            // mengatasi unit test testPostRegisterSuccess()
            putenv("mode=test");
        }

        public function testRegister()
        {
            $this->userController->register();

            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new user]");
        }
        
        public function testPostRegisterSuccess()
        {   
            $_POST['id'] = '1';
            $_POST['name'] = 'irwan';
            $_POST['password'] = '1234';

            $this->userController->postRegister();
        
            $this->expectOutputRegex("[Location: /users/login]");
        }
        
        public function testPostRegisterValidationError()
        {
            $_POST['id'] = '';
            $_POST['name'] = 'irwan';
            $_POST['password'] = '1234';

            $this->userController->postRegister();
        
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register New User]");
            $this->expectOutputRegex("[id, name, password can't blank!]");

        }

        public function testPostRegisterDuplicate()
        {
            $user = new User();
            $user->id = "1";
            $user->name = "irwan";
            $user->password = "1234";

            $this->userRepository->save($user);
            
            $_POST['id'] = '1';
            $_POST['name'] = 'irwan';
            $_POST['password'] = '1234';

            $this->userController->postRegister();
        
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register New User]");
            $this->expectOutputRegex("[user id already exists]");
        }
    }
}