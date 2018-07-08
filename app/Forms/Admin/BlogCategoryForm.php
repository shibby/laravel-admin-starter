<?php

namespace App\Forms\Admin;

use Kris\LaravelFormBuilder\Form;

class BlogCategoryForm extends Form
{
    public function buildForm()
    {
        /** @var Category $model */
        $model = $this->getModel();

        $mainBlogCategories = $this->data['mainBlogCategories'];
        if ($model->id) {
            unset($mainBlogCategories[$model->id]);
        }

        $this->add('name', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Kategori Adı',
            'label_attr' => ['class' => 'control-label'],
            /*'rules' => 'required|min:2|max:255|regex:/^[0-9]*$/',*/
            'rules' => 'required|min:2|max:255',
            'error_messages' => [
                'name.min' => 'Çok az bişey yazdın ya.',
            ],
            'required' => true,
        ])->add('slug', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Slug Url',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'nullable|max:255',
            'help_block' => [
                'text' => 'Yeni kayıtta boş bırakılırsa otomatik oluşturulur. ',
            ],
        ])->add('description', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Kategori Açıklaması',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required|min:2|max:500',
            'error_messages' => [
                'name.min' => 'Çok az bişey yazdın ya.',
            ],
            'required' => true,
        ])->add('seo_title', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Seo Title',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required|min:2|max:255',
            'error_messages' => [
                'name.min' => 'Çok az bişey yazdın ya.',
            ],
            'required' => true,
            'help_block' => [
                'text' => '< title>< /title> içerisine yazılacak',
            ],
        ])->add('seo_description', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Seo Description',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required|min:2|max:500',
            'error_messages' => [
                'name.min' => 'Çok az bişey yazdın ya.',
            ],
            'required' => true,
            'help_block' => [
                'text' => '< meta description içerisine yazılacak',
            ],
        ])
        ;

        $this->add('main_blog_category_id', 'select', [
            'choices' => ['' => 'Seçiniz'] + $mainBlogCategories,
            'label' => 'Varsa ana kategori seçin',
        ])
            ->add('cover_media', 'file', [
                'label' => 'Kategori Görseli',
                'required' => $model->id ? false : true,
                'image' => $model->cover_media_id ? $model->coverMedia : null,
            ])
        ;

        $this->add('submit', 'submit', [
            'attr' => ['class' => 'btn btn-primary'],
            'label' => 'Kaydet',
        ]);
    }
}
