<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workers extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ["tasks_id", "workerName", "workRate","workHours", "workersTotal"];

    public function tasks(){    
        return $this->belongsTo(tasks::class);
    }
}
