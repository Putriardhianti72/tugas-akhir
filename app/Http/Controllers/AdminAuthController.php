<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Exception;

class AdminAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (admin_auth()->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('Admin.auth.login');
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login_submit(Request $request)
    {
        try {
            $user = admin_auth()->login([
                'uid' => $request->uid,
                'passwd' => $request->passwd,
            ]);

            if (!$user) {
                throw ValidationException::withMessages([
                    'uid' => [trans('auth.failed')],
                ]);
            }

            return redirect()->route('admin.dashboard');
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'uid' => [$e->getMessage()],
            ]);
        }
    }

    public function logout(Request $request)
    {
        admin_auth()->logout();
        $request->session()->flush();
        return redirect()->route('admin.login')->with('alert','Kamu sudah logout');
    }
}
