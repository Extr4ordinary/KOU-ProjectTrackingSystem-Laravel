<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TakipController extends Controller
{
    
    public function takip($id){
        $proje_yonteicisi = User::where('unvan','proje-yurutucusu')->get();
        $proje_ogrencisi = User::where('unvan','proje-ogrencisi')->get();
        $total_hoca = count($proje_yonteicisi);
        $say = 0;
        foreach($proje_ogrencisi as $ogr){
            if ($total_hoca>0 && isset($proje_yonteicisi[$say])) {
                $ogr->danisman = ($proje_yonteicisi[$say])->id;
                $ogr->save();
                $say +=1;
            }
             else {
                $say=0;
                $ogr->danisman = ($proje_yonteicisi[$say])->id;
                $ogr->save();
                $say +=1;
            }
        }
    }
}
