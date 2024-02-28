<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistem extends Model
{
    protected $table = 'sistems';
    protected $fillable = [
        'nama_periode','tgl_expired','status'
    ];
    
    use HasFactory;
}
