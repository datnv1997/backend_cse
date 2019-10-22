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
        Điểm danh
        <small>Thêm mới</small>
    </h1>
    <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><i class="fa icon-attendance"></i> Điểm danh</li>
        <li><a><i class="fa icon-student"></i>Sinh viên</a></li>
        <li class="active">Add</li>
    </ol>
</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body">

                    <p class="lead section-title-top-zero">Chọn lớp học phần:</p>
                    <div class="container" style="width:100%">
                        <div class="row">
                            <form novalidate id="entryForm" action="{{URL::Route('student_attendance.createDiemDanh')}}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="container" style="padding-left:0">
                                    <div class="col-md-6" style="padding-left:0">
                                        <div class="form-group">
                                            <label for="sel1">Lớp:</label>
                                            <select class="form-control" name="sel1">

                                                <option value="{{$class->id}}" selected>{{$class->id}}</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">


                                    <p class="lead section-title-top-zero p-5" style="padding-left:15px">Danh sách sinh
                                        viên:
                                    </p>
                                    <div class="col-md-12">


                                        <table id="studentListTable"
                                            class="table table-bordered table-striped table-responsive attendance-add">

                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="5%">Msv</th>
                                                    <th width="30%">Tên</th>
                                                    <th width="30%">
                                                        Có mặt?
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($students as $key=>$student)
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{$student->student_id}}</td>
                                                    <td>{{$student->name}}</td>
                                                    <td>
                                                        <div class="checkbox icheck inline_icheck">
                                                            <input type="checkbox"
                                                                name="present[{{$student->student_id}}]">
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-info pull-right"><i
                                                class="fa fa-plus-circle"></i>
                                            Add Attendance</button>

                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="/student-attendance" class="btn btn-default">Cancel</a>
                </div>
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
window.section_list_url = '{{URL::Route("academic.section")}}';

$(document).ready(function() {
    Academic.attendanceInit();
});
</script>
@endsection
<!-- END PAGE JS-->