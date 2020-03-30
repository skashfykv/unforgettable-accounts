@extends('content_layout.default')


@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Error 404</h1>
        </section>
        <section class="content">
            Page Not found
        </section>
    </div>
    {!! HTML::script('plugins/jQuery/jquery-2.2.3.min.js') !!}
    <!-- Bootstrap 3.3.6 -->
    {!! HTML::script('bootstrap/js/bootstrap.min.js') !!}
    <!-- DataTables -->
    {!! HTML::script('plugins/datatables/jquery.dataTables.min.js') !!}
    {!! HTML::script('plugins/datatables/dataTables.bootstrap.min.js') !!}
    <!-- SlimScroll -->
    {!! HTML::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
    {!! HTML::script('plugins/fastclick/fastclick.js') !!}
    <!-- AdminLTE App -->
    {!! HTML::script('dist/js/app.min.js') !!}
    <!-- AdminLTE for demo purposes -->
    {!! HTML::script('dist/js/demo.js') !!}
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
        let delete_id;
        $('.delete-btn').on('click',function () {
            delete_id = $(this).val();
            $('#delete-modal').modal('show')
        });
        $('.delete-record').on('click',function () {
            $('#record-'+delete_id).submit()
        });
    </script>
@endsection