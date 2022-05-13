<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data = [
//            'categories' => Category::all(),
//            "title" => "Kategori"
//            ];
        $categories = Category::all();
        return view('category.indexx',compact('categories'));
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
        $data = $request->validate([
            'category_name'=> 'required'
        ]);
        if (Category::create($data)) {
            return redirect()->route('categories.index');
//            dd($data);
        }else{
            abort(500);
        }
//        dd($request->all());
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
//        $data = Category::findOrFail($id);
//        $category = Category::findOrFail($id);
        $category = DB::table('categories')
            ->select ('*')
            ->where ('id', $id)
            ->first();
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $data = $request->validate([
            'category_name'=> 'required'
        ]);
//        $db = Category::findOrFail($id);
//        $db->category_name = $data['category_name'];
//        $db->save();
//        return redirect()->route('categories.index');
//        $data->update([
//            'category_name'     => $request->category_name
//        ]);
        $category = DB::table('categories')
            ->where('id',$id)
            ->update([
                'category_name'=>$request->category_name
            ]);
        return redirect('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();
        return redirect()->route('categories.index');
//        dd($id);
    }
}
