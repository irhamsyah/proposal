<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
Route::get('/',  function(){
$proposal=  Proposal::all();    
return View::make('aplikasi/register')->with('tampungan',$proposal);
});
*/

Route::resource('cari/aplikasi/{id}/hapus', 'ProposalController@destroy');
Route::resource('aplikasi', 'ProposalController');
Route::resource('aplikasi/{aplikasi}/hapus', 'ProposalController@destroy');
Route::get('cari/data',  function (){
    $datalist=  Proposal::all();
    return View::make('aplikasi/caridatalain')->with('tampungan',$datalist);
    
});
/*
Route::post('export',function(){
    
    //$tgl=date('Y-m-d',  strtotime(str_ireplace('/','-',Input::get('tgl'))));
    
    //$export=Proposal::where('tgl_masuk_proposal','=',$tgl)->take(10)->get();
    return View::make('aplikasi/tes');
});exporttidaksetuju
*/
Route::resource('export','ProposalController@exportxl');
Route::resource('exportrealisasi','ProposalController@exportpencairan');
Route::resource('exportbelumcair','ProposalController@exportbelumcair');
Route::resource('exporttidaksetuju','ProposalController@exporttidaksetuju');
Route::resource('cari/aplikasi/{aplikasi}','ProposalController@show');

/*{  $simpan=array(
                'tgl_masuk_proposal'=>substr(Input::get('tgl_masuk_proposal'), 6, 4)."-".substr(Input::get('tanggalprop'), 0, 2)."-".  substr(Input::get('tanggalprop'), 3, 2),
                'unit'=>Input::get('unit'),
                //'nomor_proposal'=>Input::get('nomor_proposal'),
                'produk'=>Input::get('produk'),
                'nama_debitur'=>Input::get('nama_debitur'),
                'plafond_pengajuan'=>Input::get('plafond_pengajuan'),
                'fasilitas'=>Input::get('fasilitas'),
                'tgl_kirim_unit'=>substr(Input::get('tgl_kirim_unit'), 6, 4)."-".substr(Input::get('tgl_krm_unit'), 0, 2)."-".  substr(Input::get('tgl_krm_unit'), 3, 2),
                'tgl_kirim_kp'=>substr(Input::get('tgl_kirim_kp'), 6, 4)."-".substr(Input::get('tgl_krm_kp'), 0, 2)."-".  substr(Input::get('tgl_krm_kp'), 3, 2),
                'bwmpkacab'=>Input::get('bwmpkacab'),
                'bwmpkp'=>Input::get('bwmpkp'),
                'tgl_realisasi'=>substr(Input::get('tgl_realisasi'), 6, 4)."-".substr(Input::get('tgl_real'), 0, 2)."-".  substr(Input::get('tgl_real'), 3, 2),
                'plafond_real'=>Input::get('plafond_real'),
                'keterangan'=>Input::get('keterangan'),

                 );

                $saver=Proposal::where('nomor_proposal','=',$aplikasi)->update($simpan);
Session::flash('message', 'DATA BERHASIL DISIMPAN!');
       Session::get('message');
    $hapus=  Proposal::where('nomor_proposal','=',$aplikasi);
    $hapus->delete();
    Session::flash('message', 'DATA BERHASIL DIHAPUS!');
                return Redirect::to('aplikasi');
});

//Route::resource('aplikasi', 'ProposalController');

//Route::resource('aplikasi/{id}/edit','ProposalController@ambil');
//Route::resource('aplikasi/{id}/edit/{edit}','ProposalController@update');
//Route::any('aplikasi/{id}/edit',array('as'=>'aplikasi/{id}/edit','uses'=>));
    
 /*   
Route::get('aplikasi/create',  function(){
    
    $proposal= Proposal::all();
    return \Illuminate\Support\Facades\Redirect::to('aplikasi')->with('tampungan',$proposal);
    
});*/


