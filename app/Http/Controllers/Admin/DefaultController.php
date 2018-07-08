<?php

namespace App\Http\Controllers\Admin;

use App\Service\UserService;

class DefaultController extends AdminController
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function indexAction()
    {
        $counts['user'] = $this->userService->getUserCount([]);

        return $this->renderView('admin.index', [
            'counts' => $counts,
        ]);
    }
}
