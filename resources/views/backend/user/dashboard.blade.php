<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Dashboard @endsection
<!-- End block -->
@section('extraStyle')
<style>
.notification li {
    font-size: 16px;
}

.notification li.info span.badge {
    background: #00c0ef;
}

.notification li.warning span.badge {
    background: #f39c12;
}

.notification li.success span.badge {
    background: #00a65a;
}

.notification li.error span.badge {
    background: #dd4b39;
}

.total_bal {
    margin-top: 5px;
    margin-right: 5%;
}

.phpdebugbar-openhandler-overlay {
    display: none !important;
}

#crvPop {
    display: none !important;
}

.modal-backdrop {
    display: none !important;
}

.modal,
.modal-open {
    overflow: auto !important;
}

footer {
    display: none;
}
</style>
@endsection
<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Main content -->
<section class="content">
    @if($userRoleId == AppHelper::USER_ADMIN)
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box ">
                <a class="small-box-footer bg-orange-dark" href="{{URL::route('student.index')}}">
                    <div class="icon bg-orange-dark" style="padding: 9.5px 18px 8px 18px;">
                        <i class="fa icon-student"></i>
                    </div>
                    <div class="inner ">
                        <h3 class="text-white">{{$students}} </h3>
                        <p class="text-white">
                            Student </p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box ">
                <a class="small-box-footer bg-pink-light" href="{{URL::route('teacher.index')}}">
                    <div class="icon bg-pink-light" style="padding: 9.5px 18px 8px 18px;">
                        <i class="fa icon-teacher"></i>
                    </div>
                    <div class="inner ">
                        <h3 class="text-white">
                            {{$teachers}} </h3>
                        <p class="text-white">
                            Teacher </p>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-lg-3 col-xs-6">
            <div class="small-box ">
                <a class="small-box-footer bg-teal-light" href="{{URL::route('academic.subject')}}">
                    <div class="icon bg-teal-light" style="padding: 9.5px 18px 8px 18px;">
                        <i class="fa icon-subject"></i>
                    </div>
                    <div class="inner ">
                        <h3 class="text-white">
                            {{$subjects}} </h3>
                        <p class="text-white">
                            Subject </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endif




</section>
<!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
<script src="{{asset(mix('js/dashboard.js'))}}"></script>
<script type="text/javascript">
@if($userRoleId == AppHelper::USER_ADMIN)
window.smsLabel = @php echo json_encode(array_keys($monthWiseSms)) @endphp;
window.smsValue = @php echo json_encode(array_values($monthWiseSms)) @endphp;
@endif
@if($userRoleId != AppHelper::USER_STUDENT)
window.attendanceLabel = @php echo json_encode(array_keys($attendanceChartPresentData)) @endphp;
window.presentData = @php echo json_encode(array_values($attendanceChartPresentData)) @endphp;
window.absentData = @php echo json_encode(array_values($attendanceChartAbsentData)) @endphp;
@endif
$(document).ready(function() {
    Dashboard.init();

});
</script>
@endsection
<!-- END PAGE JS-->