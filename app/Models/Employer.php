<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use App\Models\User;
// use App\Models\Job;

class Employer extends Model
{
    use HasFactory;

    //protected $fillable = ['name'];


    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    // an employer belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
