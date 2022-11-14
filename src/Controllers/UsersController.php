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
                    $arr = [
                        'status' => 'error',
                        'message' => $loginError,
                        'type' => 'login',
                    ];
                    $loginError = json_encode($arr);
                    echo $loginError;
                    exit();
                }
                elseif (preg_match('~[Пп]ароль~',$e->getMessage(), $match)) {
                    $passwordError = $e->getMessage();
                    $arr = [
                        'status' => 'error',
                        'message' => $passwordError,
                        'type' => 'password',
                    ];
                    $passwordError = json_encode($arr);
                    echo $passwordError;
                    exit();
                }
                elseif (preg_match('~[Пп]одтверждение пароля~', $e->getMessage(), $match)) {
                    $confirmPasswordError = $e->getMessage();
                    $arr = [
                        'status' => 'error',
                        'message' => $confirmPasswordError,
                        'type' => 'confirmPassword',
                    ];
                    $confirmPasswordError = json_encode($arr);
                    echo $confirmPasswordError;
                    exit();
                }
                elseif (preg_match('~почт~', $e->getMessage(), $match)) {
                    $emailError = $e->getMessage();
                    $arr = [
                        'status' => 'error',
                        'message' => $emailError,
                        'type' => 'email',
                    ];
                    $emailError = json_encode($arr);
                    echo $emailError;
                    exit();
                }
                elseif (preg_match('~[Ии]мя~', $e->getMessage(), $match)) {
                    $nameError = $e->getMessage();
                    $arr = [
                        'status' => 'error',
                        'message' => $nameError,
                        'type' => 'name',
                    ];
                    $nameError = json_encode($arr);
                    echo $nameError;
                    exit();
                }
                require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                                . 'templates' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'signUp.php';
                exit();
            }
        } else {
            require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                            . 'templates' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'signUp.php';
            exit();
        }
        $arr = [
            'status' => 'success',
            'message' => '/signUpSuccess',
        ];
        $statusSuccess = json_encode($arr);
        echo  $statusSuccess;
    }


    public function signUpSuccess()
    {
        require __DIR__ . DIRECTORY_SEPARATOR .'..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                        . 'templates' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'signUpSuccess.php';
    }


    public function logIn()
    {
        if(!empty($_POST)) {
            try {
                $user = User::logIn($_POST);
            } catch (\Exception $e) {
                if(preg_match('~[Лл]огин~', $e->getMessage(), $match)) {
                    $loginError = $e->getMessage();
                    $arr = [
                        'status' => 'error',
                        'message' => $loginError,
                        'type' => 'login',
                    ];
                    $loginError = json_encode($arr);
                    echo $loginError;
                    exit();
                }
                elseif(preg_match('~[Пп]арол~', $e->getMessage(), $match)) {
                    $passwordError = $e->getMessage();
                    $arr = [
                        'status' => 'error',
                        'message' => $passwordError,
                        'type' => 'password',
                    ];
                    $passwordError = json_encode($arr);
                    echo $passwordError;
                    exit();
                }
            }
        } else {
            require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                            . 'templates' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'login.php';
            exit();
        }
        $arr = [
            'status' => 'success',
            'message' => '/logInSuccess',
        ];
        $statusSuccess = json_encode($arr);
        echo $statusSuccess;
    }


    public function logInSuccess()
    {
        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
                        . 'templates' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'logInSuccess.php';
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