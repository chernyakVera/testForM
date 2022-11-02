<?php

namespace src\Models;

use src\Services\JsonDb;

class User
{
    /** @var string */
    private $login;

    /** @var string */
    private $password;

    /** @var string */
    private $confirmPassword;

    /** @var string */
    private $email;

    /** @var string */
    private $name;

    /** @var string */
    private $authToken;


    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    const SALT = 'My Unique Pepper';

    public function setPassword(string $password): void
    {
       $this->password = sha1(self::SALT.$password);
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAuthToken(string $authToken): void
    {
        $this->authToken = $authToken;
    }


    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuthToken(): string
    {
        return $this->authToken;
    }



    public static function signUp($fieldsFromForm)
    {
        if (empty($fieldsFromForm['login'])) {
            throw new \Exception('Введите логин.');
        } else {
            if(strlen($fieldsFromForm['login']) < 6) {
                throw new \Exception('Логин должен быть длиной минимум 6 символов.');
            }
            elseif (!preg_match('~^[a-zA-Z]+[_]*[a-zA-Z]$~', $fieldsFromForm['login'], $match)) {
                throw new \Exception('Логин должен состоять только из букв латинского алфавита и нижнего подчеркивания.');
            }
            elseif (JsonDb::isValueExist($fieldsFromForm['login'],'login') === true) {
                throw new \Exception('Пользователь с таким логином уже существует.');
            }

        }

        if(empty($fieldsFromForm['password'])) {
            throw new \Exception('Введите пароль.');
        } else {
            preg_match('~[a-zA-Z]+~', $fieldsFromForm['password'], $matchLetters);
            preg_match('~\d+~', $fieldsFromForm['password'], $matchDigits);
            preg_match('~\s+~', $fieldsFromForm['password'], $matchSpaces);

            if(strlen($fieldsFromForm['password']) < 6) {
                throw new \Exception('Пароль должен быть длиной минимум 6 символов.');
            }

            elseif (!empty($matchLetters) && empty($matchDigits) || empty($matchLetters) && !empty($matchDigits)) {
                throw new \Exception('Пароль дожен состоять только из букв латинского алфавита и цифр.');
            }
            elseif (!empty($matchSpaces)) {
                throw new \Exception('Пароль не должен содержать пробелы.');
            }
        }

        if(empty($fieldsFromForm['confirmPassword'])) {
            throw new \Exception('Введите подтверждение пароля.');
        } else {
            if($fieldsFromForm['confirmPassword'] !== $fieldsFromForm['password']) {
                throw new \Exception('Подтверждение пароля должно совпадать с паролем.');
            }
        }

        if(empty($fieldsFromForm['email'])) {
            throw new \Exception('Введите адрес эл.почты.');
        } else {
            if(!filter_var($fieldsFromForm['email'], FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Введен некорректный адрес эл.почты');
            }
            elseif(JsonDb::isValueExist($fieldsFromForm['email'],'email')) {
                throw new \Exception('Пользователь с таким адресом эл. почты уже существует.');
            }
        }

        if(empty($fieldsFromForm['name'])) {
            throw new \Exception('Введите имя.');
        } else {
            if(strlen($fieldsFromForm['name']) < 2) {
                throw new \Exception('Имя должно быть длиной минимум 2 символа');
            }
            elseif (!preg_match('~^[a-zA-Z]+$~', $fieldsFromForm['name'], $match)) {
                throw new \Exception('Имя должно состоять только из букв латинского алфавита.');
            }
        }

        $user = new User();
        $user->setLogin($fieldsFromForm['login']);
        $user->setPassword($fieldsFromForm['password']);
        $user->setEmail($fieldsFromForm['email']);
        $user->setName($fieldsFromForm['name']);
        $user->setAuthToken(sha1(random_bytes(100)) . sha1(random_bytes(100)));

        JsonDb::create($user);

//        return $user;
    }





    public static function logIn($fieldsFromForm): User
    {
        if(empty($fieldsFromForm['email'])) {
            throw new \Exception('Введите адрес эл.почты.');
        } else {
            if(JsonDb::read($fieldsFromForm['email'], 'email') === null) {
                throw new \Exception('Пользователя с таким адресом эл.почты не существует.');
            }
        }

        if(empty($fieldsFromForm['password'])) {
            throw new \Exception('Введите пароль.');
        } else {
            $password = $fieldsFromForm['password'];
            $encodedPassword = sha1(self::SALT.$password);
            $passwordFromDb = JsonDb::read($fieldsFromForm['email'], 'password');
            if($encodedPassword !== $passwordFromDb) {
                throw new \Exception('Неверный пароль');
            }
        }

        $authorizedUser = JsonDb::getUserByEmail($fieldsFromForm['email']);

        $user = new User();
        $user->setEmail($authorizedUser['email']);
        $user->setPassword($authorizedUser['password']);
        $user->setLogin($authorizedUser['login']);
        $user->setName($authorizedUser['name']);
        $user->setAuthToken($user->refreshAuthToken());
        $user->createToken();

        $_SESSION['name'] = $user->getName();
        $_SESSION['email'] = $user->getEmail();

        return $user;

    }


    private function refreshAuthToken(): ?string
    {
        $newValue = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $result = JsonDb::update($this->getEmail(), 'authToken', $newValue);
        return $result;
    }


    private function createToken(): void
    {
        $token = $this->getAuthToken();
        setcookie('token', $token, 0, '/', '', false, true);
    }



    public static function getUser(): ?User
    {
        $authorizedUser = null;
        $methodOfLogin = null;

        if(isset($_SESSION['email'])) {
            $authorizedUser = JsonDb::getUserByEmail($_SESSION['email']);
            $methodOfLogin = 'session';
        } else {
            $token = $_COOKIE['token'] ?? '';
            $authorizedUser = JsonDb::getUserByToken($token);
            $methodOfLogin = 'cookie';
        }

        if ($authorizedUser === null) {
            return null;
        } else {
            $user = new User();
            $user->setEmail($authorizedUser['email']);
            $user->setPassword($authorizedUser['password']);
            $user->setLogin($authorizedUser['login']);
            $user->setName($authorizedUser['name']);
            $user->setAuthToken($authorizedUser['authToken']);
        }

        if($methodOfLogin === 'session') {
            setcookie('token', $user->getAuthToken());
        } elseif ($methodOfLogin === 'cookie') {
            $_SESSION['name'] = $user->getName();
            $_SESSION['email'] = $user->getEmail();
        }

        return $user;
    }
}













