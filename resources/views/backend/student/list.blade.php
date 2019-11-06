<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Student @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Sinh Viên
        <small>Danh sách</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Danh sách</li>
    </ol>
</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">

                    <div class="col-md-3">
                        <div class="form-group has-feedback">

                        </div>
                    </div>
                    <div class="box-tools pull-right">
                        <a class="btn btn-info btn-sm" href="{{ URL::route('student.create') }}"><i
                                class="fa fa-plus-circle"></i> Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="listDataTableWithSearch"
                            class="table table-bordered table-striped list_view_table display responsive no-wrap"
                            width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th class="notexport" width="7%">Họ Tên</th>
                                    <th width="8%">Ngày sinh</th>
                                    <th width="8%">Giới tính</th>
                                    <th width="8%">Email</th>
                                    <th width="19%">Id lớp</th>
                                    <th width="10%">SDT</th>
                                    <th width="10%">Ghi chú</th>
                                    <th class="notexport" width="15%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $info)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>
                                        {{$info->name}}
                                    </td>
                                    <td>{{ $info->dob }}</td>
                                    <td>{{ $info->gender }}</td>
                                    <td>{{ $info->email }}</td>
                                    <td>{{ $info->class_id }}</td>
                                    <td>{{ $info->phone_no }}</td>
                                    <td>{{ $info->note }}</td>

                                    <td>

                                        <div class="btn-group">
                                            <form method="POST" action="#">
                                                @csrf
                                                <button title="Edit" type="submit" class="btn btn-info btn-sm"><i
                                                        class="fa fa-edit"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <!-- todo: have problem in mobile device -->
                                        <div class="btn-group">
                                            <form class="myAction" method="POST"
                                                action="{{URL::route('student.destroy', $info->id)}}">
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
    window.postUrl = '{{URL::Route("student.status", 0)}}';
    window.section_list_url = '{{URL::Route("academic.section")}}';
    window.changeExportColumnIndex = 7;
    window.excludeFilterComlumns = [0, 1, 8, 9];
    Academic.studentInit();
    $('title').text($('title').text() + '-' + $('select[name="class_id"] option[selected]').text());
});
</script>
@endsection
<!-- END PAGE JS-->