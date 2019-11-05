<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Báo cáo @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
<section class="content-header">
    <h1>
        Thống kế điểm danh mã lớp học phần: {{$id}}
    </h1>

</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <canvas id="myChart" width="80vw" height="30vh"></canvas>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script>
var sumStudentIclass = @json($sumStudent);
var presentStudent = @json($dataPresent);
var arrayDate = @json($arrayDate);

console.log(sumStudentIclass);
// console.log(presentStudent);
// console.log(arrayDate);

var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: arrayDate,
        datasets: [{
            label: 'Sinh viên có mặt',
            data: presentStudent,
            // scaleOverride: true,
            // scaleSteps: 2, // number of ticks
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{

                ticks: {
                    suggestedMax: sumStudentIclass[0],
                    beginAtZero: true,
                    stepSize: 1,

                }
            }],

        }
    }
});
</script>
@endsection

<!-- END PAGE JS-->