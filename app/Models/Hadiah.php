<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hadiah extends Model
{
    protected $table = 'hadiahs';
    protected $fillable = [
        'no_undian_id',
        'hadiah_id',
        'periode_id',
    ];

    public function undian(){
        return $this->belongsTo(Undian::class);
    }

    public function hadiah(){
        return $this->belongsTo(Hadiah::class);
    }
    use HasFactory;
}
