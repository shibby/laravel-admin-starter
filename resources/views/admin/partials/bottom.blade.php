<!-- jQuery -->
<script src="/bower_components/gentelella/vendors/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/bower_components/jquery-colorbox/jquery.colorbox-min.js"></script>
<!-- Bootstrap -->
<script src="/bower_components/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/bower_components/gentelella/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="/bower_components/gentelella/vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="/bower_components/gentelella/vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="/bower_components/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="/bower_components/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="/bower_components/gentelella/vendors/jszip/dist/jszip.min.js"></script>
<script src="/bower_components/gentelella/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="/bower_components/gentelella/vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="/bower_components/summernote/dist/summernote.js"></script>
<script src="/bower_components/summernote/dist/lang/summernote-tr-TR.js"></script>
<script src="/bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<script src="/bower_components/vue/dist/vue.min.js"></script>
<script type="text/javascript">
  function elfinderDialog() {
    var fm = $('<div/>').dialogelfinder({
      url: '/admin/elfinder/get/connector', // change with the url of your connector
      lang: 'tr',
      width: 840,
      height: 450,
      destroyOnClose: true,
      getFileCallback: function(files, fm) {
        $('.content-form #text').summernote('editor.insertImage', files.url);
      },
      commandsOptions: {
        getfile: {
          oncomplete: 'close',
          folders: false
        }
      }
    }).dialogelfinder('instance');
  }
</script>
<script src="/bower_components/summernote-ext-elfinder/summernote-ext-elfinder.js"></script>
<script src="/bower_components/summernote-cleaner/summernote-cleaner.js"></script>

<script type="text/javascript" src="/bower_components/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript" src="/bower_components/elfinder/js/i18n/elfinder.tr.js"></script>
{{--<script type="text/javascript" src="/packages/barryvdh/elfinder/js/standalonepopup.min.js"></script>--}}

<script src="/bower_components/select2/dist/js/select2.full.js"></script>
<script src="/bower_components/gentelella/build/js/custom.min.js"></script>
<script src="/bower_components/moment/moment.js"></script>
<script src="/bower_components/moment/locale/tr.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- app -->

@stack('scripts')
