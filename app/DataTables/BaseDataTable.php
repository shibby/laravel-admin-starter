<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;

class BaseDataTable extends DataTable
{
    protected function editButton($url, $text = null): string
    {
        return '<a class="btn btn-xs btn-info"href="'.$url.'"><i class="fa fa-edit"></i> '.$text.'</a>';
    }

    protected function deleteButton($url, $text = null): string
    {
        return '<a class="btn btn-xs btn-danger" onclick="return confirm(\''.__('admin.delete_confirmation').'\');"
             href="'.$url.'">
                <i class="fa fa-trash"></i> '.$text.'</a>';
    }
}
