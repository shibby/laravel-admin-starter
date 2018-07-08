<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <base href="{{url('/')}}/"/>
    <title>{{@$siteTitle}}</title>
    <link rel="stylesheet" type="text/css" href="/asset/build/css/build.css?v=">
    <link rel="stylesheet" type="text/css" href="/theme/atlas/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,300i,400,500,700,900&amp;subset=latin-ext"
          rel="stylesheet">

    @include('partials.header_seo')
    @stack('rss_links')
    @stack('css')
    {{--<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Website",
      "url": "{{ config.siteUrl }}",
      "potentialAction":{
        "@type": "SearchAction",
        "target": "/search/{search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>--}}
</head>
<body>
@include('theme.menu')
<div class="container">
    @if(!empty($pageTitle))
        <h1>{{$pageTitle}}</h1>
    @endif
</div>
@yield('beforeContent')
<div class="container" role="main">
    @yield('content')
</div>
<footer>
    <div class="text-center">
        <hr/>
        {{ config('app.name') }} - {{date('Y')}}<br/>
        {{--<a href="/privacy-policy">Veteriner Ekle</a> -
        <a href="/privacy-policy">Gizlilik Sözleşmesi</a> -
        <a href="/terms-of-use">Kullanım Şartları</a> -
        <a href="/contact">İletişime Geçin</a>--}}
    </div>

</footer>

<!-- Script -->
<script type="text/javascript">
  window.isLogged = {{\Auth::check() ? 1 : 0}};
  window.urlPath = '{{\Request::getRequestUri()}}';
  window.loggedInUserId = {{\Auth::user()->id ?? 0}};
</script>
<script src="/asset/build/js/build.js?version="></script>
@yield('extrajs')
@stack('javascript')
</body>
</html>
