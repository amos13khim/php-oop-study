<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Models\Users\UsersAuthService;
use MyProject\Services\EmailSender;
use \MyProject\View\View;
class UsersController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function signup()
    {
        if( !empty($_POST) ) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error'=> $e->getMessage()]);
                return;
            }


            if( $user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user, 'Activation', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);

                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php', []);
    }

    public function activate(int $userId, string $activationCode): void
    {
        $user = User::getById($userId);
        $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);
        if ($isCodeValid) {
            $user->activate();
            echo 'OK!';
        }
    }

    public function login()
    {
        if(!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('location: /');
                exit();
            } catch(InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error'=>$e->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('users/login.php');
    }

}