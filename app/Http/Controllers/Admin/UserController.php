<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Forms\Admin\UserForm;
use App\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class UserController extends AdminController
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        $this->addBreadcrumb(route('admin_index'), __('admin.users.list'));
    }

    public function indexAction(UsersDataTable $dataTable)
    {
        $this->setTitle(__('admin.users.list'));

        $this->addButton(route('admin_user_form'), __('admin.users.create_user'), 'create');

        return $this->renderDatatable($dataTable, 'admin.datatable');
    }

    public function formAction(FormBuilder $formBuilder, Request $request, User $user = null)
    {
        if (null !== $user) {
            $this->addBreadcrumb(route('admin_user_form', ['user' => $user]), __('admin.users.edit_user'));
            $this->setTitle(__('admin.users.edit_user'));
        } else {
            $this->addBreadcrumb(route('admin_user_form', ['user' => $user]), __('admin.users.create_user'));
            $this->setTitle(__('admin.users.create_user'));
        }

        $form = $formBuilder->create(UserForm::class, [
            'method' => 'POST',
            'url' => $request->fullUrl(),
            'model' => $user,
        ]);

        if ($request->isMethod('post')) {
            $form->redirectIfNotValid();

            $post = $request->request->all();
            $this->userService->saveUser($user, $post);

            $this->setFlashMessage('success', __('admin.success'));

            return redirect()->to(route('admin_user_index'));
        }

        return $this->renderView('admin.form', [
            'form' => $form,
        ]);
    }

    public function deleteAction(User $user)
    {
        if ($this->getUser()->id === $user->id) {
            $this->setFlashMessage('error', __('admin.users.user_delete_error_self'));

            return redirect()->back();
        }

        $user->delete();
        $this->setFlashMessage('success', __('admin.users.user_deleted'));

        return redirect()->back();
    }
}
