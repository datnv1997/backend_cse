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
        Categories
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Categories</li>
    </ol>
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
                        <a class="btn btn-info btn-sm" href="{{ URL::route('student.create') }}"><i
                                class="fa fa-plus-circle"></i> Add New</a>
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
                                    <th width="5%">#</th>
                                    <th class="notexport" width="7%">Photo</th>
                                    <th width="8%">Regi. No.</th>
                                    <th width="8%">Roll No.</th>
                                    <th width="8%">ID Card</th>
                                    <th width="19%">Name</th>
                                    <th width="10%">Phone No</th>
                                    <th width="10%">Email</th>
                                    <th width="10%">Status</th>
                                    <th class="notexport" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>

                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="5%">#</th>
                                    <th class="notexport" width="7%">Photo</th>
                                    <th width="8%">Regi. No.</th>
                                    <th width="8%">Roll No.</th>
                                    <th width="8%">ID Card</th>
                                    <th width="19%">Name</th>
                                    <th width="10%">Phone No</th>
                                    <th width="10%">Email</th>
                                    <th width="10%">Status</th>
                                    <th class="notexport" width="15%">Action</th>
                                </tr>
                            </tfoot>
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
    window.postUrl = '{{URL::Route("student.status", 0)}}';
    window.section_list_url = '{{URL::Route("academic.section")}}';
    window.changeExportColumnIndex = 7;
    window.excludeFilterComlumns = [0, 1, 8, 9];
    Academic.studentInit();
    $('title').text($('title').text() + '-' + $('select[name="class_id"] option[selected]').text() + '(' + $(
        'select[name="section_id"] option[selected]').text() + ')');
});
</script>
@endsection
<!-- END PAGE JS-->