<?php

namespace App\Forms\Admin;

use App\Model\Advertisement;
use Kris\LaravelFormBuilder\Form;

class AdvertisementForm extends Form
{
    public function buildForm()
    {
        $advertisements = $this->getData('advertisements');

        /** @var Advertisement $advertisement */
        foreach ($advertisements as $advertisement) {
            $this->add($advertisement->ads_key, 'textarea', [
                'attr' => ['class' => 'form-control', 'rows' => 4],
                'label' => $advertisement->ads_key,
                'label_attr' => ['class' => 'control-label'],
                'rules' => 'nullable',
                'value' => $advertisement->ads_html,
            ]);
        }

        $this->add('submit', 'submit', [
            'attr' => ['class' => 'btn btn-primary'],
            'label' => 'Kaydet',
        ]);
    }
}
