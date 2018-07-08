<!DOCTYPE html>
<html lang="en">
@include('admin.partials.head')

<body class="login">
<div class="row">
    @include('admin.partials.messages')
    @include('admin.partials.buttons')
    @yield('content')
</div>
@include('admin.partials.bottom')
</body>
</html>
