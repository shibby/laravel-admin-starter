@if(!empty($breadcrumbs) && $breadcrumbs instanceof \Illuminate\Support\Collection)
    <ul class="page-breadcrumb breadcrumb">
        @foreach($breadcrumbs as $k => $bc)
            <li>
                @if($k === 0)
                    <i class="fa fa-home"></i>
                @endif
                <a href="{{$bc->getUrl()}}">{{$bc->getText()}}</a>
                {{--<i class="fa fa-angle-right"></i>--}}
            </li>
        @endforeach
    </ul>
@endif
