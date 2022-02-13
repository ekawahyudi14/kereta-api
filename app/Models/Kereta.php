<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kereta extends Model
{
    use HasFactory;

    protected $table = 'kereta';
    protected $fillable = ['nama'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
