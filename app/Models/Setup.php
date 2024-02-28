<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    protected $table = 'setups';
    protected $fillable = [
        'nama',
        'periode_id',
        'status',
        'jumlah_display',
        'jumlah',
        'gambar',
    ];
    use HasFactory;
}
