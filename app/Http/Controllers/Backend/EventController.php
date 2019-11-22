<?php

namespace App\Http\Controllers\Backend;

use App\Event;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(env('MAX_RECORD_PER_PAGE', 25));
        return view('backend.site.event.list', compact('events'));
    }

    public function create(Request $request)
    {
        $event = null;
        return view('backend.site.event.add', compact('event'));
    }

    public function store(Request $request)
    {
        //validate form
        // $messages = [
        //     'slider_1.max' => 'The :attribute size must be under 2MB.',
        //     'slider_1.dimensions' => 'The :attribute dimensions must be minimum 1170 X 580.',
        //     'slider_2.max' => 'The :attribute size must be under 2MB.',
        //     'slider_2.dimensions' => 'The :attribute dimensions must be minimum 1170 X 580.',
        //     'slider_3.max' => 'The :attribute size must be under 2MB.',
        //     'slider_3.dimensions' => 'The :attribute dimensions must be minimum 1170 X 580.',
        //     'cover_photo.max' => 'Nhập ảnh quá tối đa 2MB.',
        //     'cover_photo.dimensions' => 'The :attribute dimensions must be minimum 370 X 270.',
        // ];
        // $this->validate($request, [
        //     'title' => 'required|min:5|max:255',
        //     'event_time' => 'required|min:5|max:255',
        //     'cover_photo' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=370,min_height=270',
        //     'slider_1' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=1170,min_height=580',
        //     'slider_2' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=1170,min_height=580',
        //     'slider_3' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=1170,min_height=580',
        //     'description' => 'required',
        //     // 'tags' => 'max:255',
        //     'cover_videos' => 'max:255',
        // ], $messages);

        $data = $request->all();
        $datetime = Carbon::createFromFormat('d/m/Y h:i a', $data['event_time']);
        $data['event_time'] = $datetime;

        $fileName = null;

        if ($request->hasFile('cover_photo')) {
            $img = $request->cover_photo;
            $nameImg = $img->getClientOriginalName();
            $img->move('images', $nameImg);
            $file_path = "/images/" . $nameImg;
            $data['cover_photo'] = $file_path;

        }

        Event::create($data);
        // Cache::forget('upcomming_event');

        return redirect()->route('event.index')->with('Đã thêm thành công');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('backend.site.event.add', compact('event'));
    }

    public function update(Request $request, $id)
    {
        //validate form
        // $messages = [
        //     'slider_1.max' => 'The :attribute size must be under 2MB.',
        //     'slider_1.dimensions' => 'The :attribute dimensions must be minimum 1170 X 580.',
        //     'slider_2.max' => 'The :attribute size must be under 2MB.',
        //     'slider_2.dimensions' => 'The :attribute dimensions must be minimum 1170 X 580.',
        //     'slider_3.max' => 'The :attribute size must be under 2MB.',
        //     'slider_3.dimensions' => 'The :attribute dimensions must be minimum 1170 X 580.',
        //     'cover_photo.max' => 'The :attribute size must be under 2MB.',
        //     'cover_photo.dimensions' => 'The :attribute dimensions must be minimum 370 X 270.',
        // ];
        // $this->validate($request, [
        //     'title' => 'required|min:5|max:255',
        //     'event_time' => 'required|min:5|max:255',
        //     'cover_photo' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=370,min_height=270',
        //     'slider_1' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=1170,min_height=580',
        //     'slider_2' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=1170,min_height=580',
        //     'slider_3' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=1170,min_height=580',
        //     'description' => 'required',
        //     // 'tags' => 'max:255',
        //     'cover_videos' => 'max:255',
        // ], $messages);

        $data = $request->all();
        $datetime = Carbon::createFromFormat('d/m/Y h:i a', $data['event_time']);
        $data['event_time'] = $datetime;
        $data['location'] = $request->input('location');
        $event = Event::findOrFail($id);

        $fileName = null;
        if ($request->hasFile('cover_photo')) {

            if ($event->cover_photo) {
                $img = $request->cover_photo;
                $nameImg = $img->getClientOriginalName();
                $img->move('images', $nameImg);
                $file_path = "/images/" . $nameImg;
                // dd($file_path);
                Storage::delete($file_path);
                $data['cover_photo'] = $file_path;
            }
            $storagepath = $request->file('cover_photo');
            $nameImg = $storagepath->getClientOriginalName();
            // $storagepath->move('images', $nameImg);
            $file_path = "/images/" . $nameImg;
            // $fileName = basename($storagepath);
            // dd($fileName);
            $data['cover_photo'] = $file_path;

        }
        $fileName = null;
        // dd($data);

        $event->fill($data);
        $event->save();

        return redirect()->route('event.index')->with('success', 'Event information updated.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event deleted.');
    }

    public function getAllEvent()
    {
        $event = Event::select('*')->orderBy('event_time', 'DESC')->get();

        if (count($event) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list event",
                "data" => $event,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }

    public function detailEvent($id)
    {
        $event = Event::select('*')->where('id', $id)->get();

        if (count($event) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list category",
                "data" => $event,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }
    public function relatedEvent($id)
    {
        $event = Event::select('*')->where('id', '!=', $id)->orderBy('created_at', 'DESC')->take(3)->get();

        if (count($event) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list category",
                "data" => $event,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }

    public function listTopEvent()
    {
        $event = Event::select('*')->orderBy('created_at', 'DESC')->take(4)->get();

        if (count($event) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list category",
                "data" => $event,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);

    }
}
