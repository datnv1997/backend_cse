<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Thống kê @endsection
<!-- End block -->


<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Chọn lớp học phần:
    </h1>

</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header">
                    <form action="{{url('/searchReport')}}" method="Post">
                        @csrf
                        <div class="col-md-3">
                            <div class="form-group has-feedback">

                                <select class="form-control" id="sel1" name="sel1">

                                    <option>Chọn lớp học phần:</option>
                                    @foreach($class as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> Xem thống
                                kê</button>
                        </div>


                </div>

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