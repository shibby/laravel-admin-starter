<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$siteTitle ?? ''}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        @if(\Auth::check())
        window.token = '{{\JWTAuth::fromUser(\Auth::user())}}';
        @endif
    </script>

    <!-- Bootstrap -->
    <link href="/bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bower_components/jquery-ui/themes/base/all.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/bower_components/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/bower_components/gentelella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="/bower_components/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css"
          rel="stylesheet">
    <link href="/bower_components/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
          rel="stylesheet">
    <link href="/bower_components/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"
          rel="stylesheet">
    <link href="/bower_components/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"
          rel="stylesheet">
    <link href="/bower_components/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
          rel="stylesheet">

    <!-- datetimepicker -->
    <link rel="stylesheet"
          href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">

    <!-- summernote wysiwyg -->
    <link rel="stylesheet"
          href="/bower_components/summernote/dist/summernote.css">

    <!-- select2 -->
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.css">
    <link rel="stylesheet" href="/bower_components/select2-bootstrap-theme/dist/select2-bootstrap.css">

    <link rel="stylesheet" href="/bower_components/jquery-colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="/bower_components/elfinder/css/elfinder.min.css">
    <link rel="stylesheet" href="/bower_components/elfinder/css/theme.css">

    <!-- Custom Theme Style -->
    <link href="/bower_components/gentelella/build/css/custom.min.css" rel="stylesheet">

    <link href="/bower_components/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" rel="stylesheet">
    <!-- app -->
    <link href="/css/admin.css" rel="stylesheet">
    @stack('styles')
</head>
