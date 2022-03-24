<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\TopUp;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        
        $bri = new BrivaController;
        $harga = Product::orderBy('harga', 'ASC')->get();
        $va = Customer::where('user_id', auth()->user()->id)->get();
        return view('index', compact('harga', 'va'));
    }

    public function getHistory()
    {
        $history = TopUp::where('customer_id', auth()->user()->customer->id)->orderBy('created_at', 'DESC')->limit(5)->get();
        $data = '';
        if (!empty($history)) {

            foreach ($history as $report) {
                if ($report->status_bayar == 0) {
                    $status_bayar = '<span class="text-danger">Belum Bayar</span>';
                } elseif ($report->status_bayar == 1) {
                    $status_bayar = '<span class="text-primary">Dibayar</span>';
                }
                $data .= '<div class="item">
                <div class="detail">
                    <div>
                        <strong>' . $status_bayar . '</strong>
                        <p>Expired Date : '. date("d F Y H:i:s", strtotime($report->expired_date)) . '</p>
                    </div>
                </div>
                <div class="right">
                    <div class="price text-success"> Rp. ' . number_format($report->nilai, 2, ",", ".") . '</div>
                </div>
            </div>';
            }
        }
        return $data;
    }

    public function updateUser(Request $request){
        $request->validate([
            'name'=>'required',
            'password1'=>'',
            'password2'=>'same:password1'
        ]);

        $user=User::find(auth()->user()->id);
        $user->name=$request->name;
        if(!empty($request->password1) and !empty($request->password2)){
            $user->password=Hash::make($request->password1);
        }
        $user->save();
        return redirect()->back();
    }
}
