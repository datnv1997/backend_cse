<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Bài giảng @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Thêm bài giảng
    </h1>

</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form novalidate id="entryForm" action="{{url('/addLesson')}}" method="POST"
                    enctype="multipart/form-data">

                    <div class="box-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="name">Tên bài giảng</label>
                                    <input autofocus type="text" class="form-control" name="nameLesson"
                                        placeholder="Tên bài giảng" value="" required minlength="2" maxlength="255">

                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="sel1">Tên giáo viên</label>
                                    <select class="form-control" name="selTeacher">
                                        <option value=''>-</option>
                                        @foreach($teacher as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="sel1">Phân loại bài giảng</label>

                                    <select class="form-control" name="selCate">
                                        <option value=''>-</option>
                                        @foreach($category as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="sel1">Tên môn học</label>

                                    <select class="form-control" name="selSubject">
                                        <option value=''>-</option>
                                        @foreach($subject as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="sel1">Upload File</label>
                                    <input type="file" name="fileLesson" required="true">

                                </div>
                            </div>

                        </div>



                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="/lesson" class="btn btn-default">Hủy bỏ</a>
                        <button type="submit" class="btn btn-info pull-right"><i
                                class="fa fa-refresh fa-plus-circle"></i> Thêm mới </button>

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

@endsection
<!-- END PAGE JS-->
