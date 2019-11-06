<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Employee;
use App\lesson;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lesson = lesson::all();
        foreach ($lesson as $key => $data) {
            $nameTeacher = Employee::select('name')->where('id', $data->idTeacher)->get();
            $nameSubject = Subject::select('name')->where('id', $data->idSubject)->get();
            $nameCategory = Categories::select('name')->where('id', $data->idCategory)->get();
            $lesson[$key]['nameTeacher'] = $nameTeacher[0]->name;
            $lesson[$key]['nameSubject'] = $nameSubject[0]->name;
            $lesson[$key]['nameCategory'] = $nameCategory[0]->name;

        }
        return view('backend.lesson.listLesson', compact('lesson'));
    }
    public function addLesson(Request $request)
    {
        $name = $request->input("nameLesson");
        $subject = $request->input("selSubject");
        $teacher = $request->input("selTeacher");
        $category = $request->input("selCate");
        $dateTime = Carbon::now();
        // dd($data);
        $urlLesson = '';
        if ($request->hasFile('fileLesson')) {

            $file = $request->fileLesson;
            $urlLesson = "/lesson/" . $file->getClientOriginalName();
            $file->move('lesson', $file->getClientOriginalName());

        }
        $model = new lesson();
        $model->name = $name;
        $model->idTeacher = $teacher;
        $model->idSubject = $subject;
        $model->idCategory = $category;
        $model->createdDate = $dateTime;
        $model->detail = $urlLesson;
        $model->save();
        return redirect('/listLesson');
    }

    public function formAddLesson()
    {
        $teacher = Employee::select('*')->where('role_id', 2)->get();
        $category = Categories::all();
        $subject = Subject::all();
        return view('backend.lesson.addLesson', compact('teacher', 'category', 'subject'));
    }
    public function filterLesson($id)
    {
        $data = lesson::select('*')->where('idCategory', $id)->get();
        foreach ($data as $key => $dataLesson) {
            $nameTeacher = Employee::select('name')->where('id', $dataLesson->idTeacher)->get();
            $nameSubject = Subject::select('name')->where('id', $dataLesson->idSubject)->get();
            $nameCategory = Categories::select('name')->where('id', $dataLesson->idCategory)->get();
            $data[$key]['nameTeacher'] = $nameTeacher[0]->name;
            $data[$key]['nameSubject'] = $nameSubject[0]->name;
            $data[$key]['nameCategory'] = $nameCategory[0]->name;
        }
        if (count($data) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list lesson",
                "data" => $data,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }
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
        lesson::destroy($id);
        return redirect('/listLesson');
    }
}
