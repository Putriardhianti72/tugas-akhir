<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('Admin.category.index',compact('categories'));
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
            return redirect()->route('admin.categories.index')->with([
            'alert_success' => 'Data kategori berhasil ditambah!'
        ]);
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
        $category = Category::findOrFail($id);
//        $category = DB::table('categories')
//            ->select ('*')
//            ->where ('id', $id)
//            ->first();
        return view('Admin.category.edit',compact('category'));
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

        $category = Category::findOrFail($id);

        $request->validate([
            'category_name'=> 'required'
        ]);
        $category->category_name = $request->category_name;
        $category->save();
//        return redirect()->route('categories.index');
//        $data->update([
//            'category_name'     => $request->category_name
//        ]);
//        $category = DB::table('categories')
//            ->where('id',$id)
//            ->update([
//                'category_name'=>$request->category_name,
//                'updated_at' => date('Y-m-d H:i:s')
//            ]);
        return redirect()->route('admin.categories.index')->with([
            'alert_success' => 'Data kategori berhasil disimpan!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $data = Category::findOrFail($id);
        $data = Category::find($id);
        $data->delete();
        return redirect()->route('admin.categories.index')->with([
            'alert_success' => 'Data kategori berhasil dihapus!'
        ]);
//        dd($id);
    }
}
