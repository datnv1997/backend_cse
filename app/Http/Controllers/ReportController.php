<?php

namespace App\Http\Controllers;

use App\IClass;
use App\StudentAttendance;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $class = IClass::all();
        return view('backend.reportAttendance.searchReport', compact('class'));
    }
    public function search(Request $request)
    {
        $id = $request->input('sel1');
        return redirect('/report/' . $id);
    }
    public function result(Request $request, $id)
    {
        $allData = StudentAttendance::all()->where('class_id', $id);
        $arrayDate = [];
        $dataPresent = [];
        $sumStudent = [];

        foreach ($allData as $data) {
            // if()
            if (!in_array($data->attendance_date, $arrayDate)) {
                array_push($arrayDate, $data->attendance_date);
            }

        }
        foreach ($arrayDate as $date) {

            $count = 0;
            $sum = 0;
            foreach ($allData as $data) {
                if ($date == $data->attendance_date) {
                    if ($data->present == "Có mặt") {
                        $count = $count + 1;
                    }
                    $sum++;
                }
            }
            array_push($dataPresent, $count);
            array_push($sumStudent, $sum);

        }
        return view('backend.reportAttendance.reportAttendance', compact('arrayDate', 'dataPresent', 'sumStudent', 'id'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}