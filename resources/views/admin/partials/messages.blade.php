@if(!empty($flashMessages))
    @foreach($flashMessages as $flashMessage)
        @if($flashMessage instanceof \Shibby\Loilerplate\Helper\FlashMessage)
            <div class="alert alert-{{$flashMessage->getCssClass()}} {{$alertClass ?? ''}}">
                {!! $flashMessage->getIcon() !!} {{$flashMessage->getText()}}
            </div>
        @endif
    @endforeach
@endif
@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(!empty($message))
    @foreach($message as $msg)
        @if(!empty($msg['message']))
            <?php if ($msg['type'] == "error") {
                $msg['type'] = 'danger';
            }
            ?>
            <div class="alert alert-{{$msg['type']}} {{$alertClass ?? ''}}">
                <button class="close" data-close="alert"></button>
                @if(!empty($msg['icon']))
                    <i class="fa fa-{{$msg['icon']}}"></i>
                @else
                    @if($msg['type'] == "success")
                        <i class="fa fa-check"></i>
                    @elseif($msg['type'] == "danger")

                    @endif
                @endif
                {!! $msg['message'] !!}
            </div>
        @endif
    @endforeach
@endif