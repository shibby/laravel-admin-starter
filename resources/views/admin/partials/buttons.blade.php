@if(!empty($buttons))
    <div class="row">
        <div class="col-sm-12">
            @foreach($buttons as $button)
                <a href="{{$button['url']}}" class="btn btn-{{$button['class']}}">
                    {{$button['text']}}
                </a>
            @endforeach
        </div>
    </div>
@endif