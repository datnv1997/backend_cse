<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Lớp học phần @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>

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
                        <a class="btn btn-info btn-sm" href="{{ URL::route('academic.class_create') }}"><i
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
                                    <th width="15%">Tên lớp học phần</th>
                                    <th width="15%">mã năm học</th>
                                    <th width="15%">mã học kì</th>
                                    <th width="15%">mã giai đoạn</th>
                                    <th width="15%">mã môn học</th>
                                    <th width="5%">Ghi chú</th>
                                    <!-- <th width="10%">Status</th> -->
                                    <th class="notexport" width="10%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($iclasses as $iclass)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{ $iclass->name }}</td>
                                    <td>{{ $iclass->idYear }}</td>
                                    <td>{{ $iclass->idSemester }}</td>
                                    <td>{{ $iclass->idPhase }}</td>
                                    <td>{{ $iclass->idSubject }}</td>
                                    <td>{{ $iclass->note }}</td>

                                    <td>
                                        <div class="btn-group">
                                            <a title="Edit" href="{{URL::route('academic.class_edit',$iclass->id)}}"
                                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            </a>
                                        </div>
                                        <!-- todo: have problem in mobile device -->
                                        <div class="btn-group">
                                            <form class="myAction" method="POST"
                                                action="{{URL::route('academic.class_destroy')}}">
                                                @csrf
                                                <input type="hidden" name="hiddenId" value="{{$iclass->id}}">
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
    window.postUrl = '{{URL::Route("academic.class_status", 0)}}';
    window.changeExportColumnIndex = 6;
    window.excludeFilterComlumns = [0, 2, 3, 5, 6, 7];
    Academic.iclassInit();
});
</script>
@endsection
<!-- END PAGE JS-->