<?php

namespace App\Forms\Admin;

use App\Model\Comment;
use Kris\LaravelFormBuilder\Form;

class CommentForm extends Form
{
    public function buildForm()
    {
        $this->add('user_id', 'select', [
            'attr' => ['class' => 'form-control categories', 'multiple' => false],
            'label' => 'Üye',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
            'choices' => $this->getData('users'),
        ]);
        $this->add('blog_content_id', 'select', [
            'attr' => ['class' => 'form-control categories', 'multiple' => false],
            'label' => 'Yorum',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
            'choices' => $this->getData('blogContentss'),
        ])
        ;

        $this->add('comment', 'textarea', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Yorum',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
        ]);

        $this->add('submit', 'submit', [
            'attr' => ['class' => 'btn btn-primary'],
            'label' => 'Kaydet',
        ]);
    }
}
