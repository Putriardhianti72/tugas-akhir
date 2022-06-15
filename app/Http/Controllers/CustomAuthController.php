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

        return view('Account.login');

        if(!Session::get('email')) {
            return view('Account.login');
        }
        else{
            return redirect('/');
        }
//        return view('Account.login');
//        $uid='duta73490';
//        $pass='jundi2009';
//        $response = Http::post('dobel.co.id/portH2H/restapi.php?function=get_login&uid='.$uid.'&pass='.$pass);
//        return $response->json();
//        $response = Http::post('dobel.co.id/restfullapi/data/infomember.php', [
//            'uid' => 'duta73490',
//            'passwd' => 'jundi2009',
//        ]);
//        return $response->setBody($response)->json();
//        $response = Http::withHeaders([
//
//        ])->post('dobel.co.id/restfullapi/data/infomember.php', [
//            'uid' => 'duta73490',
//            'passwd' => 'jundi2009',
//        ]);
//        $response = Http::asForm()->post('dobel.co.id/restfullapi/data/infomember.php', [
//            'uid' => 'duta73490',
//            'passwd' => 'jundi2009',
//        ]);
//        $account = new Account();
//        $response = Http::post('dobel.co.id/restfullapi/data/infomember.php', [
//            'form_params'=>[
//            'uid' => 'duta73490',
//            'passwd' => 'jundi2009',
//        ]
//        ]);
//        $client = new \GuzzleHttp\Client();
//        $client->post('dobel.co.id/restfullapi/data/infomember.php',
//            array(
//                'form_params' => array(
//                    'uid' => 'duta73490',
//                    'passwd' => 'jundi2009',
//                )
//            )
//        );
//                return $client->json();
//        $request = $this->client->post(
//            'dobel.co.id/restfullapi/data/infomember.php',
//            [
////                'content-type' => 'application/json'
//                $data=>[]
//            ],
//        );
//        $request->setBody($data); #set body!
//        $response = $request->send();
//        $response = Http::asForm()->post('dobel.co.id/restfullapi/data/infomember.php', [
//            'uid' => 'duta73490',
//            'passwd' => 'jundi2009',
//        ]);
//        return $client->json();

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


//
//        $user = null;
//
//        $response_admin = $this->request_login('http://dobel.co.id/restfullapi/data/infoadmin.php', [
//            'query' => [
//                'uid' => $request->input('uid'),
//                'passwd' => $request->input('passwd'),
//            ]
//        ]);
//
//        if ($response_admin['status'] === 'success') {
//            $user = $response_admin['result'];
//        }
//
//        if (! $user) {
//            $response_member = $this->request_login('http://dobel.co.id/restfullapi/data/infomember.php', [
//                'query' => [
//                    'uid' => $request->input('uid'),
//                    'passwd' => $request->input('passwd'),
//                ]
//            ]);
//
//            if ($response_member['status'] === 'success') {
//                $user = $response_member['result'];
//            }
//        }
//
//        dd($user);
//        $client = new Client();
//        $url = "dobel.co.id/restfullapi/data/infoadmin.php";
//        $response = $client->post($url, [
//            'query' => [
//                'uid' => $request->input('uid'),
//                'passwd' => $request->input('passwd')
//            ],
//            'headers' => [
//                'Accept' => 'application/json',
//                'Content-Type' => 'application/x-www-form-urlencoded',
//            ],
//        ]);
//        if (! isset($config['headers'])) {
//            $config['headers'] = [];
//        }
//
//        $config['headers'] = array_merge([
//            'Accept' => 'application/json',
//            'Content-Type' => 'application/x-www-form-urlencoded',
//        ], $config['headers']);
//
//        $response = $client->post($url, $config);
//        $body = (string) $response->getBody();
//        dd($body);
//        if ($body["status"] === 'kosong') {
//            dd('FAIL');
//        } else if ($body["status"] === 'success') {
////            dd($res['result']['email'])
//            $request->session()->put('nama', $body['result']['nama']);
//        }
//        dd($request->session()->get('nama'));
//        $response = $client->post($url,
//             [
//                'uid' => $request->input('uid'),
//                'passwd' => $request->input('passwd')
//            ]
//        );
//        $body = (string)$response->getBody();
//        $splitBody = preg_split("/\r\n|\n|\r/", $body);
//        $res = json_decode($splitBody[1], true);
//        if ($res['status'] === 'kosong') {
//            dd('FAIL');
//        } else if ($res['status'] === 'success') {
////            dd($res['result']['email'])
//            $request->session()->put('email', $res['result']['email']);
//        }
////        dd($request->session()->get('email'));
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('login')->with('alert','Kamu sudah logout');
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
        $this->validate($request, [
            'bank_name' => 'required',
            'acc_owner' => 'required',
            'acc_number' => 'required'
        ]);
        Databank::create([
            'bank_name' => $request->bank_name,
            'acc_owner' => $request->acc_owner,
            'acc_number' => $request->acc_number
        ]);

        //redirect to index
        return redirect()->route('banks.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $cart= session("cart");
        $product = DB::table('products')
            ->select ('*')
            ->where ('id', $id)
            ->first();
        $cart[]=[
            "id" => $product->id,
            "pict" => $product->pict,
            "product_name" => $product->product_name,
            "price" => $product->price,
        ];
        session(["cart" => $cart]);
        return redirect("/carts");
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
        $data = $request->validate([
            'bank_name' => 'required',
            'acc_owner' => 'required',
            'acc_number' => 'required'
        ]);
        $category = DB::table('databanks')
            ->where('id', $id)
            ->update([
                'bank_name' => $request->bank_name,
                'acc_owner' => $request->acc_owner,
                'acc_number' => $request->acc_number,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        return redirect('banks');
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

//namespace App\Http\Controllers;
//
//use App\Models\Product;
//use Illuminate\Http\Request;
//
//class CartController extends Controller
//{
//    public function index()
//    {
//        $products = Product::all();
//    }
//
//    public function AddCart()
//    {
//        return view("Layouts.user.cart");
////        dd($id);
//        $cart= session("cart");
//        $product=Product::detail_product($id);
//        $cart["id"]=[
//          "pict" => $product->pict,
//          "product_name" => $product->product_name,
//          "price" => $product->price,
//        ];
//        session(["cart" => $cart]);
//        return redirect("/cart");
//    }
//
//    public function cart(){
//        $cart= session("cart");
//        return view("Layouts.user.cart")->with("cart", $cart);
//    }
//}
