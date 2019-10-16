<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Student Attendance @endsection
<!-- End block -->


<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Student Attendance
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><i class="fa icon-attendance"></i> Attendance</li>
        <li class="active">Student</li>
    </ol>
</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <form action="{{url('/student-attendance/search')}}" method="Post">
                        @csrf
                        <div class="col-md-3">
                            <div class="form-group has-feedback">

                                <select class="form-control" id="sel1" name="sel1">

                                    <option>Chọn lớp học phần:</option>
                                    @foreach($iClass as $data )
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group has-feedback">

                                <input type='text' readonly class="form-control date_picker" id="attendance_list_filter"
                                    name="attendance_date" placeholder="date" required value="{{$formatDate}}"
                                    minlength="10" maxlength="11" />
                                <span class="fa fa-calendar form-control-feedback"></span>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-feedback">
                                <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> Tìm
                                    kiếm</button>
                            </div>
                        </div>
                        <div class="box-tools pull-right">

                            <a class="btn btn-info btn-sm" href="/student-attendance/create"><i
                                    class="fa fa-plus-circle"></i> Điểm
                                Danh</a>
                            <!-- <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> Điểm Danh</button> -->

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
                                    <th width="10%">Thời gian vào</th>
                                    <th width="15%">Thời gian ra</th>
                                    <th width="15%">Tổng thời gian</th>
                                    <th width="5%">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>

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
    // $('#attendance_list_filter').datepicker();
    window.postUrl = '{{URL::Route("student_attendance.status", 0)}}';
    window.section_list_url = '{{URL::Route("academic.section")}}';
    window.changeExportColumnIndex = 4;
    window.changeExportColumnValue = ['Present', 'Absent'];
    window.excludeFilterComlumns = [0, 4, 5, 6, 7];
    Academic.attendanceInit();
    $('title').text($('title').text() + '-' + $('select[name="class_id"] option[selected]').text() + '(' + $(
        'select[name="section_id"] option[selected]').text() + ')');
});
</script>
@endsection
<!-- END PAGE JS-->