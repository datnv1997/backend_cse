<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Điểm danh @endsection
<!-- End block -->


<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Xem Điểm danh
    </h1>

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


                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <label>Từ </label>
                                <input type='text' readonly class="form-control date_picker" id="attendance_list_filter"
                                    name="attendance_date" placeholder="date" required value="{{$formatDate}}"
                                    minlength="10" maxlength="11"
                                    style="display:inline-block;width:60%;margin-left:5px;margin-right:5px" />
                                <label> đến nay</label>
                                <!-- <span class="fa fa-calendar form-control-feedback"></span> -->

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group has-feedback">
                                <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> Tìm
                                    kiếm</button>
                            </div>
                        </div>
                        <div class="box-tools pull-right">

                            <!-- <a class="btn btn-info btn-sm" href="/student-attendance/create"><i
                                    class="fa fa-plus-circle"></i> Điểm
                                Danh</a> -->
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
<!-- Modal -->
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
$(document).ready(function() {
    // $('#attendance_list_filter').datepicker();
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