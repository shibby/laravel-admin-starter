<?php

namespace App\Forms\Admin;

use App\Model\Category;
use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    public function buildForm()
    {
        /** @var Category $model */
        $model = $this->getModel();

        $mainCategories = $this->data['mainCategories'];
        if ($model->id) {
            unset($mainCategories[$model->id]);
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
        ])->add('icon', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Font Awesome Icon (fa fa-XXXX)',
            'label_attr' => ['class' => 'control-label'],
            'help_block' => [
                'text' => 'yalnızca tanımlayıcı girin. XXXX olan kısmı',
            ],
            'error_messages' => [
                'name.min' => 'Çok az bişey yazdın ya.',
            ],
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
            //'rules' => 'required|min:2|max:500',
            'error_messages' => [
                'name.min' => 'Çok az bişey yazdın ya.',
            ],
            //'required' => true,
            'help_block' => [
                'text' => '< meta description içerisine yazılacak',
            ],
        ])->add('seo_keywords', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Seo Keywords',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'nullable|min:2|max:191',
            'error_messages' => [
                'name.min' => 'Çok az bişey yazdın ya.',
            ],
            'required' => false,
            'help_block' => [
                'text' => '< meta keywords içerisine yazılacak',
            ],
        ])
        ;

        $this->add('main_category_id', 'select', [
            'choices' => ['' => 'Seçiniz'] + $mainCategories,
            'label' => 'Varsa ana kategori seçin',
        ]);
        $this->add('show_on_menu', 'checkbox', [
            'label' => 'Menüde görüntülensin mi?',
            'label_attr' => ['class' => 'control-label'],
            'value' => 1,
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
