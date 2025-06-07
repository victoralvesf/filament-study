<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'hire_date'];

    protected $casts = [
        'hire_date' => 'date',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
