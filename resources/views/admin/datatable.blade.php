@extends('admin.panel')

@section('panel')
    {!! $dataTable->table(['class'=>'table table-striped'], true) !!}
@endsection
