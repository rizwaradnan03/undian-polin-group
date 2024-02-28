<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Hadiah;
use App\Models\saldo_undian;
use App\Models\Setup;
use App\Models\Sistem;
use App\Models\Undian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HadiahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $title = "Undian";
            $periode = Sistem::where('status', '=', '0')->first();

            $data = DB::table('setups')->selectRaw('setups.id,setups.nama,setups.periode_id,setups.status,setups.jumlah')
                ->join('sistems', 'sistems.id', '=', 'setups.periode_id')
                ->where('sistems.status', '=', $periode->status)
                ->where('setups.jumlah', '>', '0')
                ->get();
            // echo "<pre>";
            // print_r($data);die;
            return view('undian', ['data' => $data, 'title' => $title, 'periode' => $periode]);
        } else {
            return back()->with('haruslogin', 'Anda harus Login!');
        }
    }

    public function halaman_hadiah()
    {
        $title = "Setup Hadiah";
        $data_judul = Sistem::where('status', '=', '0')->first();
        $data = DB::table('setups')->selectRaw('setups.id,setups.nama,setups.jumlah_display')
            ->leftJoin('sistems', 'sistems.id', '=', 'setups.periode_id')
            ->where('setups.periode_id', '=', $data_judul->id)
            ->groupBy('nama')->get();

        return view('hadiah', compact('title', 'data', 'data_judul'));
    }

    public function halaman_pemenang()
    {
        $title = "Pemenang";
        $data_judul = Sistem::where('status', '=', '0')->first();
        $data = DB::table('setups')->selectRaw('setups.nama, undians.nama_lengkap, undians.noacc, sistems.nama_periode, companies.name as company')
            ->leftJoin('hadiahs', 'hadiahs.hadiah_id', '=', 'setups.id')
            ->leftJoin('undians', 'undians.id', '=', 'hadiahs.no_undian_id')
            ->leftJoin('sistems', 'sistems.id', '=', 'hadiahs.periode_id')
            ->leftJoin('companies', 'companies.id', '=', 'hadiahs.company_id')
            ->where('setups.periode_id', '=', $data_judul->id)
            ->groupBy(['setups.nama', 'undians.nama_lengkap'])
            ->orderBy('setups.nama')->get();
        // echo "<pre>";
        // print_r($data);die;
        return view('pemenang', compact('title', 'data', 'data_judul'));
    }

    public function postPemenang(Request $request)
    {
        if (Auth::check()) {
            // echo "<pre>";
            // print_r($request->input('company_id'));die;
            $hadiah_id = $request->input('hadiah_id');
            $no_undian_id = $request->input('no_undian_id');
            $periode_id = $request->input('periode_id');
            $no_acc = $request->input('no_acc');
            $company_id = $request->input('company_id');

            $data_save = new Hadiah();
            $data_save->no_undian_id = $no_undian_id;
            $data_save->hadiah_id = $hadiah_id;
            $data_save->periode_id = $periode_id;
            $data_save->company_id = $company_id;
            $data_save->save();

            Setup::where('id', $hadiah_id)->update(['jumlah' => DB::raw('jumlah - 1')]);

            Setup::where('id', $hadiah_id)->update(
                ['status' => '1']
            );

            Undian::where('noacc', '=', $no_acc)->update(['status' => '1']);
            Undian::where('noacc', '=', $no_acc)->update(['point' => '0']);

            $cek_empty = DB::connection('mysql')->selectOne("select jumlah from setups where id = $hadiah_id");

            if ($cek_empty->jumlah == 0) {
                $json_response['cek_empty'] = "habis";
            } else {
                $json_response['cek_empty'] = "ada";
            }

            $json_response['status'] = "Berhasil!";
            return json_encode($json_response);
        }
    }

    public function reset()
    {
        $setups = Setup::all(); // Mengambil semua instance model

        foreach ($setups as $setup) {
            $setup->jumlah = '2';
            $setup->jumlah_display = '2';
            $setup->status = '0';
            $setup->save(); // Melakukan penyimpanan perubahan pada model
        }


        Hadiah::truncate();
        Undian::query()->update(['point' => '1', 'status' => '0']);

        return redirect('/pemenang');
    }

    public function getPemenang(Request $request)
    {
        if (Auth::check()) {
            $periode = Sistem::where('status', '=', '0')->first();
            $company_id = $request->input('company_id');
            $cari_pemenang = Undian::where('status', '=', '0')->where('point', '=', '1')->where('periode_id', '=', $periode['id'])->where('company_id','=',$company_id)->inRandomOrder()->first();

            $response_data['data'] = $cari_pemenang;

            return json_encode($response_data);
        }
    }

    public function getHadiah(Request $request)
    {
        if (Auth::check()) {
            $hadiah_id = $request->input('hadiah_id');

            $json_response['hadiah_id'] = $hadiah_id;
            return json_encode($json_response);
        } else {
            return redirect('/');
        }
    }

    public function index_undian(string $id)
    {
        if (Auth::check()) {
            $companies = Company::all();
            $title = "Undian";
            $periode = Sistem::where('status', '=', '0')->first();
            $data = Setup::where('id', '=', $id)->first();

            if ($data != null) {
                return view('undian', compact('data', 'title', 'periode', 'companies'));
            } else {
                return redirect('/pilih-hadiah-undian');
            }
        } else {
            return back()->with('haruslogin', 'Anda harus Login!');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::check()) {
            $data = Setup::where('id', '=', $id)->first();
            $title = "Edit Hadiah " . $data->nama;
            $data_select = Sistem::all();

            return view('edit_hadiah', compact('data', 'title', 'data_select'));
        } else {
            return back()->with('haruslogin', 'Anda harus Login!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $save_data = Setup::find($id);
        $save_data->nama = $request->nama;
        $save_data->periode_id = $request->periode_id;
        $save_data->jumlah = $request->jumlah;
        $save_data->jumlah_display = $request->jumlah;
        $save_data->gambar = $request->gambar;
        $save_data->save();
        return redirect('/hadiah')->with('berhasil_update', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
