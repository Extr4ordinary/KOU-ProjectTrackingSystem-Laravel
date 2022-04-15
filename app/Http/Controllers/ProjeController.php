<?php

namespace App\Http\Controllers;

use App\Models\Donem;
use Illuminate\Http\Request;
use App\Models\Proje;

class ProjeController extends Controller
{
    public function index()
    {
        return view('client.ogrenci_odev.ogrenci_odev');
    }
    public function data()
    {
        $users = Proje::where('ogrenci_id',auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return $users;
    }

    public function store(Request $request)
    {
        if ($request->id) {
            $user  = Proje::find($request->id);
        } else {
           $user = new Proje();
        }
        //Log::info($request->post());
        $user->baslik = $request->baslik;
        $user->amac = $request->amac;
        $user->metaryel = $request->metaryel;
        $user->anahtar_kelime = $request->anahtar_kelime;
        $user->ogrenci_id = auth()->user()->id;
        $user->hoca_id = auth()->user()->danisman;
        $user->donem_ıd = Donem::where('opened',1)->first()->id;
        $user->durum = "Devam Eden Proje";
        $user->save();
    }
    public function raporAsamasi(Request $request){

        $proje = Proje::find($request->id);

        if ($request->file('projeDocs')) {
            $name = date('YmdHi').$request->file('projeDocs')->getClientOriginalName();
            $request->file('projeDocs')->move(public_path('files'), $name);
            $proje->rapor_word = $name;
        } 
        if ($request->file('projeDocs2')) {
            $name = date('YmdHi').$request->file('projeDocs2')->getClientOriginalName();
            $request->file('projeDocs2')->move(public_path('files'), $name);
            $proje->rapor_word2 = $name;
        } 
        if ($request->file('projePdf')) {
            $name = date('YmdHi').$request->file('projePdf')->getClientOriginalName();
            $request->file('projePdf')->move(public_path('files'), $name);
            $proje->rapor_pdf = $name;
        } 
        $proje->durum="Rapor Gönderildi";
        $proje->save();
    }
    public function tezAsamasi(Request $request){

        $proje = Proje::find($request->id);

        if ($request->file('tezDocs')) {
            $name = date('YmdHi').$request->file('tezDocs')->getClientOriginalName();
            $request->file('tezDocs')->move(public_path('files'), $name);
            $proje->tez_word = $name;
        } 
        if ($request->file('tezDocs2')) {
            $name = date('YmdHi').$request->file('tezDocs2')->getClientOriginalName();
            $request->file('tezDocs2')->move(public_path('files'), $name);
            $proje->tez_word2 = $name;
        } 
        if ($request->file('tezPdf')) {
            $name = date('YmdHi').$request->file('tezPdf')->getClientOriginalName();
            $request->file('tezPdf')->move(public_path('files'), $name);
            $proje->tez_pdf = $name;
        } 
        $proje->durum="Tez Gönderildi";
        $proje->save();
    }
    public function delete($id){
        $user = Proje::find($id);
        $user->delete();
    }
    public function rapor_red(Request $request){
        $user = Proje::find($request->id);
        $user->durum = "Rapor Red Edildi";
        $user->red_nedeni = $request->red_nedeni;
        $user->save();
    }
    public function tez_red(Request $request){
        $user = Proje::find($request->id);
        $user->durum = "Tez Red Edildi";
        $user->red_nedeni = $request->red_nedeni;
        $user->save();
    }
    public function revize($id,Request $request){
        $user = Proje::find($id);
        $user->durum = "Proje Öerisi Red Edildi";
        $user->red_nedeni = $request->red_nedeni;
        $user->save();
    }
    public function onay(Request $request){
        $user = Proje::find($request->id);
        $user->durum = "Rapor Aşamasında";
        $user->save();
    }
    public function onay_rapor(Request $request){
        $user = Proje::find($request->id);
        $user->durum = "Tez Aşamasında";
        $user->save();
    }
    public function onay_tez(Request $request){
        $user = Proje::find($request->id);
        $user->durum = "Tamamlandı";
        $user->save();
    }
    public function seen($id){
        $user = Proje::find($id);
        $user->seen = "Proje Önerisi Görüldü";
        $user->save();
    }
    public function seen_rapor($id){
        $user = Proje::find($id);
        $user->seen = "Rapor Aşaması Görüldü";
        $user->save();
    }
    public function seen_tez($id){
        $user = Proje::find($id);
        $user->seen = "Tez Aşaması Görüldü";
        $user->save();
    }
}
