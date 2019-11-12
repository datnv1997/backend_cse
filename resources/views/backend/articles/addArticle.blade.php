<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Bài viết @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Thêm bài viết
    </h1>

</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form novalidate id="entryForm" action="{{url('/addArticleController')}}" method="POST"
                    enctype="multipart/form-data">

                    <div class="box-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="name">Tên<span class="text-danger">*</span></label>
                                    <input autofocus type="text" class="form-control" name="name"
                                        placeholder="Tên bài viết" value="" required minlength="2" maxlength="255">
                                    <!-- <span class="fa fa-info form-control-feedback"></span> -->
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="sel1">Phân loại</label>
                                    <select class="form-control" name="sel">
                                        <option value=''>-</option>
                                        @foreach($obj as $data)
                                        <option value="{{$data->name}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="name">Mô tả ngắn<span class="text-danger"></span></label>
                                    <textarea type="text" class="form-control" rows="5" name="subDescription"
                                        placeholder="Mô tả ngắn bài viết"></textarea>
                                    <!-- <span class="fa fa-info form-control-feedback"></span> -->
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <label for="photo">Photo<span class="text-danger"></span></label>
                                    <input type="file" class="form-control" accept=".jpeg, .jpg, .png" name="photo"
                                        placeholder="Photo image"
                                        onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">

                                    <span class=" glyphicon glyphicon-open-file form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img id="output" src="" width="100" height="100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" rows="5" id="description"
                                        name="description"></textarea>
                                </div>

                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="/articles" class="btn btn-default">Hủy bỏ</a>
                        <button type="submit" class="btn btn-info pull-right"><i
                                class="fa fa-refresh fa-plus-circle"></i> thêm </button>

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
<script src="//cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
<script>
CKEDITOR.replace('description');
</script>
@endsection
<!-- END PAGE JS-->