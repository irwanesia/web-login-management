<?php 

namespace Codeir\BelajarPHPMvc\Service;
// use CodeIgniter\Debug\Toolbar\Collectors\Database;
use Codeir\BelajarPHPMvc\Exception\ValidationException;
use Codeir\BelajarPHPMvc\Model\UserLoginRequest;
use Codeir\BelajarPHPMvc\Model\UserLoginResponse;
use Codeir\BelajarPHPMvc\Model\UserRegisterRequest;
use Codeir\BelajarPHPMvc\Model\UserRegisterResponse;
use Codeir\BelajarPHPMvc\Repository\UserRepository;
use Codeir\BelajarPHPMvc\Domain\User;
use Codeir\BelajarPHPMvc\Config\Database;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);
        
        // sebelum kita melakukan operasi lakukan begin transaction dan masukan ke dalam try catch
        try{
            Database::beginTransaction();
            $user = $this->userRepository->findById($request->id);
            if($user != null){
                throw new ValidationException("user id already exists!");
            }

            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);

            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;
        }catch (\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        if($request->id == null || $request->name == null || $request->password == null || trim($request->id) == "" || trim($request->name) == "" || trim($request->password) == "")
        {
            throw new ValidationException("id, name, password can't blank!");
        }
    }
    
    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findById($request->id);
        if($user == null){
            throw new ValidationException("Username or password is wrong");
        }

        if(password_verify($request->password, $user->password)){
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        }else{
            throw new ValidationException("Id or password is wrong");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request)
    {
        if($request->id == null || $request->password == null || trim($request->id) == "" || trim($request->password) == "")
        {
            throw new ValidationException("id, password can't blank!");
        }
    }
}