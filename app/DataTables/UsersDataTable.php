<?php

namespace App\DataTables;

use App\User;

class UsersDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query results from query() method
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('created_at', function (User $model) {
                return $model['created_at']->format('d-m-Y H:i');
            })
            ->addColumn('role_id', function (User $model) {
                return \App\User::ROLES[$model->role_id];
            })
            ->addColumn('status_id', function (User $model) {
                return \App\User::STATUSES[$model->status_id];
            })
            ->addColumn('action', function (User $model) {
                $editButton = $this->editButton(route('admin_user_form', ['user' => $model]));
                $deleteButton = $this->deleteButton(route('admin_user_delete', ['user' => $model]));

                return $editButton.$deleteButton;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->withCount([
            'userLogins',
        ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->addAction(['width' => '80px'])
            ->parameters(
                array_merge(
                    $this->getBuilderParameters(),
                    ['order' => [[4, 'asc']]]
                )
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'name', 'name' => 'name', 'title' => __('admin.users.name')],
            ['data' => 'email', 'name' => 'email', 'title' => __('admin.users.email')],
            ['data' => 'status_id', 'name' => 'status_id', 'title' => __('admin.users.status'), 'searchable' => false],
            ['data' => 'role_id', 'name' => 'role_id', 'title' => __('admin.users.role'), 'searchable' => false],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => __('admin.users.created_at'), 'searchable' => false],
            ['data' => 'user_logins_count', 'name' => 'user_logins_count', 'title' => __('admin.users.login_count'), 'searchable' => false, 'orderable' => true],
            ['data' => 'action', 'name' => 'action', 'title' => __('admin.actions'), 'searchable' => false, 'orderable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_'.date('YmdHis');
    }
}
