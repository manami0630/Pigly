<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','date','weight','calories','exercise_time','exercise_content'
    ];
    protected $table = 'weight_logs';

    public function scopeLatest($query)
    {
        return $query->orderBy('log_date', 'desc')->limit(1);
    }
}
