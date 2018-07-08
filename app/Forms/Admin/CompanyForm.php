<?php

namespace App\Forms\Admin;

use App\Model\Company;
use Kris\LaravelFormBuilder\Form;

class CompanyForm extends Form
{
    public function buildForm()
    {
        /** @var Company|null $model */
        $model = $this->getModel();
        if ($model && $model->id) {
            $this->add('routeUrl', 'hidden', [
                'help_block' => [
                    'text' => '<a href="'.$model->routeUrl.'" target="_blank">'.$model->routeUrl.'</a>',
                ],
            ]);
        }

        $this->add('name', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Firma Adı',
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
        ])/*->add('seo_title', 'text', [
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
        ])*/
        ->add('description', 'textarea', [
            'attr' => ['class' => 'form-control', 'rows' => 3],
            'label' => 'Kısa Firma Tanımı',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'nullable|min:2|max:500',
            'error_messages' => [
                'description.min' => 'Çok az bişey yazdın ya.',
            ],
        ])->add('status', 'select', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Durum',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
            'choices' => Company::STATUSES,
        ])/*->add('is_featured', 'select', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Anasayfada Öne Çıkanlar',
            'label_attr' => ['class' => 'control-label'],
            'help_block' => [
                'text' => 'Anasayfada 4lü kutuda görüntülenecek. Son eklenen ilk görüntülenir.',
            ],
            'choices' => [
                '0' => 'Hayır',
                '1' => 'Evet',
            ],
        ])*/
        ->add('category_ids', 'select', [
            'attr' => ['class' => 'form-control categories', 'multiple' => true],
            'label' => 'Kategoriler',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
            'choices' => $this->getData('categories'),
            'selected' => $model->categories->pluck('id')->toArray() ?: (array) request()->get('category_id'),
        ]);

//        $this->add('content', 'textarea', [
//            'attr' => ['class' => 'form-control'],
//            'label' => 'Firma detayları',
//            'label_attr' => ['class' => 'control-label'],
//            //'rules' => 'required',
//        ]);

        $this->add('contact[contact_person]', 'text', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Yetkili Kişi',
            'label_attr' => ['class' => 'control-label'],
            'value' => $this->getModel()->contact->contact_person ?? null,
        ]);

        $this->add('city_id', 'select', [
            'attr' => ['class' => 'form-control city', 'id' => 'city_id'],
            'label' => 'Şehir',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
            'choices' => $this->getData('cities'),
            //'selected' => $model->categories->pluck('id')->toArray(),
            'wrapper' => [
                'class' => 'col-sm-6',
            ],
        ])->add('district_id', 'select', [
            'attr' => ['class' => 'form-control', 'id' => 'district_id', 'data-selected-id' => $this->getModel()->district_id ?? null],
            'label' => 'İlçe',
            'label_attr' => ['class' => 'control-label'],
            'rules' => 'required',
            'choices' => [],
            'wrapper' => [
                'class' => 'col-sm-6',
            ],
        ]);

        $this->add('contact[address]', 'textarea', [
            'attr' => ['class' => 'form-control', 'rows' => 2],
            'label' => 'Adres',
            'label_attr' => ['class' => 'control-label'],
            'value' => $this->getModel()->contact->address ?? null,
        ]);
        $this->add('contact[phone]', 'tel', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Telefon',
            'label_attr' => ['class' => 'control-label'],
            'value' => $this->getModel()->contact->phone ?? null,
            'wrapper' => [
                'class' => 'col-sm-4',
            ],
        ])->add('contact[phone_emergency]', 'tel', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Acil Telefon',
            'label_attr' => ['class' => 'control-label'],
            'value' => $this->getModel()->contact->phone_emergency ?? null,
            'wrapper' => [
                'class' => 'col-sm-4',
            ],
        ])->add('contact[phone_cell]', 'tel', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Cep Telefon',
            'label_attr' => ['class' => 'control-label'],
            'value' => $this->getModel()->contact->phone_cell ?? null,
            'wrapper' => [
                'class' => 'col-sm-4',
            ],
        ]);

        $this->add('contact[email]', 'email', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Email',
            'label_attr' => ['class' => 'control-label'],
            'value' => $this->getModel()->contact->email ?? null,
            'wrapper' => [
                'class' => 'col-sm-6',
            ],
        ])->add('contact[website]', 'url', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Website',
            'label_attr' => ['class' => 'control-label'],
            'value' => $this->getModel()->contact->website ?? null,
            'wrapper' => [
                'class' => 'col-sm-6',
            ],
        ]);

        $this->add('contact[facebook_link]', 'url', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Facebook Sayfa Adresi',
            'label_attr' => ['class' => 'control-label'],
            'value' => $this->getModel()->contact->facebook_link ?? null,
            'wrapper' => [
                'class' => 'col-sm-6',
            ],
        ])->add('contact[instagram_link]', 'url', [
            'attr' => ['class' => 'form-control'],
            'label' => 'Instagram Sayfa Adresi',
            'label_attr' => ['class' => 'control-label'],
            'value' => $this->getModel()->contact->instagram_link ?? null,
            'wrapper' => [
                'class' => 'col-sm-6',
            ],
        ]);

        $this->add('cover_media', 'file', [
            'label' => 'Ana Görsel',
            'help_block' => [
                'text' => 'Görsel dosyasını yükleyin',
            ],
            //'rules' => $model->cover_media_id ? '' : 'required',
            //'required' => $model->cover_media_id ? false : true,
            'image' => $model->cover_media_id ? $model->coverMedia : null,
        ]);

        //$model->tag_ids = $model->tags->pluck('id')->toArray() ?? '';
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
