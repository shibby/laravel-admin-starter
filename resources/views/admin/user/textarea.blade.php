@extends('admin.panel')

@section('panel')
    Emailler:
    <textarea class="form-control" rows="5">{{$emails}}</textarea>
    Facebook Id:
    <textarea class="form-control" rows="5">{{$fbIds}}</textarea>
@endsection
