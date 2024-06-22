<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('absensi.createAbsensi');
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

    public function cache(Request $request){
        $temp = $request->data;
        date_default_timezone_set('Asia/Jakarta');
        $current_time = Carbon::now();
        $next_midnight = Carbon::tomorrow()->startOfDay();
        $seconds_until_midnight = (int) abs($next_midnight->diffInSeconds($current_time));
        Cache::put("absen", $temp, $seconds_until_midnight);
        return "Data berhasil disimpan.";
    }

    public function getCache(){
        return Cache::get("absen");
    }

    public function absenKeluar(){
        $data = Cache::get("absen");
        return view('absensi.absenKeluar', compact('data'));
    }
}