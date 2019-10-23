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
        Sinh viên
        <small>thêm</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><a href="#"><i class="fa icon-student"></i> Sinh viên</a></li>
        <li class="active">Thêm</li>
    </ol>
</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form novalidate id="entryForm" action="{{ URL::route('student.store') }}" method="post"
                    enctype="multipart/form-data">

                    <div class="box-body">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="name">Tên<span class="text-danger">*</span></label>
                                    <input autofocus type="text" class="form-control" name="name" placeholder="name"
                                        value="" required minlength="2" maxlength="255">
                                    <span class="fa fa-info form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="dob">Ngày sinh<span class="text-danger">*</span></label>
                                    <input type='text' class="form-control date_picker2" name="dob" placeholder="date"
                                        value="" required minlength="10" maxlength="255" />
                                    <span class="fa fa-calendar form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="gender">Giới tính<span class="text-danger">*</span>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom"
                                            title="" data-original-title="select gender type"></i>
                                    </label>
                                    <select class="form-control" id="selGender" name="gender">

                                        <option value="1">Nữ</option>
                                        <option value="2">Nam</option>

                                    </select>
                                    <span class="form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="email address"
                                        value="" maxlength="100">
                                    <span class="fa fa-envelope form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="phone_no">Sdt</label>
                                    <input type="text" class="form-control" name="phone_no"
                                        placeholder="phone or mobile number" value="" maxlength="15">
                                    <span class="fa fa-phone form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="class_id">Lớp
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom"
                                            title="" data-original-title="Set class that student belongs to"></i>



                                    </label>

                                    <select class="form-control" id="selClass" name="class_id">
                                        <option></option>

                                        @foreach($class as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="note">Note</label>
                                        <textarea name="note" class="form-control" maxlength="500" row="9"></textarea>
                                        <span class="fa fa-info form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('note') }}</span>
                                    </div>
                                </div>
                            </div>








                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{URL::route('student.index')}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-plus-circle"></i>
                                Tạo</button>

                        </div>
                </form>
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
    window.section_list_url = '{{URL::Route("academic.section")}}';
    window.subject_list_url = '{{URL::Route("academic.subject")}}';
    Academic.studentInit();

});
</script>
@endsection
<!-- END PAGE JS-->