<?php

namespace App\Http\Controllers;

use App\Service\UserService;

class DefaultController extends Controller
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
        return 'welcome';
    }
}
