<?php

namespace App\Forms\Website;

use Kris\LaravelFormBuilder\Form;

class LoginForm extends Form
{
    public function buildForm()
    {
        $this->add('identifier', 'text', [
            'label' => 'E-Posta/Kullanıcı Adı',
            'attr' => ['placeholder' => 'E-posta ya da kullanıcı adı'],
            'rules' => 'required',
            'required' => true,
            'error_messages' => [
                'identifier.required' => 'Bu alan gereklidir',
            ],
        ])
            ->add('password', 'password', [
                'label' => 'Parola',
                'required' => true,
                'rules' => 'required',
                'attr' => ['placeholder' => 'Parola'],
                'error_messages' => [
                    'password.required' => 'Bu alan gereklidir',
                ],
            ])
            ->add('submit', 'submit', [
                'wrapper' => ['class' => 'action-btn'],
                'attr' => ['class' => 'btn'],
                'label' => 'Giriş Yap',
            ]);
    }
}
