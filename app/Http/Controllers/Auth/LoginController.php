<?php

namespace App\Http\Controllers\Auth;

use App\Forms\Website\LoginForm;
use App\Http\Controllers\Controller;
use App\Service\UserLoginService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class LoginController extends Controller
{
    public function logoutAction(Request $request, UserLoginService $userLoginService)
    {
        $userLoginService->insertUserLogin(\Auth::user(), 'logout', $request->getClientIp(), \Agent::getUserAgent());
        \Auth::logout();

        $this->setFlashMessage('info', 'Üye çıkışı başarıyla gerçekleştirildi');

        return redirect(route('homepage'));
    }

    public function loginAction(Request $request, FormBuilder $formBuilder, UserService $userService)
    {
        $this->setTitle('Üye Girişi');

        if ($request->has('message')) {
            $message = $request->get('message');
            if ('loginToComment' === $message) {
                $messageText = 'Yorum yazmak için lütfen üye girişi yapın.';
            } elseif ('loginToNote' === $message) {
                $messageText = 'Not kaydetmek için lütfen üye girişi yapın.';
            }
            $this->setMessage('error', $messageText);
        }

        $form = $formBuilder->create(LoginForm::class, [
            'method' => 'POST',
            'url' => $request->fullUrl(),
            'class' => 'login-form',
        ]);

        if ($request->isMethod('post')) {
            $form->redirectIfNotValid();

            $user = $userService->getUserByIdentifier($request->get('identifier'));
            if ($user) {
                $result = $userService->attempLogin([
                    'id' => $user->id,
                    'password' => $request->get('password'),
                ], $request->getClientIp(), \Agent::getUserAgent());

                if (true === $result) {
                    $this->setFlashMessage('success', 'Üye girişi başarılı');

                    if ($request->has('url')) {
                        return redirect($request->get('url'));
                    }

                    return redirect(route('homepage'));
                }
            }

            $this->setFlashMessage('error', 'Kullanıcı adı ya da parola hatalı');

            return redirect(route('auth_login'));
        }

        return $this->renderView('auth.login', [
            'form' => $form,
            'layout' => 'login-layout',
        ]);
    }
}
