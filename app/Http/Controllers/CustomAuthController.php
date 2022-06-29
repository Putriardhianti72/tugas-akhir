<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Exception;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (member_auth()->check()) {
            return redirect()->to('/');
        }

        return view('User.auth.login');

//        return view('Account.login');


    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login_submit(Request $request)
    {
        $request->validate([
            'uid' => ['required'],
            'passwd' => ['required'],
        ]);

        try {
            $user = member_auth()->login([
                'uid' => $request->uid,
                'passwd' => $request->passwd,
            ]);

            if (!$user) {
                throw ValidationException::withMessages([
                    'uid' => [trans('auth.failed')],
                ]);
            }

            return redirect()->intended('/');
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'uid' => [$e->getMessage()],
            ]);
        }

    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('login')->with('alert','Kamu sudah logout');
    }

    public function profileMember(){
        return view('User.auth.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        dd($id);
//        return view("Layouts.user.cart");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        dd($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart= session("cart");
        unset($cart[$id]);
        session(["cart" => $cart]);
        return redirect("/carts");

    }
}

