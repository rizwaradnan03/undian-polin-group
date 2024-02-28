<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hadiah;
use App\Models\Setup;
use App\Models\Sistem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $title = "Setup Hadiah";
            $data = Sistem::all();

            return view('setup',compact('title','data'));
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
        $setup = new Setup();

        $setup->nama = $request->nama;
        $setup->periode_id = $request->periode_id;
        $setup->jumlah = $request->jumlah;
        $setup->jumlah_display = $request->jumlah;
        $setup->gambar = $request->gambar;
        $setup->save();

        return back()->with('sukses_tambah','Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
