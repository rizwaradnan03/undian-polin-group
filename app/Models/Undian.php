<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undian extends Model
{
    protected $tables = 'undians';
    protected $fillable = [
        'noacc',
        'no_undian',
        'nama_lengkap',
        'point',
	    'periode_id',
        'status',
    ];

    public function hadiah(){
        return $this->hasMany(Hadiah::class);
    }
    use HasFactory;
}
