<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saldo_undian extends Model
{
    protected $table = 'saldo_undians';
    protected $fillable = [
        'norekening', 'point_sd_nov','point_dec','point_jan','point_feb','point_mar','point_apr','namalengkap','total_poin','saldo_akhir_periode','no_kupon','point_mei'
    ];
    use HasFactory;
}
