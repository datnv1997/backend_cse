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
            $pathImg = "/images/" . $nameImg;
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
        $tempCate = Categories::select('id', 'name')->get();

        $model = Articles::find($id);
        $obj = Categories::where('id', $model->categoryIds)->get();
        $objName = $obj[0]->name;

        return view('backend.articles.edit', compact('model', 'objName', 'obj', 'tempCate'));
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
        $model = Articles::find($id);
        $pathImg = '';
        if ($request->hasFile('photo')) {
            $img = $request->photo;
            $nameImg = $img->getClientOriginalName();
            $pathImg = "/images/" . $nameImg;
            $img->move('images', $nameImg);
        } else {
            $pathImg = $model->images;
        }

        // $model->id = $uuid;
        $model->name = $name;
        $model->description = $description;
        $model->subDescription = $subDescription;
        $model->images = $pathImg;
        $model->categoryIds = $categoryIds;
        // $model->createdDate = Carbon::now();

        $model->save();
        return redirect('/articles');
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

        $data = Articles::select('*')->where('categoryIds', $id)->orderBy('createdDate', 'DESC')->get();

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

        $data = Articles::where('id', $id)->get();

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

    //lấy 3 blog mới nhất
    public function getThreeBlogNew($id)
    {

        $data = Articles::select('*')->where('categoryIds', $id)->orderBy('createdDate', 'DESC')->take(3)->get();

        if (count($data) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list banner",
                "data" => $data,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }

    // lấy 3 bài viết mới nhất - bài viết đang xem.
    public function getThreeArticleNew($idWatched)
    {
        $cate = Articles::find($idWatched);

        $data = Articles::select('*')->where('id', '!=', $idWatched)->where('categoryIds', $cate->categoryIds)->orderBy('createdDate', 'DESC')->take(3)->get();

        if (count($data) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list banner",
                "data" => $data,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }
    public function threeArticleHome()
    {
        $temp = Categories::where("name", 'Blog')->get();

        $data = Articles::select('*')->where('categoryIds', $temp[0]->id)->orderBy('createdDate', 'DESC')->take(3)->get();

        if (count($data) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list banner",
                "data" => $data,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }
    public function getArticleTuyenDungHome()
    {
        $id = 31;
        $data = Articles::select('*')->where('categoryIds', $id)->orderBy('createdDate', 'DESC')->take(1)->get();

        if (count($data) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list banner",
                "data" => $data,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }
    public function getArticleBanner()
    {
        $id = 32;
        $data = Articles::select('*')->where('categoryIds', $id)->orderBy('createdDate', 'DESC')->take(3)->get();

        if (count($data) > 0) {
            return response()->json([
                "code" => "200",
                "message" => "list banner",
                "data" => $data,
            ], 200);
        }

        return response()->json([
            "message" => "data is null",
        ], 400);
    }
}