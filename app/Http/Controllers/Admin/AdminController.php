<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Shibby\Loilerplate\Controller\BaseController;

class AdminController extends BaseController
{
    // we will fill it if we need

    protected $parameters = [
        'siteTitle' => 'Admin',
        'siteDescription' => 'Yönetim Paneli',
        'pageTitle' => '',
    ];

    protected function initializeViewParameters()
    {
        parent::initializeViewParameters();
    }

    protected function addBreadcrumb($url, $text = '', $icon = '')
    {
        if (!array_key_exists('breadcrumbs', $this->parameters)) {
            parent::addBreadcrumb(route('admin_index'), 'Homepage');
        }
        parent::addBreadcrumb($url, $text, $icon);
    }

    protected function addButton($url, $text, $class = 'info', $permission = null)
    {
        if (null !== $permission && \Auth::user()->cannot($permission)) {
            return;
        }
        if ('create' === $class) {
            $class = 'success';
        }
        $this->parameters['buttons'][] = [
            'url' => $url,
            'text' => $text,
            'class' => $class,
        ];
    }

    protected function getUser(): ?User
    {
        return auth()->user();
    }
}
