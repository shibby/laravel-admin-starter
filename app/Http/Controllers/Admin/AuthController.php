<?php

namespace App\Http\Controllers\Admin;

use App\Forms\Admin\LoginForm;
use App\Service\UserService;
use App\User;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class AuthController extends AdminController
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function loginAction(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(LoginForm::class, [
            'method' => 'POST',
        ]);

        if ($request->isMethod('post')) {
            if (!$form->isValid()) {
                return redirect()->back()->withErrors($form->getErrors());
            }

            $result = $this->userService->attempLogin([
                'email' => $request->request->get('email'),
                'password' => $request->request->get('password'),
                'status_id' => User::STATUS_ACTIVE,
            ], $request->getClientIp(), \Agent::getUserAgent());

            if (false === $result) {
                $this->setFlashMessage('error', 'Yetkilendirme hatası');

                return redirect()->back();
            } else {
                $this->setFlashMessage('success', 'Üye girişi başarılı');

                return redirect(route('admin_index'));
            }
        }

        return $this->renderView('admin.login', [
            'form' => $form,
        ]);
    }

    public function logoutAction()
    {
        \Auth::logout();

        return redirect(route('admin_login'));
    }
}
