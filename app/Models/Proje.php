<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proje extends Model
{
    use HasFactory;
    protected $collection ="projes";
    protected $casts = [
        'rapor_word' => 'array',
        'rapor_word2' => 'array',
        'rapor_pdf' => 'array',
        'tez_pdf' => 'array',
        'tez_word' => 'array',
        'tez_word2' => 'array',
    ];



}
