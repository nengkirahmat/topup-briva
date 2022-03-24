<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cekTopup=TopUp::where('status_bayar',0)->where('expired_date','>',date('Y-m-d H:i:s'))->count();
        if($cekTopup>0){
            $response = [
                'success' => false,
                'message' => 'TopUp Sebelumnya Belum Dibayar',
                'data' => '',
            ];
            return response()->json($response, 200);
        }else{
        // $no_va=auth()->user()->no_va;
        $no_va = $request->no_va;
        $nm_customer = auth()->user()->name;
        // $nm_customer="Pengguna Baru ".rand(1,1000);
        $nilai = (float)$request->nilai;
        $keterangan = "TopUp";
        $tgl_expired = date('Y-m-d H:i:s', time() + (60 * 60 * 24));
        $cek = (int)TopUp::max('kd_topup');
        if ($cek == 0) {
            $kode = rand(10000000, 99999999);
        } else {
            $upkode = $cek + 1;
            $kode = rand($upkode, 99999999);
        }

        $bri = new BrivaController;
        $responseJson = $bri->create($no_va, $nm_customer, $nilai, $keterangan, $tgl_expired,$kode);
        $statusCode = $responseJson["status"];
        $data = $responseJson["data"];
        if ($statusCode == true) {
            TopUp::create([
                'kd_topup' => $kode,
                'no_va'=>$no_va,
                'tgl_topup' => date('Y-m-d H:i:s'),
                'customer_id' => auth()->user()->customer->id,
                'nilai' => $data["amount"],
                'status_bayar' => 0,
                'expired_date' =>$tgl_expired,
                'tgl_bayar' => null,
                'via_bayar' => null,
                'keterangan' => null,
            ]);
            $message = $responseJson["responseDescription"];
        } else {
            $message = $responseJson["errDesc"];
        }
        $response = [
            'success' => $statusCode,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response, 200);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function show(TopUp $topUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function edit(TopUp $topUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopUp $topUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopUp $topUp)
    {
        //
    }
}
