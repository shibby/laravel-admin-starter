@extends('layout')

@section('content')

    <div class="col-md-6 col-xs-12">
        <div class="portlet solid">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-key"></i> Kullanıcı Girişi
                </div>
            </div>
            <div class="portlet-body form">
                {!! form($form) !!}
                <div class="reg-form">
                    <span class="fb-login"><a href="{{route('auth_login_facebook')}}">Facebook ile Giriş Yap</a></span>
                    <div class="action-btn pass"><a href="{{route('auth_password_reset_form')}}">Parolamı Unuttum</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i> Yeni üye misiniz?
                </div>
            </div>
            <div class="portlet-body form">
                <p>
                Hoşgeldiniz :) <a href="{{route('auth_register')}}">Buraya tıklayarak</a>, üyelik sürecinizi başlatabilirsiniz.
                </p>
                <p>
                    <ul>
                    <li>
                        <a href="{{route('auth_register')}}">
                        Yeni üye kaydı
                        </a>
                    </li>
                    <li>
                        <a href="{{route('auth_password_reset_form')}}">Parolamı Unuttum</a>
                    </li>
                </ul>
                </p>

            </div>
        </div>
    </div>
@endsection
@section('javascript')

@endsection
