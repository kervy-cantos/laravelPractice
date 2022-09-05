<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{   
    public $timestamps = false;
    use HasFactory;
   
    protected $fillable = ["taskName","taskPrice","laborTotal","partsTotal","taskTotal"];

    public function workers(){
        return $this->hasMany(workers::class);
    }
    public function parts(){
        return $this->hasMany(parts::class);
    }
}

