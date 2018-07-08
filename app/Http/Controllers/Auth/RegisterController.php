<?php

namespace App\Http\Controllers\Auth;

use App\Forms\Website\RegisterForm;
use App\Http\Controllers\Controller;
use App\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class RegisterController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerAction(Request $request, FormBuilder $formBuilder)
    {
        $this->setTitle('Kayıt Ol');

        $form = $formBuilder->create(RegisterForm::class, [
            'method' => 'POST',
            'url' => $request->fullUrl(),
            'class' => 'register-form',
            'data' => [
            ],
        ]);

        if ($request->isMethod('post')) {
            $form->redirectIfNotValid();

            $postData = $request->all();
            $postData['ip_address'] = $request->getClientIp();
            $postData['user_agent'] = \Agent::getUserAgent();

            $user = new User();
            $user = $this->userService->registerUser($user, $postData);

            return redirect(route('auth_register_success'));
        }

        return $this->renderView('auth.register', [
            'form' => $form,
            'layout' => 'login-layout',
        ]);
    }

    public function registerSuccessAction()
    {
        $this->setTitle('Kayıt Ol');

        return $this->renderView('auth.register_success');
    }
}
