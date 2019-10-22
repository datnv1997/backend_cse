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
                    @if(count($errors->all()))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(!count($students))
                    <p class="lead section-title-top-zero">Chọn lớp học phần:</p>
                    <div class="row">
                        <form novalidate id="entryForm"
                            action="{{URL::Route('student_attendance.searchAndCreateAttendance')}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @if(AppHelper::getInstituteCategory() == 'college')
                            <div class="col-md-3">
                                <div class="form-group has-feedback">
                                    <label for="academic_year">Academic Year<span class="text-danger">*</span></label>
                                    {!! Form::select('academic_year', $academic_years, null , ['placeholder' => 'Pick a
                                    year...','class' => 'form-control select2', 'required' => 'true']) !!}
                                    <span class="form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('academic_year') }}</span>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-3">
                                <div class="form-group has-feedback">
                                    <label for="class_id">Lớp học phần<span class="text-danger">*</span></label>
                                    {!! Form::select('class_id', $classes, null , ['placeholder' => 'Chọn lớp học
                                    phần...','class' => 'form-control select2', 'required' => 'true']) !!}
                                    <span class="form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('class_id') }}</span>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group has-feedback">
                                    <label for="attendance_date">Ngày điểm danh<span class="text-danger"></span></label>
                                    <input type='text' class="form-control date_picker attendanceExistsChecker" readonly
                                        name="attendance_date" placeholder="date" value="{{$attendance_date}}" required
                                        minlength="10" maxlength="11" />
                                    <span class="fa fa-calendar form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('attendance_date') }}</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info margin-top-20"><i class="fa fa-filter"></i>
                                    Điểm danh</button>
                            </div>
                        </form>
                    </div>
                    @endif




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
    // Academic.attendanceInit();
});
</script>
@endsection
<!-- END PAGE JS-->