<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sistem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $title = "Setup Periode";
            return view('periode',compact('title'));
        }else{
            return back()->with('haruslogin', 'Anda harus Login!');
        }
    }

    public function listperiode(){
        if(Auth::check()){
            $title = "List Periode";
            $data = Sistem::all();
            return view('listperiode',compact('title','data'));
        }else{
            return back()->with('haruslogin', 'Anda harus Login!');
        }
    }

    public function updateperiode(Request $request){
        if(Auth::check()){
            $id = $request->input('id');
            Sistem::where('id','=',$id)->update(['status' => '0']);
            Sistem::where('id','<>',$id)->update(['status' => '1']);

            $json_response['status'] = 'Berhasil';
            return json_encode($json_response);
        }else{
            return back()->with('haruslogin', 'Anda harus Login!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $save_data = new Sistem();
        $save_data->nama_periode = $request->nama_periode;
        $save_data->tgl_expired = $request->tgl_expired;
        $save_data->status = '1';
        $save_data->save();

        return redirect('/')->with('berhasil','Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Auth::check()){
            $data = Sistem::where('id','=',$id)->first();
            $title = "Edit Periode" . $data->nama_periode;

            return view('edit_periode', compact('data','title'));
        }else{
            return back()->with('haruslogin', 'Anda harus Login!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $save_data = Sistem::find($id);
        $save_data->nama_periode = $request->nama_periode;
        $save_data->tgl_expired = $request->tgl_expired;
        $save_data->save();
        return redirect('/listperiode')->with('berhasil_update','Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
