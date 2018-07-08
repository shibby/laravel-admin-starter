<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function notFoundAction()
    {
        //response()->setStatusCode(404);

        return $this->renderView('errors.404');
    }
}
