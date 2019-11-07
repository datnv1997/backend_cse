<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Điểm danh sinh viên @endsection
<!-- End block -->


<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Điểm danh sinh viên
        <small>Danh sách</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><i class="fa icon-attendance"></i> điểm danh</li>
        <li class="active">Sinh viên</li>
    </ol>
</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">

                    <div class="row">

                        <div class="col-md-5">
                            <div class="box-tools pull-left">

                                <a class="btn btn-info btn-sm" href="/student-attendance"><i
                                        class="fa fa-arrow-back"></i> Quay lại</a>
                            </div>


                        </div>
                    </div>
                    <div class="row" style="display:flex;justify-content:center">
                        <div class="col-md-12 text-center">
                            <h4>Tên lớp học phần:{{$iClass->name}}</h4>
                            <p>Mã lớp học phần:{{$iClass->id}}</p>
                        </div>
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
                                    <th width="5%">MSV</th>
                                    <th width="20%">Họ tên</th>
                                    <th width="10%">Ngày điểm danh</th>

                                    <th width="5%">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student as $key=>$data)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$data->student_id}}</td>
                                    <td>{{$data->nameStudent}}</td>
                                    <td>{{$data->attendance_date}}</td>
                                    <td>{{$data->present}}</td>
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
    window.postUrl = '{{URL::Route("student_attendance.status", 0)}}';
    window.section_list_url = '{{URL::Route("academic.section")}}';
    window.changeExportColumnIndex = 4;
    window.changeExportColumnValue = ['Có', 'Vắng'];
    window.excludeFilterComlumns = [0, 4, 5, 6, 7];
    Academic.attendanceInit();
    $('title').text($('title').text() + '-' + $('select[name="class_id"] option[selected]').text() + '(' + $(
        'select[name="section_id"] option[selected]').text() + ')');
});
</script>
@endsection
<!-- END PAGE JS-->