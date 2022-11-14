<?php

return [
    '~^$~' => [\src\Controllers\UsersController::class, 'signUp'],
    '~^signUpSuccess$~' => [\src\Controllers\UsersController::class, 'signUpSuccess'],
    '~^users/login$~' => [\src\Controllers\UsersController::class, 'logIn'],
    '~^logInSuccess$~' => [\src\Controllers\UsersController::class, 'logInSuccess'],
    '~^users/logout$~' => [\src\Controllers\UsersController::class, 'logOut'],
];