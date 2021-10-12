<?php
return [
//    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
//    '~^bye/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayBye'],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/(\d+)/edit/$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^/$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/add/$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^articles/(\d+)/delete/$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^users/register~' => [\MyProject\Controllers\UsersController::class, 'signup'],
    '~^users/register/$~' => [\MyProject\Controllers\UsersController::class, 'signup'],
];