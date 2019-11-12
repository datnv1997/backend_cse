<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Sự kiện @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Sự kiện
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
                    <h3 class="box-title">Sự kiện</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-info btn-sm" href="{{ URL::route('event.create') }}"><i
                                class="fa fa-plus-circle"></i> Thêm mới</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="eventList" class="table table-bordered table-striped list_view_table">
                        <thead>
                            <tr>
                                <th width="30%">Tên</th>
                                <th width="20%">Thời gian</th>
                                <th width="20%">Địa điểm</th>
                                <th width="20%">Ảnh</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>

                                <td>{{ $event->title }}</td>
                                <td> {{ $event->event_time->format('d/m/Y h:i a') }}</td>
                                <td> {{ $event->location }}</td>
                                <td> {{ $event->cover_photo }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a title="Edit" href="{{URL::route('event.edit',$event->id)}}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <form class="myAction" method="POST"
                                            action="{{URL::route('event.destroy',$event->id)}}">
                                            {{ method_field('DELETE') }}
                                            @csrf
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
                    {{ $events->links() }}
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
    Site.EventInit();
    initDeleteDialog();
});
</script>
@endsection
<!-- END PAGE JS-->