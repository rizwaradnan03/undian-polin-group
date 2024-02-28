<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporanperolehan(){
        if(Auth::check()){
            $title = 'Laporan Perolehan';
            return view('laporan_perolehan', compact('title'));
        }else{
            return redirect('/');
        }
    }

    public function laporanperbulan(){
        if(Auth::check()){
            $title = 'Laporan Posisi Poin';
            // $data = DB::table('undians')
            // ->selectRaw("DATE_FORMAT(created_at, '%M %Y') AS date, COUNT(*) AS jumlah")
            // ->groupBy('date')
            // ->get();

            // $data = DB::connection('sqlsrv')
            // ->table('saldo_undian')
            // // ->select('saldoharian_tab.noacc', 'cif.namaidentitas')
            // ->orderBy('total_poin', 'desc')
            // ->get();

            // $data = DB::connection('nama_koneksi')->table('saldo_undian')
            // ->where(function ($query) {
            //     $query->where('point_sd_nov', '<>', 0)
            //         ->orWhere('point_dec', '<>', 0)
            //         ->orWhere('point_jan', '<>', 0)
            //         ->orWhere('point_feb', '<>', 0)
            //         ->orWhere('point_apr', '<>', 0);
            // })
            // ->orWhere('saldo_akhir_periode', '>=', 100000)
            // ->orderBy('total_poin', 'DESC')
            // ->get();

            $data = DB::connection('sqlsrv')->table('saldo_undian')
                ->where('saldo_akhir_periode', '>=', 100000)
                ->where('stsrektab','=',1)
                ->orderBy('total_poin', 'DESC')
                ->get();
            return view('laporan_perbulan', compact('title','data'));
        }else{
            return redirect('/');
        }
    }

    public function getPerolehan(Request $request){
        if(Auth::check()){
            $month = $request->input('month');
            $year = $request->input('year');
            $pembagi = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $results = DB::connection('sqlsrv')
            ->table('saldoharian_tab')
            ->select('saldoharian_tab.noacc', 'cif.namaidentitas')
            ->selectRaw("CAST(((saldo_1 + saldo_2 + saldo_3 + saldo_4 + saldo_5 + saldo_6 + saldo_7 + saldo_8 + saldo_9 + saldo_10 + saldo_11 + saldo_12 + saldo_13 + saldo_14 + saldo_15 + saldo_16 + saldo_17 + saldo_18 + saldo_19 + saldo_20 + saldo_21 + saldo_22 + saldo_23 + saldo_24 + saldo_25 + saldo_26 + saldo_27 + saldo_28 + saldo_29 + saldo_30 + saldo_31) / $pembagi) AS INT) as saldo")
            ->selectRaw("FLOOR(((saldo_1 + saldo_2 + saldo_3 + saldo_4 + saldo_5 + saldo_6 + saldo_7 + saldo_8 + saldo_9 + saldo_10 + saldo_11 + saldo_12 + saldo_13 + saldo_14 + saldo_15 + saldo_16 + saldo_17 + saldo_18 + saldo_19 + saldo_20 + saldo_21 + saldo_22 + saldo_23 + saldo_24 + saldo_25 + saldo_26 + saldo_27 + saldo_28 + saldo_29 + saldo_30 + saldo_31) / $pembagi) / 100000) as point")
            ->join('tabmaster', 'saldoharian_tab.noacc', '=', 'tabmaster.norekening')
            ->join('cif', 'tabmaster.cif', '=', 'cif.cif')
            ->where('saldoharian_tab.tahun', $year)
            ->where('saldoharian_tab.bulan', $month)
            ->where(DB::raw("SUBSTRING(saldoharian_tab.noacc, 6, 2)"), '07')
            ->orderBy('point', 'desc')
            ->get();

            if(sizeof($results) != 0){
                $response_data['status'] = 'berhasil';
                $response_data['data'] = $results;
            }else if(sizeof($results) == 0){
                $response_data['status'] = 'gagal';
            }else{
                $response_data['status'] = "";
            }

            return json_encode($response_data);
        }else{
            return redirect('/');
        }
    }

}
