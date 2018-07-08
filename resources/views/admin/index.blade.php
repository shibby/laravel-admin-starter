@extends('admin.layout')
@section('content')
    <div class="col-sm-12">
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Üye Sayısı</span>
                <div class="count">{{$counts['user']}}</div>
                <span class="count_bottom">{{--<i class="green">4% </i> From last Week--}}</span>
            </div>
        </div>
    </div>
@endsection
