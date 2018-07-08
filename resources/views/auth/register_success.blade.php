@extends('layout')

@section('content')
    <div class="heading-divider offset-top-0">
        <h4>Kayıt Başarılı</h4>
    </div>

    <p>
        Kayıt olduğun için teşekkürler {{auth()->user()->name}},
    </p>
    <p>
        Platformumuzda güven duygusunu sağlamamız bizim için çok önemli. Bu yüzden
        zaman zaman senden bazı doğrulamalara dahil olmanı isteyeceğiz.
    </p>
    <p>
        İlk olarak telefon numarası doğrulaması yapmamız gerekiyor.
    </p>

    @if(!$phone)
        <div class="col-md-8 ">
            <div class="portlet solid">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-key"></i> Telefon Numarası Kaydet
                    </div>
                </div>
                <div class="portlet-body form">
                    {!! form($form) !!}
                </div>
            </div>
        </div>
    @else
        <div class="col-md-8 ">
            <div class="portlet solid">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-key"></i> Doğrulama Kodunu Gir
                    </div>
                </div>
                <div class="portlet-body form">
                    {{$phone->phone}} numarasına gönderdiğimiz doğrulama kodunu girin. <br/>

                    {!! form($validationForm) !!}
                </div>
            </div>
        </div>
    @endif

@endsection
