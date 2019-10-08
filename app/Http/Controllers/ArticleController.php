<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obj = Articles::all();

        return view('backend.articles.articles', compact('obj'));
    }
    public function add()
    {
        $obj = Categories::whereNotNull('parentId')->get();

        return view('backend.articles.addArticle', compact('obj'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $name = $request->input('name');
        $description = $request->input('description');
        $subDescription = $request->input('subDescription');
        $sel = $request->input('sel');
        $categoryIds = '';
        if ($sel == '') {
            $sel = null;
        }
        if ($sel == null) {
            $categoryIds = null;
        }
        if ($sel != null) {

            $temp = Categories::where('name', $sel)->get();

            $categoryIds = $temp[0]->id;

        }
        $pathImg = '';
        if ($request->hasFile('photo')) {
            $img = $request->photo;
            $nameImg = $img->getClientOriginalName();
            $pathImg = "\/images/" . $nameImg;
            $img->move('images', $nameImg);
        }

        $model = new Articles();
        // $model->id = $uuid;
        $model->name = $name;
        $model->description = $description;
        $model->subDescription = $subDescription;
        $model->images = $pathImg;
        $model->categoryIds = $categoryIds;
        $model->createdDate = Carbon::now();

        $model->save();
        return redirect('/articles');
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
        $obj = Articles::all();
        $model = Articles::find($id);

        return view('backend.articles.edit', compact('model', 'obj'));
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
        Articles::destroy($id);
        return redirect('/Articles');

    }

    // lấy dánh sách các bài viết
    public function getArticle($id)
    {

        $data = Articles::select('id', 'name', 'subDescription', 'images', 'categoryIds')->where('categoryIds', $id)->get();

        if (count($data) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list article",
                "data" => $data,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }

    // lấy chi tiết bài viết
    public function getDetailArticle($id)
    {

        $data = Articles::all()->where('id', $id);

        if (count($data) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list detail article",
                "data" => $data,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);

    }

    public function listTopArticle()
    {
        // $event = Articles::select('id', 'name', 'subDescription', 'images', 'createdDate')->orderBy('createdDate', 'DESC')->take(3)->get();

        // if ( count($event) > 0){
        //     return response()->json([
        //         "code"=>"200",
        //         "message"=>"list category",
        //         "data"=>$event
        //     ],200);
        // }

        // return response()->json([
        //     "message"=>"data is null"
        // ],400);

    }
}