<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RetailReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminRetailRewardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retailRewards = RetailReward::all();
        return view('Admin.retail-reward.index', compact('retailRewards'));
    }

    public function categori(){

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('category_name','id');
        $retailReward = new RetailReward();
        return view('Admin.retail-reward.form', compact('retailReward', 'categories'));
    }

    public function list()
    {
        $retailRewards = RetailReward::all();
        return view('Layouts.index', compact('retailRewards'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'code' => 'required',
            'reward' => 'required',
        ]);

        RetailReward::create($request->all());

        //redirect to index
        return redirect()->route('admin.retail-rewards.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retailReward = RetailReward::findOrFail($id);
        return view('Admin.retail-reward.detail', compact('retailReward'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('category_name','id');
        $retailReward = RetailReward::findOrFail($id);
        return view('Admin.retail-reward.form', compact('retailReward', 'categories'));
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
        $retailReward = RetailReward::findOrFail($id);

        //validate form
        $this->validate($request, [
            'code' => 'required',
            'reward' => 'required',
        ]);

        $retailReward->fill($request->all());
        $retailReward->save();

        //redirect to index
        return redirect()->route('admin.retail-rewards.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RetailReward $retailReward)
    {
        $retailReward->delete();
        return redirect()->route('admin.retail-rewards.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
