<?php

namespace App\Forms\Website;

use Kris\LaravelFormBuilder\Form;

class RegisterForm extends Form
{
    public function buildForm()
    {
        /** @var User $model */
        $model = $this->getModel();
        $this->add('name', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'İsim Soyisim',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required|min:4|max:255',
            'error_messages' => [
                'name.min' => 'Geçerli bir isim giriniz.',
            ],
            'required' => true,
        ]);
        $this->add('username', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Kullanıcı Adı',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required|min:3|max:50|unique:users,username',
            'error_messages' => [
                'name.min' => 'Kullanıcı adı minimum 3 karakter uzunluğunda olmalıdır.',
            ],
            'required' => true,
        ]);

        $this->add('email', 'email', [
            'attr' => ['class' => 'form-control'],
            'label' => 'E-posta',
            'label_attr' => ['class' => 'control-label'],
            'rules' => !($model && $model->id) ? 'required|email|unique:users,email' : 'required|email|unique:users,email,'.$model->id,
            'required' => true,
        ]);
        $this->add('password', 'password', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Parola',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required|min:6',
            'required' => true,
        ]);

        $this->add('submit', 'submit', [
            'wrapper' => ['class' => 'action-btn reg'],
            'attr' => ['class' => 'btn'],
            'label' => 'Kayıt Ol!',
        ]);
    }
}
