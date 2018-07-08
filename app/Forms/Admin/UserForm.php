<?php

namespace App\Forms\Admin;

use App\User;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        /** @var User $model */
        $model = $this->getModel();
        $this->add('name', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => __('admin.users.name'),
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required|min:2',
            'required' => true,
        ])->add('email', 'email', [
            'attr' => ['class' => 'form-control'],
            'label' => __('admin.users.email'),
            'label_attr' => ['class' => 'control-label'],
            'rules' => !($model && $model->id) ? 'required|email|unique:users,email' : 'required|email|unique:users,email,'.$model->id,
            'required' => true,
        ]);

        $this->add('password', 'password', [
            'label' => __('admin.users.password'),
            'value' => '',
            'required' => !($model && $model->id),
            'rules' => !($model && $model->id) ? 'required|min:6' : 'nullable|min:6',
        ])->add('role_id', 'select', [
            'label' => __('admin.users.role'),
            'choices' => \App\User::ROLES,
            //'selected' => $model->role_id,
        ])->add('status_id', 'select', [
            'label' => __('admin.users.status'),
            'choices' => \App\User::STATUSES,
            'selected' => $model->status_id ?? User::STATUS_ACTIVE,
        ])
        ;

        $this->add('submit', 'submit', [
            'attr' => ['class' => 'btn btn-primary'],
            'label' => __('admin.save'),
        ]);
    }
}
