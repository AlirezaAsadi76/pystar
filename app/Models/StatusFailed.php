<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusFailed extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function transactions()
    {
        return $this->morphOne(Transaction::class,'statusable');
    }
}
