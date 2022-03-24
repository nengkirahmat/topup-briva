<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\TopUp;
use App\Models\Product;
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
        $history = TopUp::where('no_va', auth()->user()->customer->no_va)->orderBy('created_at', 'DESC')->limit(5)->get();
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
}
