<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Giáo viên @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Giáo viên
    </h1>

</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <div class="box-tools pull-right">
                        <a class="btn btn-info btn-sm" href="{{ URL::route('teacher.create') }}"><i
                                class="fa fa-plus-circle"></i> Thêm mới</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body margin-top-20">
                    <div class="table-responsive">
                        <table id="listDataTableWithSearch"
                            class="table table-bordered table-striped list_view_table display responsive no-wrap"
                            width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="8%">Mã số thẻ</th>
                                    <th width="25%">Tên </th>
                                    <th width="8%">Số điện thoại</th>
                                    <th width="19%">Email</th>
                                    <th class="notexport" width="15%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $teacher)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>

                                    <td>{{ $teacher->id_card }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->phone_no }}</td>
                                    <td>{{ $teacher->email }}</td>

                                    <td>

                                        <div class="btn-group">
                                            <a title="Edit" href="{{URL::route('teacher.edit',$teacher->id)}}"
                                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            </a>
                                        </div>
                                        <!-- todo: have problem in mobile device -->
                                        <div class="btn-group">
                                            <form class="myAction" method="POST"
                                                action="{{URL::route('teacher.destroy', $teacher->id)}}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
<script type="text/javascript">
$(document).ready(function() {
    window.postUrl = '{{URL::Route("teacher.status", 0)}}';
    window.changeExportColumnIndex = 5;
    window.excludeFilterComlumns = [0, 1, 6, 7];
    Generic.initCommonPageJS();
    Generic.initDeleteDialog();
});
</script>
@endsection
<!-- END PAGE JS-->