<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Events @endsection
<!-- End block -->

<!-- BEGIN PAGE CSS-->
@section('extraStyle')
@endsection

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        sự kiện
        <small>Thêm sự kiện</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:;"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><a href="javascript:;"><i class="fa icon-Event"></i> Sự kiện</a></li>
        <li class="active">Thêm</li>
    </ol>
</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form novalidate id="EventForm"
                    action="@if($event) {{URL::Route('event.update', $event->id)}} @else {{URL::Route('event.store')}} @endif "
                    method="post" enctype="multipart/form-data">

                    <!-- /.box-header -->
                    <div class="box-body">
                        @csrf
                        @if($event) {{ method_field('PATCH') }} @endif
                        <div class="form-group has-feedback">
                            <label for="title">Tên event<span class="text-danger">*</span></label>
                            <input autofocus type="text" class="form-control" name="title" placeholder="title"
                                value="@if($event){{ $event->title }}@else{{ old('title') }} @endif" required
                                minlength="5" maxlength="255">
                            <span class="glyphicon glyphicon-info form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="event_time">Thời gian<span class="text-danger">*</span></label>
                            <input type='text' class="form-control event_time" name="event_time" placeholder="title"
                                value="@if($event){{ $event->event_time->format('d/m/Y h:i a') }}@else{{ old('event_time',date('d/m/Y h:i a')) }} @endif"
                                required minlength="5" maxlength="255" />
                            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('event_time') }}</span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="cover_photo">Cover Photo<span class="text-danger"></span></label>
                            <input type="file" class="form-control" accept=".jpeg, .jpg, .png" name="cover_photo">
                            <span class="glyphicon glyphicon-open-file form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('cover_photo') }}</span>
                        </div>


                        <div class="form-group has-feedback">
                            <label for="description">Mô tả<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control textarea" required
                                minlength="5">@if($event){{ $event->description }}@else{{ old('description') }} @endif</textarea>
                            <span class="glyphicon glyphicon-info form-control-feedback"></span>
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="location">Địa điểm</label>
                            <input type="text" class="form-control" name="location" placeholder="Mời nhập địa điểm"
                                value="@if($event){{ $event->location }}@else{{ old('location') }} @endif"
                                maxlength="255">
                            <span class="glyphicon glyphicon-info form-control-feedback"></span>
                        </div>




                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{URL::route('event.index')}}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info pull-right"><i
                                class="fa @if($event) fa-refresh @else fa-plus-circle @endif"></i> @if($event) Update
                            @else Add @endif</button>

                    </div>
                    {{--@if (count($errors) > 0)--}}
                    {{--<div class="error">--}}
                    {{--<ul>--}}
                    {{--@foreach ($errors->all() as $error)--}}
                    {{--<li>{{ $error }}</li>--}}
                    {{--@endforeach--}}
                    {{--</ul>--}}
                    {{--</div>--}}
                    {{--@endif--}}
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
<!-- editor js -->
<script>
//editor jQuery Patch fixing
jQuery = $;
</script>
<script src="{{ asset('/js/editor.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    Site.EventInit();



});
</script>
@endsection
<!-- END PAGE JS-->
