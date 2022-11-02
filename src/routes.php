<?php

return [
    '~^$~' => [\src\Controllers\UsersController::class, 'signUp'],
    '~^users/login$~' => [\src\Controllers\UsersController::class, 'logIn'],
    '~^users/logout$~' => [\src\Controllers\UsersController::class, 'logOut'],
];