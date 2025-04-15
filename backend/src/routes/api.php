<?php

use App\Controllers\AuthController;
use App\Controllers\TaskController;
use App\Middleware\AuthMiddleware;

$authController = new AuthController();
$taskController = new TaskController();

$app->post('/login', function ($data) use ($authController) {
    return $authController->login($data);
});


$app->group('/tasks', function () use ($taskController) {
    $this->post('', function ($data) use ($taskController) {
        return $taskController->create($data);
    });

    $this->get('', function () use ($taskController) {
        return $taskController->getAll();
    });

    $this->put('/{id}', function ($id, $data) use ($taskController) {
        return $taskController->update($id, $data);
    });

    $this->delete('/{id}', function ($id) use ($taskController) {
        return $taskController->delete($id);
    });
})->add(new AuthMiddleware());
