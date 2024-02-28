<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setup;
use App\Models\Sistem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PilihHadiahController extends Controller
{
    public function pilihhadiahundian(){
        $data = Sistem::where('status','=','0')->first();
        $title = 'Pilih Hadiah';
        return view('pilih_hadiah_undian', compact('title','data'));
    }

    public function pilihhadiahundian_ajax(){
        $data = DB::connection('mysql')->select("select setups.* from setups inner join sistems on setups.periode_id = sistems.id where sistems.status = '0' AND setups.jumlah > 0");
        $response_data['data'] = $data;

        return json_encode($response_data);
    }

}
