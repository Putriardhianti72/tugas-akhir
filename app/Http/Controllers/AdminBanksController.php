<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBanksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $databanks = Bank::all();
        return view('Admin.bank.index', compact('databanks'));
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
        $this->validate($request,[
            'bank_name' => 'required',
            'acc_owner' => 'required',
            'acc_number' => 'required'
        ]);
        Bank::create([
            'bank_name' => $request->bank_name,
            'acc_owner' => $request->acc_owner,
            'acc_number' => $request->acc_number
        ]);

        //redirect to index
        return redirect()->route('admin.banks.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
//        $bank = DB::table('databanks')
//            ->select ('*')
//            ->where ('id', $id)
//            ->first();
        $bank = Bank::findOrFail($id);
        return view('admin.bank.edit',compact('bank'));
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
        $bank = Bank::findOrFail($id);
        $data = $request->validate([
            'bank_name' => 'required',
            'acc_owner' => 'required',
            'acc_number' => 'required'
        ]);
//        $category = DB::table('databanks')
//            ->where('id',$id)
//            ->update([
//                'bank_name' => $request->bank_name,
//                'acc_owner' => $request->acc_owner,
//                'acc_number' => $request->acc_number
//            ]);
        $bank->$request->all();
        $bank->save();
        return redirect()->route('admin.banks.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Bank::find($id);
        $data->delete();
        return redirect()->route('admin.banks.index');
    }
}
