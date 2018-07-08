<?php

namespace App\Forms\Admin;

use Kris\LaravelFormBuilder\Form;

class LoginForm extends Form
{
    public function buildForm()
    {
        $this->add('email', 'email', [
            'label' => false,
            'attr' => ['placeholder' => 'E-posta'],
            'rules' => 'required|email',
            'required' => true,
        ])
            ->add('password', 'password', [
                'label' => false,
                'required' => true,
                'rules' => 'required',
                'attr' => ['placeholder' => 'Parola'],
            ])
            ->add('submit', 'submit', [
                'attr' => ['class' => 'btn btn-primary'],
                'label' => 'Giriş Yap',
            ]);
    }
}
