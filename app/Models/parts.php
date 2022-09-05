<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parts extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ["tasks_id", "partName", "partQty","partPrice", "partsTotal"];

    public function tasks(){    
        return $this->belongsTo(tasks::class);
    }
}
