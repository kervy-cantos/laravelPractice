<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workers extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ["task_id","workerName", "workerRate","workHours", "workerTotal"];

    public function tasks(){    
        return $this->belongsTo(tasks::class);
    }
}
