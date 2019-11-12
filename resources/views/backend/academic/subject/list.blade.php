<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Môn học @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Môn học
        <small>Danh sách</small>
    </h1>

</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">

                    <div class="box-tools pull-right">
                        <a class="btn btn-info btn-sm" href="{{ URL::route('academic.subject_create') }}"><i
                                class="fa fa-plus-circle"></i> Thêm mới</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body margin-top-20">
                    <div class="table-responsive">
                        <table id="listDataTableWithSearch"
                            class="table table-bordered table-striped list_view_table display responsive no-wrap"
                            width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Tên</th>
                                    <th width="20%">Ngày tạo</th>
                                    <th class="notexport" width="10%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjects as $subject)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->created_at }}</td>

                                    <td>
                                        <div class="btn-group">
                                            <a title="Edit" href="{{URL::route('academic.subject_edit',$subject->id)}}"
                                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            </a>
                                        </div>
                                        <!-- todo: have problem in mobile device -->
                                        <div class="btn-group">
                                            <form class="myAction" method="POST"
                                                action="{{URL::route('academic.subject_destroy')}}">
                                                @csrf
                                                <input type="hidden" name="hiddenId" value="{{$subject->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach

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
    window.postUrl = '{{URL::Route("academic.subject_status", 0)}}';
    window.changeExportColumnIndex = 6;
    window.excludeFilterComlumns = [0, 6, 7];
    Academic.subjectInit();
    $('title').text($('title').text() + '-' + $('select[name="class_id"] option[selected]').text());
});
</script>
@endsection
<!-- END PAGE JS-->