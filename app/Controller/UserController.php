<?php 

namespace Codeir\BelajarPHPMvc\Controller;

use Codeir\BelajarPHPMvc\app\View;
use Codeir\BelajarPHPMvc\Config\Database;
use Codeir\BelajarPHPMvc\Exception\ValidationException;
use Codeir\BelajarPHPMvc\Model\UserRegisterRequest;
use Codeir\BelajarPHPMvc\Service\UserService;
use Codeir\BelajarPHPMvc\Repository\UserRepository;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }

    public function register()
    {
        View::render('User/register', [
            'title' => 'Register new user'
        ]);
    }

    public function postRegister()
    {
        $request = new UserRegisterRequest();
        $request->id = $_POST['id'];
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];

        try{
            $this->userService->register($request);
            // jika sukses redirect to /users/login
            View::redirect('/users/login');
        }catch(ValidationException $exception){
            View::render('User/register', [
                'title' => 'Register new User',
                'error' => $exception->getMessage()
            ]);
        }
    }
}