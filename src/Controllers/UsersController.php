<?php
namespace src\Controllers;

use src\Models\User;
use \Exception;

class UsersController
{
    /** @var User|null  */
    private $user;

    public function __construct()
    {
        $this->user = User::getUser();
    }


    public function signUp() {

        if(!empty($_POST)) {
            try {
                User::signUp($_POST);
            } catch (\Exception $e) {
                if(preg_match('~[Лл]огин~', $e->getMessage(), $match)) {
                    $loginError = $e->getMessage();
                }
                elseif (preg_match('~[Пп]ароль~',$e->getMessage(), $match)) {
                    $passwordError = $e->getMessage();
                }
                elseif (preg_match('~[Пп]одтверждение пароля~', $e->getMessage(), $match)) {
                    $confirmPasswordError = $e->getMessage();
                }
                elseif (preg_match('~почт~', $e->getMessage(), $match)) {
                    $emailError = $e->getMessage();
                }
                elseif (preg_match('~[Ии]мя~', $e->getMessage(), $match)) {
                    $nameError = $e->getMessage();
                }
                require __DIR__ . '/../../templates/user/signUp.php';
                exit();
            }
        } else {
            require __DIR__ . '/../../templates/user/signUp.php';
            exit();
        }
        require __DIR__ . '/../../templates/user/signUpSuccess.php';
        exit();
    }



    public function logIn()
    {
        if(!empty($_POST)) {
            try {
                $user = User::logIn($_POST);
            } catch (\Exception $e) {
                if(preg_match('~[Аа]дрес~', $e->getMessage(), $match)) {
                    $emailError = $e->getMessage();
                    require __DIR__ . '/../../templates/user/login.php';
                    exit();
                }
                elseif(preg_match('~[Пп]арол~', $e->getMessage(), $match)) {
                    $passwordError = $e->getMessage();
//                    $arr = [
//                        'status' => 'error',
//                        'message' => $passwordError
//                    ];
//                    echo json_encode($arr);
                    require __DIR__ . '/../../templates/user/login.php';
                    exit();
                }
            }
        } else {
            require __DIR__ . '/../../templates/user/login.php';
            exit();
        }
        require __DIR__ . '/../../templates/user/logInSuccess.php';
    }


    public function logOut()
    {
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_COOKIE['token']);
        setcookie('token', '', time()-1000);
        setcookie('token', '', time()-1000, '/');
        header('Location: /users/login');
        exit();
    }
}