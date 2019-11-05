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
        Bài giảng
        <small>danh sách</small>
    </h1>

</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    @if(AppHelper::getInstituteCategory() == 'college')
                    <div class="col-md-3">
                        <div class="form-group has-feedback">

                        </div>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <div class="form-group has-feedback">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback">

                        </div>
                    </div>
                    <div class="box-tools pull-right">
                        <a class="btn btn-info btn-sm" href="{{ URL::route('user.addArticle') }}"><i
                                class="fa fa-plus-circle"></i> Thêm mới</a>
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
                                    <th width="5%">id</th>
                                    <th class="notexport" width="15%">Tên bài giảng</th>
                                    <th width="10%">Tên giáo viên</th>
                                    <!-- <th width="8%">Images</th> -->
                                    <th width="15%">Phân loại bài giảng</th>
                                    <th width="10%">Môn học</th>
                                    <th width="10%">Ngày tạo</th>
                                    <th width="10%">Chi tiết</th>
                                    <th class="notexport" width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lesson as $data)
                                <td>{{$data->id}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->nameTeacher}}</td>
                                <td>{{$data->categoryLesson}}</td>
                                <td>{{$data->subject}}</td>
                                <td>{{$data->createdDate}}</td>
                                <td>{{$data->detail}}</td>
                                <td>
                                    <div class="btn-group">
                                        <form method="POST" action="{{url('/editArticles/'.$data->id)}}">
                                            @csrf
                                            <button title="Edit" type="submit" class="btn btn-info btn-sm"><i
                                                    class="fa fa-edit"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="btn-group">
                                        <form class="myAction" method="POST"
                                            action="{{url('/delArticles/'.$data->id)}}">
                                            @csrf
                                            <!-- <input name="_method" type="hidden" value="DELETE"> -->
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
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

@endsection
<!-- END PAGE JS-->