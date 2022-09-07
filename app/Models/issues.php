<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class issues extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable =['title','content'];

    public function tasks(){    
        return $this->belongsTo(tasks::class);
    }
}
