<?php

namespace App\Http\Controllers;

use App\Categories;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obj = Categories::all();

        return view('backend.categories.categories', compact('obj'));
    }
    public function add()
    {
        $obj = Categories::whereNull('parentId')->get();
        return view('backend.categories.addCate', compact('obj'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        // $uuid = Str::uuid()->toString();
        $name = $request->input('name');
        $description = $request->input('description');
        $createdDate = Carbon::now();

        $sel = $request->input('sel');
        $parentId = '';
        if ($sel == '') {
            $sel = null;
        }
        if ($sel == null) {
            $parentId = null;
        }
        if ($sel != null) {

            $temp = Categories::where('name', $sel)->get();

            $parentId = $temp[0]->id;

        }
        $pathImg = '';
        if ($request->hasFile('photo')) {
            $img = $request->photo;
            $nameImg = $img->getClientOriginalName();
            $pathImg = "\/images/" . $nameImg;
            $img->move('images', $nameImg);
        }

        $model = new Categories();
        // $model->id = $uuid;
        $model->name = $name;
        $model->description = $description;
        $model->images = $pathImg;
        $model->preLevel = $sel;
        $model->parentId = $parentId;
        $model->createdDate = $createdDate;
        $model->save();
        return redirect('/categories');

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
        $obj = Categories::all();
        $model = Categories::find($id);

        return view('backend.categories.edit', compact('model', 'obj'));
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
        $name = $request->input('name');
        $description = $request->input('description');

        $sel = $request->input('sel');
        $parentId = '';
        if ($sel == '') {
            $sel = null;
        }
        if ($sel == null) {
            $parentId = null;
        }
        if ($sel != null) {

            $temp = Categories::where('name', $sel)->get();

            $parentId = $temp[0]->id;

        }
        $pathImg = '';
        if ($request->hasFile('photo')) {
            $img = $request->photo;
            $nameImg = $img->getClientOriginalName();
            $pathImg = "\/images/" . $nameImg;
            $img->move('images', $nameImg);
        }

        $model = Categories::find($id);
        // $model->id = $uuid;
        $model->name = $name;
        $model->description = $description;
        $model->images = $pathImg;
        $model->preLevel = $sel;
        $model->parentId = $parentId;

        $model->save();
        return redirect('/categories');
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
        Categories::destroy($id);
        return redirect('/categories');

    }
}
