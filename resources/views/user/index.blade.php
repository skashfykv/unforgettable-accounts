@extends('content_layout.default')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>View All User</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('user.create') }}" class="btn btn-primary text-white btn-xs" data-title="Add" data-target="#Add"><span class="fa fa-plus">Add</span></a>
                </li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    @if(Session::has('success_message'))
                        <div style="text-align: center;" class="alert alert-success">{{Session::get('success_message')}}</div>
                    @endif
                    @if(Session::has('error_message'))
                        <div style="text-align: center;" class="alert alert-danger">{{Session::get('error_message')}}</div>
                    @endif
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $value)
                                        <tr>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>
                                                @if(Auth::user()->id == 1)
                                                    <a href="{{ route('user.edit',$value->id) }}" class="btn btn-primary btn-xs" data-title="Edit" data-target="#edit"><span class="fa fa-pencil"></span></a>
                                                @else
                                                    <a href="{{ route('user.edit',$value->id) }}" {{ ( (int) $value->id == Auth::user()->id ) ? '' :'disabled' }} class="btn btn-primary btn-xs" data-title="Edit" data-target="#edit"><span class="fa fa-pencil"></span></a>
                                                @endif

                                                @if(Auth::user()->id == 1)
                                                    <button class="btn btn-danger btn-xs delete-btn" {{ ($value->id==1) ? 'disabled' : '' }}  value="{{ $value->id }}"><i class="fa fa-remove"></i></button>
                                                @else
                                                    <button class="btn btn-danger btn-xs delete-btn" {{ ( (int) $value->id == Auth::user()->id ) ? '' :'disabled' }} value="{{ $value->id }}"><i class="fa fa-remove"></i></button>
                                                @endif

                                                <form id="record-{{$value->id}}" action="{{ route('user.destroy',$value->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div id="delete-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Record</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this record ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete-record" data-dismiss="modal">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
    </body>
    </html>
@endsection