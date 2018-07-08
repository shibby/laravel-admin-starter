@extends('layout')

@section('content')
    <div class="col-md-6 col-xs-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i> Zaten Kayıtlı Bir Hesabınız Var mı?
                </div>
            </div>
            <div class="portlet-body">
                <a href="{{route('auth_login')}}" class="btn btn-info">
                    <i class="fa fa-user"></i> Giriş Yap
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="portlet solid">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-key"></i> Yeni Kullanıcı Kaydı
                </div>
            </div>
            <div class="portlet-body form">
                <span class="fb-login"><a href="{{route('auth_login_facebook')}}">Facebook ile Kayıt Ol</a></span>

                {!! form($form) !!}
            </div>
        </div>
    </div>

@endsection
@section('javascript')

@endsection
