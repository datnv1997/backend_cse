<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Sinh viên @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Điểm danh
        <small>Thêm mới</small>
    </h1>

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
                    <p class="lead section-title-top-zero">Chọn lớp học phần:</p>
                    <div class="row">
                        <form novalidate id="entryForm"
                            action="{{URL::Route('student_attendance.searchAndCreateAttendance')}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-3">
                                <div class="form-group has-feedback">

                                    <select class="form-control" id="selYear" name="selYear">

                                        <option value=''>Năm học:</option>
                                        @foreach($year as $data )
                                        <option value="{{$data->id}}">{{$data->title}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-feedback">

                                    <select class="form-control" id="selSemester" name="selSemester">

                                        <option>Học kì:</option>
                                        @foreach($semester as $data )
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-feedback">

                                    <select class="form-control" id="selPhase" name="selPhase">

                                        <option>Chọn giai đoạn:</option>
                                        @foreach($phase as $data )
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-feedback">

                                    <select class="form-control" id="selSubject" name="selSubject">

                                        <option>Chọn môn học:</option>
                                        @foreach($subject as $data )
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-feedback">

                                    <select class="form-control" id="sel1" name="sel1">

                                        <option>Chọn lớp học phần:</option>

                                        <!-- <option value="tes">tesst</option> -->

                                    </select>

                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group has-feedback">
                                    <input type='text' class="form-control date_picker attendanceExistsChecker" readonly
                                        name="attendance_date" placeholder="date" value="{{$formatDate}}" required
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
                        </form>
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
<div class="modal fade" id="myModal" role="dialog" style="z-index:9999">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">
                <p>Mời nhập thông tin đầy đủ để hiện lớp học phần.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
<script type="text/javascript">
// console.log($("#sel1"));


$("#sel1").click(function() {
    var year = $("#selYear").val();
    var semester = $("#selSemester").val();
    var phase = $("#selPhase").val();
    var subject = $("#selSubject").val();
    if (year == '' || subject == '' || semester == '' || phase == '') {
        // alert("Xin nhập thông tin đầy đủ");
        $("#myModal").modal();
    }
})

// console.log(class);
$("#selSubject").change(function() {
    // alert("hêllo")
    $("#sel1 option").nextAll().remove();
    var year = $("#selYear").val();
    var semester = $("#selSemester").val();
    var phase = $("#selPhase").val();
    var subject = $("#selSubject").val();
    if (year != '' && subject != '' && semester != '' && phase != '') {
        $.ajax({
            url: `/student-attendance/fullSearch/${year}/${semester}/${phase}/${subject}`,
            contentType: 'application/json',
            processData: false,
            dataType: 'json',
            type: 'get',
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                res.forEach(element => {
                    $("#sel1").append(
                        `<option value="${element.id}">${element.name}</option>`)
                });
            },
            error: function(err) {
                console.log(err);
            },
        })
    }
})
</script>
<script type="text/javascript">
window.section_list_url = '{{URL::Route("academic.section")}}';

$(document).ready(function() {
    // Academic.attendanceInit();
});
</script>

@endsection
<!-- END PAGE JS-->