<?php

namespace App\Http\Controllers\Backend;

use App\AcademicYear;
use App\Http\Controllers\Controller;
use App\Http\Helpers\AppHelper;
use App\IClass;
use App\Registration;
use App\Student;
use App\Subject;
use App\Template;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::all();

        return view('backend.student.list', compact('students'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $class = IClass::all();

        return view('backend.student.add', compact(
            'class'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $dataInput = $request->all();
        // $gen = $request->gender;
        $student->fill($dataInput)->save();

        // dd($dataInput);
        //validate form
        $messages = [
            'name.required' => 'Chưa nhập tên',
            'dob.required' => 'chưa nhập ngày sinh',
        ];
        $rules = [
            'name' => 'required|min:5|max:255',

            'dob' => 'min:10|max:10',
            'gender' => 'required|integer',
            'phone_no' => 'nullable|max:15',
            'note' => 'nullable|max:500',

            'email' => 'nullable|email|max:255',
            'class_id' => 'required|integer',

        ];

        $this->validate($request, $rules);
        $students = Student::all();

        return view('backend.student.list', compact('students'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // if print id card of this student then
        // Do here
        if ($request->query->get('print_idcard', 0)) {

            $templateId = AppHelper::getAppSettings('student_idcard_template');
            $templateConfig = Template::where('id', $templateId)->where('type', 3)->where('role_id', AppHelper::USER_STUDENT)->first();

            if (!$templateConfig) {
                return redirect()->route('administrator.template.idcard.index')->with('error', 'Template not found!');
            }

            $templateConfig = json_decode($templateConfig->content);

            $format = "format_";
            if ($templateConfig->format_id == 2) {
                $format .= "two";
            } else if ($templateConfig->format_id == 3) {
                $format .= "three";
            } else {
                $format .= "one";
            }

            //get institute information
            $instituteInfo = AppHelper::getAppSettings('institute_settings');

            $students = Registration::where('id', $id)
                ->where('status', AppHelper::ACTIVE)
                ->with(['student' => function ($query) {
                    $query->select('name', 'blood_group', 'id', 'photo');
                }])
                ->with(['class' => function ($query) {
                    $query->select('name', 'group', 'id');
                }])
                ->select('id', 'roll_no', 'regi_no', 'student_id', 'class_id', 'house', 'academic_year_id')
                ->orderBy('roll_no', 'asc')
                ->get();

            if (!$students) {
                abort(404);
            }

            $acYearInfo = AcademicYear::where('id', $students[0]->academic_year_id)->first();
            $session = $acYearInfo->title;
            $validity = $acYearInfo->end_date->format('Y');

            if ($templateConfig->format_id == 3) {
                $validity = $acYearInfo->end_date->format('F Y');
            }

            $totalStudent = count($students);

            $side = 'both';
            return view('backend.report.student.idcard.' . $format, compact(
                'templateConfig',
                'instituteInfo',
                'side',
                'students',
                'totalStudent',
                'session',
                'validity'
            ));
        }

        //get student
        $student = Registration::where('id', $id)
            ->with('student')
            ->with('class')
        // ->with('section')
            ->with('acYear')
            ->first();
        if (!$student) {
            abort(404);
        }
        $username = '';
        $fourthSubject = '';
        $altfourthSubject = '';

        if ($student->fourth_subject) {
            $subjectInfo = Subject::where('id', $student->fourth_subject)->select('name')->first();
            $fourthSubject = $subjectInfo->name;
        }

        if ($student->alt_fourth_subject) {
            $subjectInfo = Subject::where('id', $student->alt_fourth_subject)->select('name')->first();
            $altfourthSubject = $subjectInfo->name;
        }

        if ($student->student->user_id) {
            $user = User::find($student->student->user_id);
            $username = $user->username;
        }
        return view('backend.student.view', compact('student', 'username', 'fourthSubject', 'altfourthSubject'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regiInfo = Registration::find($id);
        if (!$regiInfo) {
            abort(404);
        }
        $student = Student::find($regiInfo->student_id);
        if (!$student) {
            abort(404);
        }
        $classes = IClass::where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');
        // $sections = Section::where('class_id', $regiInfo->class_id)->where('status', AppHelper::ACTIVE)
        //     ->pluck('name', 'id');

        $isCollege = (AppHelper::getInstituteCategory() == 'college');
        $subjectType = $isCollege ? 0 : 2;
        $electiveSubjects = Subject::select('id', 'name')->where('class_id', $regiInfo->class_id)
            ->sType($subjectType)->where('status', AppHelper::ACTIVE)->orderBy('name', 'asc')->pluck('name', 'id');
        $coreSubjects = null;
        if ($isCollege) {
            $coreSubjects = Subject::select('id', 'name')->where('class_id', $regiInfo->class_id)
                ->sType(1)->where('status', AppHelper::ACTIVE)->orderBy('name', 'asc')->pluck('name', 'id');
        }

        $gender = $student->getOriginal('gender');
        $religion = $student->getOriginal('religion');
        $bloodGroup = $student->getOriginal('blood_group');
        $nationality = ($student->nationality != "Bangladeshi") ? "Other" : "";
        $shift = $regiInfo->shift;

        // $section = $regiInfo->section_id;
        $iclass = $regiInfo->class_id;
        $esubject = $regiInfo->fourth_subject;
        $csubject = $regiInfo->alt_fourth_subject;

        $users = [];
        if (!$student->user_id) {
            $users = User::doesnthave('employee')
                ->doesnthave('student')
                ->whereHas('role', function ($query) {
                    $query->where('role_id', AppHelper::USER_STUDENT);
                })
                ->pluck('name', 'id');
        }

        return view('backend.student.add', compact(
            'regiInfo',
            'student',
            'gender',
            'religion',
            'bloodGroup',
            'nationality',
            'classes',
            // 'sections',
            'shift',
            'iclass',
            // 'section',
            'electiveSubjects',
            'coreSubjects',
            'esubject',
            'csubject',
            'users'
        ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $regiInfo = Registration::find($id);
        if (!$regiInfo) {
            abort(404);
        }
        $student = Student::find($regiInfo->student_id);
        if (!$student) {
            abort(404);
        }

        //validate form
        $messages = [
            'photo.max' => 'The :attribute size must be under 200kb.',
            'photo.dimensions' => 'The :attribute dimensions min 150 X 150.',
        ];
        $rules = [
            'name' => 'required|min:5|max:255',
            'photo' => 'mimes:jpeg,jpg,png|max:200|dimensions:min_width=150,min_height=150',
            'dob' => 'min:10|max:10',
            'gender' => 'required|integer',
            'religion' => 'nullable|integer',
            'blood_group' => 'nullable|integer',
            'nationality' => 'required|max:50',
            'phone_no' => 'nullable|max:15',
            'extra_activity' => 'nullable|max:15',
            'note' => 'nullable|max:500',
            'father_name' => 'nullable|max:255',
            'father_phone_no' => 'nullable|max:15',
            'mother_name' => 'nullable|max:255',
            'mother_phone_no' => 'nullable|max:15',
            'guardian' => 'nullable|max:255',
            'guardian_phone_no' => 'nullable|max:15',
            'present_address' => 'nullable|max:500',
            'permanent_address' => 'required|max:500',
            'card_no' => 'nullable|min:4|max:50|unique:registrations,card_no,' . $regiInfo->id,
            'email' => 'nullable|email|max:255|unique:students,email,' . $student->id . '|email|unique:users,email,' . $student->user_id,
            'class_id' => 'required|integer',
            // 'section_id' => 'required|integer',
            'shift' => 'nullable|max:15',
            'roll_no' => 'nullable|integer',
            'board_regi_no' => 'nullable|max:50',
            'fourth_subject' => 'nullable|integer',
            'user_id' => 'nullable|integer',
            'house' => 'nullable|max:100',

        ];

        //if it college then need another 1 feilds
        if (AppHelper::getInstituteCategory() == 'college') {
            $rules['alt_fourth_subject'] = 'nullable|integer';
        }

        $this->validate($request, $rules);

        if (AppHelper::getInstituteCategory() != 'college') {
            // now check is academic year set or not
            $settings = AppHelper::getAppSettings();
            if (!isset($settings['academic_year']) || (int) ($settings['academic_year']) < 1) {
                return redirect()->back()
                    ->with("error", 'Academic year not set yet! Please go to settings and set it.');

            }
        }

        $data = $request->all();

        if ($data['nationality'] == 'Other') {
            $data['nationality'] = $data['nationality_other'];
        }

        $imgStorePath = "public/student/" . $regiInfo->class_id;
        if ($request->hasFile('photo')) {
            $storagepath = $request->file('photo')->store($imgStorePath);
            $fileName = basename($storagepath);
            $data['photo'] = $fileName;

            //if file change then delete old one
            $oldFile = $request->get('oldPhoto', '');
            if ($oldFile != '') {
                $file_path = $imgStorePath . '/' . $oldFile;
                Storage::delete($file_path);
            }
        } else {
            $data['photo'] = $request->get('oldPhoto', '');
        }

        $registrationData = [
//            'class_id' => $data['class_id'],
            // 'section_id' => $data['section_id'],
            'roll_no' => $data['roll_no'],
            'shift' => $data['shift'],
            'card_no' => $data['card_no'],
            'board_regi_no' => $data['board_regi_no'],
            'fourth_subject' => $data['fourth_subject'] ?? 0,
            'alt_fourth_subject' => $data['alt_fourth_subject'] ?? 0,
            'house' => $data['house'] ?? '',
        ];

        // now check if student academic information changed, if so then log it
        $isChanged = false;
        $logData = [];
        $timeNow = Carbon::now();
        // if($regiInfo->section_id != $data['section_id']){
        //     $isChanged = true;
        //     $logData[] = [
        //         'student_id' => $regiInfo->student_id,
        //         'academic_year_id' => $regiInfo->academic_year_id,
        //         'meta_key' => 'section',
        //         'meta_value' => $regiInfo->section_id,
        //         'created_at' => $timeNow,

        //     ];
        // }
        if ($regiInfo->roll_no != $data['roll_no']) {
            $isChanged = true;
            $logData[] = [
                'student_id' => $regiInfo->student_id,
                'academic_year_id' => $regiInfo->academic_year_id,
                'meta_key' => 'roll no',
                'meta_value' => $regiInfo->roll_no,
                'created_at' => $timeNow,

            ];
        }

        if ($regiInfo->shift != $data['shift']) {
            $isChanged = true;
            $logData[] = [
                'student_id' => $regiInfo->student_id,
                'academic_year_id' => $regiInfo->academic_year_id,
                'meta_key' => 'shift',
                'meta_value' => $regiInfo->shift,
                'created_at' => $timeNow,

            ];
        }

        if ($regiInfo->card_no != $data['card_no']) {
            $isChanged = true;
            $logData[] = [
                'student_id' => $regiInfo->student_id,
                'academic_year_id' => $regiInfo->academic_year_id,
                'meta_key' => 'card no',
                'meta_value' => $regiInfo->card_no,
                'created_at' => $timeNow,

            ];
        }
        if ($regiInfo->board_regi_no != $data['board_regi_no']) {
            $isChanged = true;
            $logData[] = [
                'student_id' => $regiInfo->student_id,
                'academic_year_id' => $regiInfo->academic_year_id,
                'meta_key' => 'board regi no',
                'meta_value' => $regiInfo->board_regi_no,
                'created_at' => $timeNow,

            ];
        }

        if ($regiInfo->fourth_subject != $data['fourth_subject']) {
            $isChanged = true;
            $logData[] = [
                'student_id' => $regiInfo->student_id,
                'academic_year_id' => $regiInfo->academic_year_id,
                'meta_key' => 'fourth subject',
                'meta_value' => $regiInfo->fourth_subject,
                'created_at' => $timeNow,

            ];
        }

        //if it college then need another 1 feilds
        if (AppHelper::getInstituteCategory() == 'college') {
            if ($regiInfo->alt_fourth_subject != $data['alt_fourth_subject']) {
                $isChanged = true;
                $logData[] = [
                    'student_id' => $regiInfo->student_id,
                    'academic_year_id' => $regiInfo->academic_year_id,
                    'meta_key' => 'alt fourth subject',
                    'meta_value' => $regiInfo->alt_fourth_subject,
                    'created_at' => $timeNow,

                ];
            }
        }

        $message = 'Something went wrong!';
        DB::beginTransaction();
        try {

            // save registration data
            $regiInfo->fill($registrationData);
            $regiInfo->save();

            //
            if (!$student->user_id && $request->get('user_id', 0)) {
                $data['user_id'] = $request->get('user_id');
            }

            // now save student
            $student->fill($data);
            if (($student->isDirty('email') || $student->isDirty('phone_no'))
                && ($student->user_id || isset($data['user_id']))) {
                $userId = $data['user_id'] ?? $student->user_id;
                $user = User::where('id', $userId)->first();
                $user->email = $data['email'];
                $user->phone_no = $data['phone_no'];
                $user->save();
            }
            $student->save();

            //if have changes then insert log
            if ($isChanged) {
                DB::table('student_info_log')->insert($logData);
            }
            // now commit the database
            DB::commit();

            return redirect()->route('student.index', ['class' => $regiInfo->class_id, 'academic_year' => $regiInfo->academic_year_id])->with('success', 'Student updated!');

        } catch (\Exception $e) {
            DB::rollback();
            $message = str_replace(array("\r", "\n", "'", "`"), ' ', $e->getMessage());
//            dd($message);
        }

        return redirect()->route('student.edit', $regiInfo->id)->with("error", $message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registration = Registration::find($id);
        if (!$registration) {
            abort(404);
        }
        $student = Student::find($registration->student_id);
        if (!$student) {
            abort(404);
        }

        $message = 'Something went wrong!';
        DB::beginTransaction();
        try {

            $registration->delete();
            $student->delete();
            if ($student->user_id) {
                $user = User::find($student->user_id);
                $user->delete();
            }
            DB::commit();

            //now notify the admins about this record
            $msg = $student->name . " student deleted by " . auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $msg);
            // Notification end
            //invalid dashboard cache
            Cache::forget('studentCount');
            Cache::forget('student_count_by_class');
            // Cache::forget('student_count_by_section');

            return redirect()->route('student.index')->with('success', 'Student deleted.');

        } catch (\Exception $e) {
            DB::rollback();
            $message = str_replace(array("\r", "\n", "'", "`"), ' ', $e->getMessage());
        }
        return redirect()->route('student.index')->with('error', $message);

    }

    /**
     * status change
     * @return mixed
     */
    public function changeStatus(Request $request, $id = 0)
    {

        $registration = Registration::find($id);
        if (!$registration) {
            return [
                'success' => false,
                'message' => 'Record not found!',
            ];
        }
        $student = Student::find($registration->student_id);
        if (!$student) {
            return [
                'success' => false,
                'message' => 'Record not found!',
            ];
        }

        $student->status = (string) $request->get('status');
        $registration->status = (string) $request->get('status');
        if ($student->user_id) {
            $user = User::find($student->user_id);
            $user->status = (string) $request->get('status');
        }

        $message = 'Something went wrong!';
        DB::beginTransaction();
        try {

            $registration->save();
            $student->save();
            if ($student->user_id) {
                $user->save();
            }
            DB::commit();

            return [
                'success' => true,
                'message' => 'Status updated.',
            ];

        } catch (\Exception $e) {
            DB::rollback();
            $message = str_replace(array("\r", "\n", "'", "`"), ' ', $e->getMessage());
        }

        return [
            'success' => false,
            'message' => $message,
        ];

    }

    /**
     * Get student list by filters
     */
    public function studentListByFitler(Request $request)
    {
        $classId = $request->query->get('class', 0);
        // $sectionId = $request->query->get('section',0);
        $acYear = $request->query->get('academic_year', 0);

        if (AppHelper::getInstituteCategory() != 'college') {
            $acYear = AppHelper::getAcademicYear();
        }

        $students = Registration::where('academic_year_id', $acYear)
            ->where('class_id', $classId)
        // ->where('section_id', $sectionId)
            ->where('status', AppHelper::ACTIVE)
            ->with(['student' => function ($query) {
                $query->select('name', 'id');
            }])
            ->select('id', 'roll_no', 'student_id')
            ->orderBy('roll_no', 'asc')
            ->get();

        return response()->json($students);

    }
}