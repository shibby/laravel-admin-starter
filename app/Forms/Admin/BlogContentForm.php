<?php

namespace App\Forms\Admin;

use App\Model\BlogContent;
use Kris\LaravelFormBuilder\Form;

class BlogContentForm extends Form
{
    public function buildForm()
    {
        /** @var BlogContent|null $model */
        $model = $this->getModel();
        if (!$model) {
            $model = new BlogContent();
        }
        if ($model && $model->id) {
            $this->add('routeUrl', 'hidden', [
                'help_block' => [
                    'text' => '<a href="'.$model->routeUrl.'" target="_blank">'.$model->routeUrl.'</a>',
                ],
            ]);
        }

        $this->add('title', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Blog Yazısı Başlığı',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required|min:2|max:250',
            'error_messages' => [
                'name.min' => 'Çok az bişey yazdın ya.',
            ],
            'required' => true,
        ])->add('slug', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Slug Url',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'nullable|min:2|max:250',
            'help_block' => [
                'text' => 'Yeni kayıtta boş bırakılırsa otomatik oluşturulur. ',
            ],
        ])->add('seo_title', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Seo Title',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'nullable|min:2|max:250',
            'error_messages' => [
                'seo_title.min' => 'Çok az bişey yazdın ya.',
            ],
            'help_block' => [
                'text' => '< title>< /title> içerisine yazılacak',
            ],
        ])->add('seo_description', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Seo Description',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'nullable|min:2|max:500',
            'error_messages' => [
                'seo_description.min' => 'Çok az bişey yazdın ya.',
            ],
            'help_block' => [
                'text' => '< meta description içerisine yazılacak',
            ],
        ])->add('seo_keywords', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Seo Keywords',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'nullable|min:2|max:500',
            'error_messages' => [
                'seo_keywords.min' => 'Çok az bişey yazdın ya.',
            ],
            'help_block' => [
                'text' => '< meta keywords içerisine yazılacak',
            ],
        ])/*->add('description', 'textarea', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Genel Açıklama',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'nullable|min:2|max:500',
            'error_messages' => [
                'description.min' => 'Çok az bişey yazdın ya.',
            ],
        ])*/->add('status', 'select', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Durum',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
            'choices' => BlogContent::STATUSES,
        ])->add('blog_category_id', 'select', [
            'attr' => ['class' => 'form-control categories', 'multiple' => false],
            'label' => 'Kategoriler',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
            'choices' => $this->getData('categories'),
            //'selected' => $model->categories->pluck('id')->toArray(),
        ]);

        $this->add('content', 'textarea', [
            'attr' => ['class' => 'form-control'],
            'label' => 'İçerik',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
        ]);

        $this->add('cover_media', 'file', [
            'label' => 'Kapak Görseli',
            'help_block' => [
                'text' => 'Görsel dosyasını yükleyin',
            ],
            'rules' => $model->cover_media_id ? '' : 'required',
            'required' => $model->cover_media_id ? false : true,
            'image' => $model->cover_media_id ? $model->coverMedia : null,
        ])
        ;

        /*$this->add('tag_ids', 'choice', [
            'label' => 'Etiketler',
            'choices' => $model->tags->pluck('name', 'id')->toArray() ?? [],
            'attr' => ['class' => 'form-control tag-input', 'id' => 'tag_ids'],
            'help_block' => [
                'text' => 'Birden fazla etiket seçebilirsin',
            ],
            'error_messages' => [
            ],
            'multiple' => true,
            // 'expanded' => true,
            'selected' => $model->tags->pluck('id')->toArray() ?? '',
        ]);*/

        $this->add('submit', 'submit', [
            'attr' => ['class' => 'btn btn-primary'],
            'label' => 'Kaydet',
        ]);
    }
}
